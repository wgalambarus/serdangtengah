<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{

    public function index(Request $request)
    {
        $search        = $request->input('search');
        $tempatLahir   = $request->input('tempat_lahir');
        $jenisKelamin  = $request->input('jenis_kelamin');
        $umurMin       = $request->input('umur_min');
        $umurMax       = $request->input('umur_max');

        $sortBy   = $request->input('sort_by', 'created_at'); // default
        $sortDir  = $request->input('sort_dir', 'desc');      // default

        $applicants = Applicant::query()

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
            'applicants',
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
            'ktp' => 'required|file|mimes:pdf|max:2048',
            'ijazah' => 'required|file|mimes:pdf|max:2048',
            'kartu_bpjs' => 'required|file|mimes:pdf|max:2048',
            'suket_pengalaman_kerja' => 'required|file|mimes:pdf|max:2048',
            'daftar_riwayat_hidup' => 'required|file|mimes:pdf|max:2048'
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

        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('dokumen/ktp', 'public');
        }

        if ($request->hasFile('ijazah')) {
            $validated['ijazah'] = $request->file('ijazah')->store('dokumen/ijazah', 'public');
        }

        if ($request->hasFile('kartu_bpjs')) {
            $validated['kartu_bpjs'] = $request->file('kartu_bpjs')->store('dokumen/kartu_bpjs', 'public');
        }

        if ($request->hasFile('suket_pengalaman_kerja')) {
            $validated['suket_pengalaman_kerja'] = $request->file('suket_pengalaman_kerja')->store('dokumen/suket_pengalaman_kerja', 'public');
        }

        if ($request->hasFile('daftar_riwayat_hidup')) {
            $validated['daftar_riwayat_hidup'] = $request->file('daftar_riwayat_hidup')->store('dokumen/daftar_riwayat_hidup', 'public');
        }
        
        Applicant::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return response()->json([
            'success' => true,
            'data' => $applicant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        return response()->json([
            'success' => true,
            'data' => $applicant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
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
            'ktp' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf|max:2048',
            'kartu_bpjs' => 'nullable|file|mimes:pdf|max:2048',
            'suket_pengalaman_kerja' => 'nullable|file|mimes:pdf|max:2048',
            'daftar_riwayat_hidup' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file uploads and delete old files
        if ($request->hasFile('cv')) {
            if ($applicant->cv) {
                Storage::disk('public')->delete($applicant->cv);
            }
            $validated['cv'] = $request->file('cv')->store('dokumen/cv', 'public');
        }

        if ($request->hasFile('pas_foto')) {
            if ($applicant->pas_foto) {
                Storage::disk('public')->delete($applicant->pas_foto);
            }
            $validated['pas_foto'] = $request->file('pas_foto')->store('dokumen/pas_foto', 'public');
        }

        if ($request->hasFile('transkrip_nilai')) {
            if ($applicant->transkrip_nilai) {
                Storage::disk('public')->delete($applicant->transkrip_nilai);
            }
            $validated['transkrip_nilai'] = $request->file('transkrip_nilai')->store('dokumen/transkrip', 'public');
        }

        if ($request->hasFile('ktp')) {
            if ($applicant->ktp) {
                Storage::disk('public')->delete($applicant->ktp);
            }
            $validated['ktp'] = $request->file('ktp')->store('dokumen/ktp', 'public');
        }

        if ($request->hasFile('ijazah')) {
            if ($applicant->ijazah) {
                Storage::disk('public')->delete($applicant->ijazah);
            }
            $validated['ijazah'] = $request->file('ijazah')->store('dokumen/ijazah', 'public');
        }

        if ($request->hasFile('kartu_bpjs')) {
            if ($applicant->kartu_bpjs) {
                Storage::disk('public')->delete($applicant->kartu_bpjs);
            }
            $validated['kartu_bpjs'] = $request->file('kartu_bpjs')->store('dokumen/kartu_bpjs', 'public');
        }

        if ($request->hasFile('suket_pengalaman_kerja')) {
            if ($applicant->suket_pengalaman_kerja) {
                Storage::disk('public')->delete($applicant->suket_pengalaman_kerja);
            }
            $validated['suket_pengalaman_kerja'] = $request->file('suket_pengalaman_kerja')->store('dokumen/suket_pengalaman_kerja', 'public');
        }

        if ($request->hasFile('daftar_riwayat_hidup')) {
            if ($applicant->daftar_riwayat_hidup) {
                Storage::disk('public')->delete($applicant->daftar_riwayat_hidup);
            }
            $validated['daftar_riwayat_hidup'] = $request->file('daftar_riwayat_hidup')->store('dokumen/daftar_riwayat_hidup', 'public');
        }


        $applicant->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil diperbarui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        // Delete associated files
        if ($applicant->cv) {
            Storage::disk('public')->delete($applicant->cv);
        }
        if ($applicant->pas_foto) {
            Storage::disk('public')->delete($applicant->pas_foto);
        }
        if ($applicant->transkrip_nilai) {
            Storage::disk('public')->delete($applicant->transkrip_nilai);
        }

        $applicant->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data pelamar berhasil dihapus!'
        ]);
    }
}
