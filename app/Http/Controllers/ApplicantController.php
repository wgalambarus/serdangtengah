<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
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
        'cv' => 'required|file|mimes:pdf|max:2048',
        // ... tambahkan validasi lainnya di sini
    ]);

    $fileFields = ['cv', 'pas_foto', 'transkrip_nilai', 'ktp', 'ijazah', 'kartu_bpjs', 'suket_pengalaman_kerja', 'daftar_riwayat_hidup'];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            // Simpan file ke storage dan masukkan path-nya ke array $validated
            $validated[$field] = $request->file($field)->store('dokumen/' . $field, 'public');
        }
    }
    
    // Simpan ke DB. Cek phpMyAdmin setelah ini, kolom file HARUS ada isinya.
    Applicant::create($validated);

    return response()->json(['success' => true, 'message' => 'Data tersimpan ke tabel applicants!']);
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

    public function getApplicantsByMonth()
    {
        $applicantsByMonth = Applicant::selectRaw('MONTH(created_at) as bulan, COUNT(*) as pelamar')
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

        return $applicantsByMonth;
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
    
// ApplicantController.php

public function rekrut($id)
{
    DB::beginTransaction();
    try {
        $applicant = Applicant::findOrFail($id);

        // 1. Buat data karyawan
        $employee = Employee::create([
            'employee_no'    => Employee::generateEmployeeNo(),
            'full_name'      => $applicant->nama_lengkap,
            'birth_place'    => $applicant->tempat_lahir,
            'birth_date'     => $applicant->tanggal_lahir,
            'gender'         => ($applicant->jenis_kelamin == 'Laki-laki') ? 'L' : 'P',
            'phone'          => $applicant->nomor_hp,
            'last_education' => $applicant->pendidikan_terakhir,
            'marital_status' => 'BELUM_MENIKAH',
            'national_id'    => 'KTP_' . time(),
        ]);

        // 2. PINDAHKAN SEMUA PATH FILE KE TABEL FILES (Satu Baris)
        DB::table('files')->insert([
            'employee_id'            => $employee->id,
            'cv'                     => $applicant->cv,
            'pas_foto'               => $applicant->pas_foto,
            'ktp'                    => $applicant->ktp,
            'ijazah'                 => $applicant->ijazah,
            'transkrip_nilai'        => $applicant->transkrip_nilai,
            'kartu_bpjs'             => $applicant->kartu_bpjs,
            'suket_pengalaman_kerja' => $applicant->suket_pengalaman_kerja,
            'daftar_riwayat_hidup'   => $applicant->daftar_riwayat_hidup,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);

        // $applicant->delete();
        DB::commit();

        return redirect()->route('employee.index')->with('success', "Berhasil! File sudah pindah ke tabel files.");
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }
}
}
