<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\EmployeeChild;
use App\Models\JobHistory;
use App\Models\EmployeeTraining;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search      = $request->input('search');
        $gender      = $request->input('gender');
        $min_age     = $request->input('min_age');
        $max_age     = $request->input('max_age');
        $birthplace  = $request->input('birthplace');

        // Sorting
        $sortBy  = $request->input('sort_by', 'created_at'); // default
        $sortDir = $request->input('sort_dir', 'desc');      // default

        $employees = Employee::query()

            // SEARCH
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'LIKE', "%{$search}%");
            })

            // FILTER GENDER
            ->when($gender, function ($query) use ($gender) {
                $query->where('gender', $gender);
            })

            // FILTER TEMPAT LAHIR
            ->when($birthplace, function ($query) use ($birthplace) {
                $query->where('birth_place', 'LIKE', "%{$birthplace}%");
            })

            // FILTER UMUR MIN
            ->when($min_age, function ($query) use ($min_age) {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= ?", [$min_age]);
            })

            // FILTER UMUR MAX
            ->when($max_age, function ($query) use ($max_age) {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) <= ?", [$max_age]);
            })

            // SORTING (DINAMIS)
            ->orderBy($sortBy, $sortDir)

            ->paginate(10)
            ->appends($request->all());

        return view('main.karyawan', compact(
            'employees',
            'search',
            'gender',
            'min_age',
            'max_age',
            'birthplace',
            'sortBy',
            'sortDir'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
    // Mengambil alamat spesifik
        $ktpAddress     = $employee->addresses()->where('type', 'KTP')->first();
        $currentAddress = $employee->addresses()->where('type', 'CURRENT')->first();

        // Load semua relasi agar tidak ada N+1 query
        $employee->load(['educations', 'children', 'jobHistory', 'trainings', 'file']);

        return view('employees.show', [
            'employee'       => $employee,
            'ktpAddress'     => $ktpAddress,
            'currentAddress' => $currentAddress,
            'educations'     => $employee->educations,
            'children'       => $employee->children,
            'jobHistory'     => $employee->jobHistory,
            'trainings'      => $employee->trainings,
            'file'           => $employee->file,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // prepare related data so the form can be pre‑filled
        $ktpAddress     = $employee->addresses()->where('type','KTP')->first();
        $currentAddress = $employee->addresses()->where('type','CURRENT')->first();

        // load related collections for dynamic sections
        $educations = $employee->educations()->orderBy('year_in','desc')->get();
        $children   = $employee->children()->get();
        $jobHistory = $employee->jobHistory()->get();
        $trainings  = $employee->trainings()->get();

        return view('employees.edit', compact(
            'employee',
            'ktpAddress',
            'currentAddress',
            'educations',
            'children',
            'jobHistory',
            'trainings'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'national_id'   => 'required|string|max:20',
            'email'         => 'required|email',
            'phone'         => 'required',
            'birth_place'   => 'required|string',
            'birth_date'    => 'required|date',
            'gender'        => 'required|string',
            'marital_status'=> 'required|string',
            'last_education'=> 'required|string',
            'religion'      => 'required|string',
            'blood_type'    => 'required|string',
            'bpjs_tk'       => 'nullable|string',
            'bpjs_kes'      => 'nullable|string',
            'npwp'          => 'nullable|string',
            'skills'        => 'nullable|string', // comma separated list
            // we will explode into array after
            'emergency_name'=> 'required|string',
            'emergency_relation'=> 'required|string',
            'emergency_phone'=> 'required|string',

            // address fields are optional; update if present
            'ktp_address'   => 'nullable|string',
            'ktp_province'  => 'nullable|string',
            'ktp_city'      => 'nullable|string',
            'ktp_district'  => 'nullable|string',
            'ktp_village'   => 'nullable|string',
            'ktp_postal'    => 'nullable|string',
            'dom_address'   => 'nullable|string',
            'dom_province'  => 'nullable|string',
            'dom_city'      => 'nullable|string',
            'dom_district'  => 'nullable|string',
            'dom_village'   => 'nullable|string',
            'dom_postal'    => 'nullable|string',

            // dynamic sections
            'school_name'             => 'nullable|array',
            'school_name.*'           => 'required_with:school_name|string',
            'city.*'                  => 'required_with:school_name|string',
            'major.*'                 => 'required_with:school_name|string',
            'year_in.*'               => 'required_with:school_name|digits:4',
            'year_out.*'              => 'required_with:school_name|digits:4',

            'dependent_name'          => 'nullable|array',
            'dependent_name.*'        => 'required_with:dependent_name|string',
            'dependent_gender.*'      => 'required_with:dependent_name|string',
            'dependent_birth.*'       => 'required_with:dependent_name|date',
            'dependent_education.*'   => 'required_with:dependent_name|string',

            'position'                => 'nullable|array',
            'position.*'              => 'required_with:position|string',
            'work_unit.*'             => 'required_with:position|string',
            'start_date.*'            => 'required_with:position|date',
            'work_note.*'             => 'nullable|string',

            'training_name'           => 'nullable|array',
            'training_name.*'         => 'required_with:training_name|string',
            'training_provider.*'     => 'required_with:training_name|string',
            'training_year.*'         => 'required_with:training_name|integer',
            'training_location.*'     => 'nullable|string',
            'training_certificate.*'  => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'existing_certificate'    => 'nullable|array',
            'existing_certificate.*'  => 'nullable|string',
        ]);

        // convert skills string into array if present
        if (isset($validated['skills']) && is_string($validated['skills'])) {
            $validated['skills'] = array_filter(array_map('trim', explode(',', $validated['skills'])));
        }

        $employee->update($validated);

        // update or create addresses
        if ($request->filled('ktp_address')) {
            $employee->addresses()->updateOrCreate(
                ['type' => 'KTP'],
                [
                    'address_line' => $validated['ktp_address'],
                    'province'     => $validated['ktp_province'],
                    'city'         => $validated['ktp_city'],
                    'district'     => $validated['ktp_district'],
                    'village'      => $validated['ktp_village'],
                    'postal_code'  => $validated['ktp_postal'],
                ]
            );
        }

        if ($request->filled('dom_address')) {
            $employee->addresses()->updateOrCreate(
                ['type' => 'CURRENT'],
                [
                    'address_line' => $validated['dom_address'],
                    'province'     => $validated['dom_province'],
                    'city'         => $validated['dom_city'],
                    'district'     => $validated['dom_district'],
                    'village'      => $validated['dom_village'],
                    'postal_code'  => $validated['dom_postal'],
                ]
            );
        }

        // --- sync dynamic sections ---
        // educations
        $employee->educations()->delete();
        if (!empty($validated['school_name'])) {
            foreach ($validated['school_name'] as $i => $name) {
                \App\Models\EmployeeEducation::create([
                    'employee_id' => $employee->id,
                    'school_name' => $name,
                    'city'        => $validated['city'][$i] ?? null,
                    'major'       => $validated['major'][$i] ?? null,
                    'year_in'     => $validated['year_in'][$i] ?? null,
                    'year_out'    => $validated['year_out'][$i] ?? null,
                ]);
            }
        }
        // dependents
        $employee->children()->delete();
        if (!empty($validated['dependent_name'])) {
            foreach ($validated['dependent_name'] as $i => $name) {
                \App\Models\EmployeeChild::create([
                    'employee_id'    => $employee->id,
                    'name'           => $name,
                    'gender'         => $validated['dependent_gender'][$i] ?? null,
                    'birth_date'     => $validated['dependent_birth'][$i] ?? null,
                    'last_education' => $validated['dependent_education'][$i] ?? null,
                ]);
            }
        }
        // job history
        $employee->jobHistory()->delete();
        if (!empty($validated['position'])) {
            foreach ($validated['position'] as $i => $pos) {
                \App\Models\JobHistory::create([
                    'employee_id' => $employee->id,
                    'status'      => $pos,
                    'unit'        => $validated['work_unit'][$i] ?? null,
                    'start_date'  => $validated['start_date'][$i] ?? null,
                    'note'        => $validated['work_note'][$i] ?? null,
                ]);
            }
        }
        // trainings
        $employee->trainings()->delete();
        if (!empty($validated['training_name'])) {
            foreach ($validated['training_name'] as $i => $title) {
                $certificatePath = $validated['existing_certificate'][$i] ?? null;
                if ($request->hasFile("training_certificate.$i")) {
                    $file = $request->file("training_certificate.$i");
                    if ($file) {
                        $certificatePath = $file->store('training_certificates', 'public');
                    }
                }

                \App\Models\EmployeeTraining::create([
                    'employee_id'      => $employee->id,
                    'title'            => $title,
                    'provider'         => $validated['training_provider'][$i] ?? null,
                    'location'         => $validated['training_location'][$i] ?? null,
                    'year'             => $validated['training_year'][$i] ?? null,
                    'certificate_path' => $certificatePath,
                ]);
            }
        }

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            // Karena data karyawan tidak memiliki kolom file cv/foto langsung di tabelnya,
            // kita langsung hapus recordnya saja. 
            // Relasi lain (alamat/pendidikan) akan terhapus otomatis jika menggunakan ON DELETE CASCADE di DB.
            
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
    
}