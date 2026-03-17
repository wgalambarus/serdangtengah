<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeeSpouse;
use App\Models\EmployeeChild;
use App\Models\EmployeeEducation;
use App\Models\EmployeeTraining;
use App\Models\JobHistory;

class EmployeePrintController extends Controller
{

    public function print($id)
{
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

    return view('employees.print', compact(
        'employee',
        'ktp',
        'dom',
        'spouse',
        'children',
        'educations',
        'trainings',
        'jobs'
    ));
}

}