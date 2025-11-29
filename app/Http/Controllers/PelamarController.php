<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search        = $request->input('search');
        $tempatLahir   = $request->input('tempat_lahir');
        $jenisKelamin  = $request->input('jenis_kelamin');
        $umurMin       = $request->input('umur_min');
        $umurMax       = $request->input('umur_max');

        // Sorting
        $sortBy   = $request->input('sort_by', 'created_at'); // default
        $sortDir  = $request->input('sort_dir', 'desc');      // default

        $pelamars = Pelamar::query()

            // --- SEARCH ---
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
                });
            })

            // --- FILTER TEMPAT LAHIR ---
            ->when($tempatLahir, function ($query) use ($tempatLahir) {
                $query->where('tempat_lahir', 'LIKE', "%{$tempatLahir}%");
            })

            // --- FILTER JENIS KELAMIN ---
            ->when($jenisKelamin, function ($query) use ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })

            // --- FILTER UMUR ---
            ->when($umurMin, function ($query) use ($umurMin) {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?", [$umurMin]);
            })
            ->when($umurMax, function ($query) use ($umurMax) {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= ?", [$umurMax]);
            })

            // --- SORTING DINAMIS ---
            ->orderBy($sortBy, $sortDir)

            ->paginate(10)
            ->appends($request->all());

        return view('main.pelamar', compact(
            'pelamars',
            'search',
            'tempatLahir',
            'jenisKelamin',
            'umurMin',
            'umurMax',
            'sortBy',
            'sortDir'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'pas_foto' => 'required|file|mimes:pdf|max:2048',
            'transkrip_nilai' => 'required|file|mimes:pdf|max:2048',
        ]);


        // Handle file uploads
        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('dokumen/cv', 'public');
        }

        if ($request->hasFile('pas_foto')) {
            $validated['pas_foto'] = $request->file('pas_foto')->store('dokumen/pas_foto', 'public');
        }

        if ($request->hasFile('transkrip_nilai')) {
            $validated['transkrip_nilai'] = $request->file('transkrip_nilai')->store('dokumen/transkrip', 'public');
        }

        Pelamar::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelamar $pelamar)
    {
        return response()->json([
            'success' => true,
            'data' => $pelamar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelamar $pelamar)
    {
        return response()->json([
            'success' => true,
            'data' => $pelamar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelamar $pelamar)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:20',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'pas_foto' => 'nullable|file|mimes:pdf|max:2048',
            'transkrip_nilai' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file uploads and delete old files
        if ($request->hasFile('cv')) {
            if ($pelamar->cv) {
                Storage::disk('public')->delete($pelamar->cv);
            }
            $validated['cv'] = $request->file('cv')->store('dokumen/cv', 'public');
        }

        if ($request->hasFile('pas_foto')) {
            if ($pelamar->pas_foto) {
                Storage::disk('public')->delete($pelamar->pas_foto);
            }
            $validated['pas_foto'] = $request->file('pas_foto')->store('dokumen/pas_foto', 'public');
        }

        if ($request->hasFile('transkrip_nilai')) {
            if ($pelamar->transkrip_nilai) {
                Storage::disk('public')->delete($pelamar->transkrip_nilai);
            }
            $validated['transkrip_nilai'] = $request->file('transkrip_nilai')->store('dokumen/transkrip', 'public');
        }

        $pelamar->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil diperbarui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelamar $pelamar)
    {
        // Delete associated files
        if ($pelamar->cv) {
            Storage::disk('public')->delete($pelamar->cv);
        }
        if ($pelamar->pas_foto) {
            Storage::disk('public')->delete($pelamar->pas_foto);
        }
        if ($pelamar->transkrip_nilai) {
            Storage::disk('public')->delete($pelamar->transkrip_nilai);
        }

        $pelamar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil dihapus!'
        ]);
    }
}
