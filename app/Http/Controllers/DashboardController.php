<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Employee;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBulan = Applicant::selectRaw('MONTH(created_at) as bulan, COUNT(*) as pelamar')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->map(function($item){
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return [
                    'bulan' => $months[$item->bulan - 1],
                    'pelamar' => $item->pelamar
                ];
                })
                ->toArray();

            $employeeByPosition = Employee::select('employees.id')
                ->with(['latestPosition'=> function($query){
                    $query->select('id', 'employee_no', 'position_id')
                        ->with('position:id,name');

                }])
                ->get()
                ->groupBy(function($employee) {
                    return $employee->latestPosition?->position->name ?? 'Unassigned';
                })
                ->map(function($employees, $position){
                    return (object)[
                        'name' => $position,
                        'count' => count($employees)
                    ];
                })
                ->sortByDesc('count')
                ->values();

            return view('main.dashboard', compact('dataBulan', 'employeeByPosition'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}