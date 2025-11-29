<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
