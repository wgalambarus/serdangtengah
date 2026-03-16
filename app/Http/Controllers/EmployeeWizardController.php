<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\EmployeeAddress;
use App\Models\JobHistory;
use App\Models\EmployeeChild;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeTraining;
use Illuminate\Support\Facades\Validator;


class EmployeeWizardController extends Controller
{

private array $steps = [
    'informasi-umum',
    'alamat-karyawan',
    'pendidikan',
    'tanggungan',
    'pekerjaan',
    'pelatihan',
    'review'

];

public function index()
{
    return redirect()->route('employee.create.step', 'informasi-umum');
}

private function guardStepAccess(string $step)
{
    $allData = session()->get('employee_wizard', []);
    $index = array_search($step, $this->steps);

    if ($index === 0) return null;

    for ($i = 0; $i < $index; $i++) {
        if (!isset($allData[$this->steps[$i]])) {
            return redirect()
                ->route('employee.create.step', $this->steps[$i])
                ->with('error', 'Silakan lengkapi step sebelumnya.');
        }
    }

    return null;
}

public function show($step)
{ 

    if (!in_array($step, $this->steps)) {
        abort(404);
    }

    $redirect = $this->guardStepAccess($step);
    if ($redirect) return $redirect;

    $data = session()->get("employee_wizard.$step", []);

    return view("employees.create.$step", compact('data'));
}

public function validateStep(Request $request, string $step)
{
    return match ($step) {

        'informasi-umum' => $request->validate([
            'full_name'          => 'required|string|max:255',
            'national_id'        => 'required|digits:16|unique:employees,national_id',
            'email'              => 'required|email|max:255|unique:employees,email',
            'phone'              => 'required|string|max:20',

            'birth_place'        => 'required|string|max:255',
            'birth_date'         => 'required|date',

            'gender'             => 'required|string|max:20',
            'marital_status'     => 'required|string|max:20',
            'spouse_name'        => 'nullable|string|max:255',

            'last_education'     => 'required|string|max:50',
            'religion'           => 'required|string|max:50',
            'blood_type'         => 'required|string|max:5',

            'bpjs_tk'            => 'nullable|string|max:30',
            'bpjs_kes'           => 'nullable|string|max:30',
            'npwp'               => 'nullable|string|max:30',

            'emergency_name'     => 'required|string|max:255',
            'emergency_relation' => 'required|string|max:50',
            'emergency_phone'    => 'required|string|max:20',
        ]),

        'alamat-karyawan' => $request->validate([

            // KTP
            'ktp_address'   => 'required|string|max:255',
            'ktp_province'  => 'required|string|max:100',
            'ktp_city'      => 'required|string|max:100',
            'ktp_district'  => 'required|string|max:100',
            'ktp_village'   => 'required|string|max:100',
            'ktp_postal'    => 'required|digits_between:4,6',

            // DOMISILI
            'dom_address'   => 'required|string|max:255',
            'dom_province'  => 'required|string|max:100',
            'dom_city'      => 'required|string|max:100',
            'dom_district'  => 'required|string|max:100',
            'dom_village'   => 'required|string|max:100',
            'dom_postal'    => 'required|digits_between:4,6',
        ]),

        'pendidikan' => (function () use ($request) {

            $validator = Validator::make($request->all(), [
                'school_name.*' => 'required|string|max:255',
                'city.*'        => 'required|string|max:255',
                'major.*'       => 'required|string|max:255',

                'year_in.*'  => 'required|integer|between:1900,' . date('Y'),
                'year_out.*' => 'required|integer|between:1900,' . date('Y'),
            ]);

            // Validasi logika tahun
            $validator->after(function ($validator) use ($request) {

                if (!$request->year_in || !$request->year_out) {
                    return;
                }

                foreach ($request->year_in as $i => $yearIn) {

                    if (isset($request->year_out[$i])) {

                        $yearOut = $request->year_out[$i];

                        if ($yearOut < $yearIn) {
                            $validator->errors()->add(
                                "year_out.$i",
                                "Year out must be greater than or equal to year in."
                            );
                        }
                    }
                }
            });

            return $validator->validate();

        })(),

        'tanggungan' => $request->validate([
            'dependent_name' => 'nullable|array',

            'dependent_name.*'      => 'nullable|string|max:255',
            'dependent_gender.*'    => 'nullable|string|max:20',
            'dependent_birth.*'     => 'nullable|date',
            'dependent_education.*' => 'nullable|string|max:100',
        ]),

        'pekerjaan' => $request->validate([
            'position.*'   => 'required|string|max:255',
            'work_unit.*'  => 'required|string|max:255',
            'start_date.*' => 'required|date',
            'work_note.*'  => 'nullable|string|max:500',
        ]),

        'pelatihan' => (function () use ($request) {

            $validated = $request->validate([
                'training_name.*'        => 'nullable|string|max:255',
                'training_provider.*'    => 'nullable|string|max:255',
                'training_year.*'        => 'nullable|integer|between:1900,' . date('Y'),
                'training_location.*'    => 'nullable|string|max:255',

                'training_certificate.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // handle upload supaya session hanya simpan path
            if ($request->hasFile('training_certificate')) {

                foreach ($request->file('training_certificate') as $i => $file) {

                    if ($file) {

                        $validated['training_certificate'][$i] =
                            $file->store('temp/training_certificates', 'public');
                    }
                }
            }

            return $validated;

        })(),

        default => $request->all()
    };
}

private function isWizardComplete(?array $data): bool
{
    if (!$data) return false;

    foreach ($this->steps as $step) {
        if ($step === 'review') continue;

        if (!isset($data[$step])) {
            return false;
        }
    }

    return true;
}



public function storeStep(Request $request, string $step)
{
    if (!in_array($step, $this->steps)) {
        abort(404);
    }

    $validated = $this->validateStep($request, $step);

    session()->put("employee_wizard.$step", $validated);

    if ($step === 'pelatihan') {
        return redirect()->route('employee.create.review');
    }

    return redirect()->route(
        'employee.create.step',
        $this->nextStep($step)
    );
}

private function nextStep(string $current): string
{
    $index = array_search($current, $this->steps);

    return $this->steps[$index + 1] ?? 'review';
}



/**
 * FINAL SUBMIT → SAVE ALL SESSION DATA TO DB
*/
public function finish(Request $request)
{
    $data = session()->get('employee_wizard');

    if (!$this->isWizardComplete($data)) {
        return redirect()
            ->route('employee.create.step', 'informasi-umum')
            ->with('error', 'Data wizard tidak lengkap.');
    }

    DB::beginTransaction();

    try {
        // ===================== SAVE EMPLOYEE =====================
        $emp = Employee::create([
            'employee_no' => Employee::generateEmployeeNo(),
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
        foreach ($data['tanggungan']['dependent_name'] ?? [] as $i => $name) {

            if (!$name) continue;

            EmployeeChild::create([
                'employee_id' => $emp->id,
                'name' => $name,
                'last_education' => $data['tanggungan']['dependent_education'][$i] ?? null,
                'birth_date' => $data['tanggungan']['dependent_birth'][$i] ?? null,
                'gender' => $data['tanggungan']['dependent_gender'][$i] ?? null,
            ]);
        }
        // ===================== PEKERJAAN =====================
        foreach ($data['pekerjaan']['position'] as $i => $v) {
            JobHistory::create([
                'employee_id' => $emp->id,
                'status'    => $v,
                'unit'  => $data['pekerjaan']['work_unit'][$i],
                'start_date'  => $data['pekerjaan']['start_date'][$i],
                'note'       => $data['pekerjaan']['work_note'][$i] ?? null,
            ]);
        }

        // ===================== TRAINING =====================
        foreach ($data['pelatihan']['training_name'] ?? [] as $i => $training) {

            if (!$training) continue;

            $certificates = $data['pelatihan']['training_certificate'] ?? [];

            EmployeeTraining::create([
                'employee_id' => $emp->id,
                'title' => $training,
                'provider' => $data['pelatihan']['training_provider'][$i] ?? null,
                'location' => $data['pelatihan']['training_location'][$i] ?? null,
                'year' => $data['pelatihan']['training_year'][$i] ?? null,
                'certificate_path' => $certificates[$i] ?? null,
            ]);
        }

        DB::commit();

        session()->forget('employee_wizard');

        return redirect()->route('employee.index')->with('success', 'Karyawan baru berhasil ditambahkan.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error creating employee via wizard: ' . $e->getMessage());
        return back()->with('error', $e->getMessage());
    }
}


public function review()
{
    $data = session()->get('employee_wizard');

    if (!$this->isWizardComplete($data)) {
        return redirect()
            ->route('employee.create.step', 'informasi-umum')
            ->with('error', 'Silakan lengkapi semua step.');
    }

    return view('employees.create.review', [
        'd' => $data
    ]);
}

}
