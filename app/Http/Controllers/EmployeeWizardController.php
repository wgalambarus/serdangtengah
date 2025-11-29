<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\EmployeeSpouse;
use App\Models\EmployeeAddress;
use App\Models\JobHistory;
use App\Models\EmployeeChild;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeTraining;


class EmployeeWizardController extends Controller
{

    public function index()
    {
        return view('employees.create.informasi-umum');
    }
    public function show($step)
    {
        $allowedSteps = [
            'informasi-umum',
            'alamat-karyawan',
            'pendidikan',
            'tanggungan',
            'pekerjaan',
            'pelatihan',
            'review'
        ];

        if (!in_array($step, $allowedSteps)) {
            abort(404);
        }

        $data = session()->get('employee_wizard.' . $step, []);

        return view('employees.create.' . $step, compact('data'));
    }


    /**
     * SAVE EACH STEP TO SESSION
     */
    public function storeStep(Request $request, $step)
    {
        switch ($step) {

            // =========================== INFORMASI UMUM ===========================
            case 'informasi-umum':
                $validated = $request->validate([
                    'full_name'     => 'required|string|max:255',
                    'national_id'   => 'required|string|max:20',
                    'email'         => 'required|email',
                    'phone'         => 'required',
                    'birth_place'   => 'required|string',
                    'birth_date'    => 'required|date',
                    'gender'        => 'required|string',
                    'marital_status'=> 'required|string',
                    'spouse_name'   => 'nullable|string',
                    'last_education'=> 'required|string',
                    'religion'      => 'required|string',
                    'blood_type'    => 'required|string',
                    'bpjs_tk'       => 'nullable|string',
                    'bpjs_kes'      => 'nullable|string',
                    'npwp'          => 'nullable|string',
                    'skills'        => 'nullable|string',
                    'emergency_name'=> 'required|string',
                    'emergency_relation'=> 'required|string',
                    'emergency_phone'=> 'required|string',

                ]);

                session()->put('employee_wizard.informasi-umum', $validated);
                break;


            // =========================== ALAMAT KARYAWAN ===========================
            case 'alamat-karyawan':
                $validated = $request->validate([
                    // KTP
                    'ktp_address'   => 'required',
                    'ktp_province'  => 'required',
                    'ktp_city'      => 'required',
                    'ktp_district'  => 'required',
                    'ktp_village'   => 'required',
                    'ktp_postal'    => 'required',

                    // DOMISILI
                    'dom_address'   => 'required',
                    'dom_province'  => 'required',
                    'dom_city'      => 'required',
                    'dom_district'  => 'required',
                    'dom_village'   => 'required',
                    'dom_postal'    => 'required',
                ]);

                session()->put('employee_wizard.alamat-karyawan', $validated);
                break;


            // =========================== PENDIDIKAN ===========================
            case 'pendidikan':

                $validated = $request->validate([
                    'school_name.*' => 'required|string',
                    'city.*'        => 'required|string',
                    'major.*'       => 'required|string',
                    'year_in.*' => 'required|digits:4',
                    'year_out.*' => 'required|digits:4',

                ]);

                session()->put('employee_wizard.pendidikan', $validated);
                break;


            // =========================== TANGGUNGAN ===========================
            case 'tanggungan':

                $validated = $request->validate([
                    'dependent_name.*' => 'required|string',
                    'dependent_gender.*'   => 'required|string',
                    'dependent_birth.*'=> 'required|date',
                    'dependent_education.*'=> 'required|string',
                ]);

                session()->put('employee_wizard.tanggungan', $validated);
                break;


            // =========================== PEKERJAAN ===========================
            case 'pekerjaan':

                $validated = $request->validate([
                    'position.*'      => 'required|string',
                    'work_unit.*'    => 'required|string',
                    'start_date.*'    => 'required|date',
                    'end_date.*'      => 'nullable|date',
                    'work_note.*'         => 'nullable|string',
                ]);

                session()->put('employee_wizard.pekerjaan', $validated);
                break;


            // =========================== PELATIHAN ===========================
            case 'pelatihan':
                $validated = $request->validate([
                    'training_name.*' => 'required|string',
                    'training_provider.*'      => 'required|string',
                    'training_year.*'          => 'required|integer',
                    'training_location.*'      => 'nullable|string',
                    'training_certificate.*' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
                ]);
                $files = [];

                if ($request->hasFile('training_certificate')) {
                    foreach ($request->file('training_certificate') as $i => $file) {
                        $files[$i] = $file->store('temp_training', 'public');
                    }
                }

                // store path saja ke session
                $validated['training_certificate'] = $files;

                session()->put('employee_wizard.pelatihan', $validated);
                return redirect()->route('employee.create.review');
                break;
            

        }
        if($step == 'review'){
            return view('employee.create.index')->with('success', 'Karyawan baru berhasil ditambahkan.');
        }
        return redirect()->route('employee.create.step', $this->nextStep($step));
    }


