<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeeSpouse;
use App\Models\EmployeeChild;
use App\Models\EmployeeEducation;
use App\Models\EmployeeTraining;
use App\Models\JobHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmployeePrintController extends Controller
{
    public function print(Request $request, $id)
    {
        // Ambil data dari popup/form
        $unit_kerja = $request->query('unit_kerja');
        $nik_kerja = $request->query('nik_kerja');
        $kepala_kebun = $request->query('kepala_kebun');

        $employee = Employee::findOrFail($id);


        $ktp = EmployeeAddress::where('employee_id', $id)
            ->where('type', 'KTP')
            ->first();

        $dom = EmployeeAddress::where('employee_id', $id)
            ->where('type', 'CURRENT')
            ->first();

        $spouse = EmployeeSpouse::where('employee_id', $id)->first();

        $children = EmployeeChild::where('employee_id', $id)->get();

        $educations = EmployeeEducation::where('employee_id', $id)
            ->orderBy('year_in')
            ->get();

        $trainings = EmployeeTraining::where('employee_id', $id)->get();

        $jobs = JobHistory::where('employee_id', $id)
            ->orderBy('start_date')
            ->get();

        $firstJob = $jobs->where('start_date', $jobs->min('start_date'))->first();



        $restJobs = $jobs->where('id', '!=', $firstJob->id);

        // 🔥 Ganti dari return view → PDF
        $pdf = Pdf::loadView('employees.print', compact(
            'employee',
            'ktp',
            'dom',
            'spouse',
            'children',
            'educations',
            'trainings',
            'jobs',
            'firstJob',
            'restJobs',
            'unit_kerja',
            'nik_kerja',
            'kepala_kebun'

        ))->setPaper('A4', 'portrait');

        return $pdf->stream('employee-' . $id . '.pdf');
    }
}