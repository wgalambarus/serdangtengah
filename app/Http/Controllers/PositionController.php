<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongans = JobPosition::paginate(6);
        return view('lowongan.index', compact('lowongans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'salary'      => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'is_active'   => 'required|boolean',
        ]);

        JobPosition::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'location'    => $validated['location'],
            'salary'      => $validated['salary'],
            'start_date'  => $validated['start_date'],
            'end_date'    => $validated['end_date'],
            'is_active'   => $validated['is_active'],
        ]);

        return redirect()->route('lowongan.index')
                         ->with('success', 'Lowongan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosition $jobPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $job = JobPosition::findOrFail($id);
        return view('lowongan.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'salary'      => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'is_active'   => 'required|boolean',
        ]);

        $job = JobPosition::findOrFail($id);
        $job->update($validated);

        return redirect()->route('lowongan.index')
                         ->with('success', 'Lowongan berhasil diperbarui.');
    }
    public function applicants($id)
{
    $search = request('search');
    $sort   = request('sort');

    $job = JobPosition::findOrFail($id);

    // Load pelamar dari pivot
    $pelamars = $job->pelamars()
        ->withPivot('score', 'created_at')
        ->when($search, function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%");
        })
        ->when($sort, function($q) use ($sort) {

            switch ($sort) {
                case 'name_asc':
                    $q->orderBy('nama_lengkap', 'asc');
                    break;

                case 'name_desc':
                    $q->orderBy('nama_lengkap', 'desc');
                    break;

                case 'latest':
                    $q->orderBy('job_position_pelamar.created_at', 'desc');
                    break;

                case 'oldest':
                    $q->orderBy('job_position_pelamar.created_at', 'asc');
                    break;

                case 'score_high':
                    $q->orderBy('job_position_pelamar.score', 'desc');
                    break;

                case 'score_low':
                    $q->orderBy('job_position_pelamar.score', 'asc');
                    break;
            }

        })
        ->orderBy('job_position_pelamar.created_at', 'desc')
        ->paginate(10)
        ->withQueryString();



    // ======================================================
    //  AUTO-SCORING: Hitung hanya jika score masih NULL
    // ======================================================
    foreach ($pelamars as $pelamar) {

        if ($pelamar->pivot->score === null) {

            // Ambil CV URL (misal dari storage)
            $cvUrl = asset('storage/' . $pelamar->cv);

            // Convert URL → absolute file path agar Python bisa baca PDF
            $localPath = public_path('storage/' . $pelamar->cv);

            // Kalau file ga ada, skip (jangan error-in halaman)
            if (!file_exists($localPath)) {
                continue;
            }

            try {
                // Kirim ke Python AI service
                $result = Http::timeout(60)->post("http://127.0.0.1:5001/score", [
                    "cv_path" => $localPath,
                    "job_description" => $job->description,
                ]);

                // Ambil skor
                $score = $result->ok()
                    ? ($result->json()['score'] ?? 0)
                    : 0;

            } catch (\Exception $e) {
                $score = 0;
            }

            // Simpan skor ke pivot
            $pelamar->jobPositions()
                ->updateExistingPivot($job->id, ['score' => $score]);

            // Update in-memory agar UI langsung tampil
            $pelamar->pivot->score = $score;
        }
    }


    return view('lowongan.applicant', compact('job', 'pelamars', 'search', 'sort'));
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosition $jobPosition)
    {
        //
    }

    public function disable($id)
    {
        $job = JobPosition::findOrFail($id);
        $job->update(['is_active' => 0]);

        return back()->with('success', 'Lowongan dinonaktifkan.');
    }

    public function enable($id)
    {
        $job = JobPosition::findOrFail($id);
        $job->update(['is_active' => 1]);

        return back()->with('success', 'Lowongan diaktifkan.');
    }

}