    /**
     * FINAL SUBMIT → SAVE ALL SESSION DATA TO DB
     */
    public function finish(Request $request)
    {
        $data = session()->get('employee_wizard');
    

        if (!$data) {
            return redirect()->route('employee.create.step', 'informasi-umum')
                             ->with('error', 'Data belum lengkap.');
        }

        DB::beginTransaction();

        try {
            // ===================== SAVE EMPLOYEE =====================
            $emp = Employee::create([
                'full_name'     => $data['informasi-umum']['full_name'],
                'national_id'   => $data['informasi-umum']['national_id'],
                'email'         => $data['informasi-umum']['email'],
                'phone'         => $data['informasi-umum']['phone'],
                'birth_place'   => $data['informasi-umum']['birth_place'],
                'birth_date'    => $data['informasi-umum']['birth_date'],
                'gender'        => $data['informasi-umum']['gender'],
                'marital_status'=> $data['informasi-umum']['marital_status'],
                'last_education' => $data['informasi-umum']['last_education'],
                'religion'      => $data['informasi-umum']['religion'],
                'blood_type'    => $data['informasi-umum']['blood_type'],
                'bpjs_tk'       => $data['informasi-umum']['bpjs_tk'] ?? null,
                'bpjs_kes'      => $data['informasi-umum']['bpjs_kes'] ?? null,
                'npwp'          => $data['informasi-umum']['npwp'] ?? null,
                'skills' => json_encode(explode(',', $data['informasi-umum']['skills'])),
                'emergency_name'=> $data['informasi-umum']['emergency_name'],
                'emergency_relation'=> $data['informasi-umum']['emergency_relation'],
                'emergency_phone'=> $data['informasi-umum']['emergency_phone']
            ]);


            // ===================== SAVE ALAMAT =====================
            EmployeeAddress::create([
                'employee_id'   => $emp->id,
                'type'          => 'KTP',
                'address_line'  => $data['alamat-karyawan']['ktp_address'],
                'province'      => $data['alamat-karyawan']['ktp_province'],
                'city'          => $data['alamat-karyawan']['ktp_city'],
                'district'      => $data['alamat-karyawan']['ktp_district'],
                'village'       => $data['alamat-karyawan']['ktp_village'],
                'postal_code'   => $data['alamat-karyawan']['ktp_postal'],
            ]);

            EmployeeAddress::create([
                'employee_id'   => $emp->id,
                'type'          => 'CURRENT',
                'address_line'  => $data['alamat-karyawan']['dom_address'],
                'province'      => $data['alamat-karyawan']['dom_province'],
                'city'          => $data['alamat-karyawan']['dom_city'],
                'district'      => $data['alamat-karyawan']['dom_district'],
                'village'       => $data['alamat-karyawan']['dom_village'],
                'postal_code'   => $data['alamat-karyawan']['dom_postal'],
            ]);

            // ===================== PENDIDIKAN =====================
            foreach ($data['pendidikan']['school_name'] as $i => $v) {
                EmployeeEducation::create([
                    'employee_id' => $emp->id,
                    'school_name' => $v,
                    'city'        => $data['pendidikan']['city'][$i],
                    'major'       => $data['pendidikan']['major'][$i],
                    'year_in'     => $data['pendidikan']['year_in'][$i],
                    'year_out'    => $data['pendidikan']['year_out'][$i],
                ]);
            }

            // ===================== TANGGUNGAN =====================
            if (!empty($data['tanggungan']['dependent_name'])) {
                foreach ($data['tanggungan']['dependent_name'] as $i => $v) {
                    EmployeeChild::create([
                        'employee_id'   => $emp->id,
                        'name'          => $v,
                        'last_education'  => $data['tanggungan']['dependent_education'][$i],
                        'birth_date'    => $data['tanggungan']['dependent_birth'][$i],
                        'gender'        => $data['tanggungan']['dependent_gender'][$i],
                    ]);
                }
            }

            // ===================== PEKERJAAN =====================
            foreach ($data['pekerjaan']['position'] as $i => $v) {
                JobHistory::create([
                    'employee_id' => $emp->id,
                    'status'    => $v,
                    'unit'  => $data['pekerjaan']['work_unit'][$i],
                    'start_date'  => $data['pekerjaan']['start_date'][$i],
                    'end_date'    => $data['pekerjaan']['end_date'][$i] ?? null,
                    'note'       => $data['pekerjaan']['work_note'][$i] ?? null,
                ]);
            }

            // ===================== TRAINING =====================
            if (!empty($data['pelatihan']['training_name'])) {

            foreach ($data['pelatihan']['training_name'] as $i => $v) {

                // --- HANDLE FILE ---
                $certificatePath = null;

                // file input ada di $request, bukan session
                if ($request->hasFile("training_certificate.$i")) {
                    $file = $request->file("training_certificate.$i");
                    $certificatePath = $file->store('certificates', 'public');
                }

                EmployeeTraining::create([
                    'employee_id'      => $emp->id,
                    'title'            => $v,  // sesuai DB
                    'provider'         => $data['pelatihan']['training_provider'][$i],
                    'location'         => $data['pelatihan']['training_location'][$i] ?? null,
                    'year'             => $data['pelatihan']['training_year'][$i],
                    'certificate_path' => $certificatePath,
                ]);
            }
        }

            DB::commit();

            session()->forget('employee_wizard');

            return view('employee.create.index')->with('success', 'Karyawan baru berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating employee via wizard: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    /**
     * NEXT STEP LOGIC
     */
    private function nextStep($current)
    {
        $steps = [
            'informasi-umum',
            'alamat-karyawan',
            'pendidikan',
            'tanggungan',
            'pekerjaan',
            'pelatihan',
            'review'
        ];

        $index = array_search($current, $steps);

        return $steps[$index + 1] ?? 'pelatihan';
    }

    public function review()
    {
        $data = session()->get('employee_wizard');

        return view('employees.index', compact('data'));
    }

}
