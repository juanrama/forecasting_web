<?php

namespace App\Http\Controllers;

use App\FTM;
use Exception;
use App\Models\Akademik;
use DivisionByZeroError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAkademikRequest;
use App\Http\Requests\UpdateAkademikRequest;

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    
        return view('dashboard.predict.mhs', [
            'akademik' => Akademik::paginate(10),
            'angkatan_list' => Akademik::distinct()->orderBy('angkatan', 'desc')->pluck('angkatan'),
            'prodi_list' => Akademik::distinct()->orderBy('id_prodi', 'desc')->pluck('id_prodi'),
        ]);
    }

    public function cari(Request $request)
    {
        $akademik = Akademik::query();
        $angkatan_selected = $request->input('angkatan');
        $prodi_selected = $request->input('prodi');
        if ($angkatan_selected) {
            $akademik->where('angkatan', $angkatan_selected);
        }
        if ($prodi_selected) {
            $akademik->where('id_prodi', $prodi_selected);
        }
        $akademik = $akademik->paginate(10)->withQueryString();

        // Ambil data angkatan dan prodi untuk dropdown filter
        $angkatan_list = Akademik::distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        $prodi_list = Akademik::distinct()->orderBy('id_prodi', 'desc')->pluck('id_prodi');

        return view('dashboard.predict.mhs', [
            'akademik' => $akademik,
            'angkatan_list' => $angkatan_list,
            'prodi_list' => $prodi_list,
            'angkatan_selected' => $angkatan_selected,
            'prodi_selected' => $prodi_selected,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'id_mhs' => 'required|max:6|min:6|unique:akademiks',
            'angkatan' => 'required|integer|between:2016,2020',
            'id_prodi' => 'required|integer',
            'semester_1' => 'required|between:0,4.00',
            'semester_2' => 'required|between:0,4.00',
            'semester_3' => 'required|between:0,4.00',
            'semester_4' => 'required|between:0,4.00',
            'semester_5' => 'required|between:0,4.00',
        ]);

        Akademik::create($validatedData);

        return redirect('/mhsregresi')->with('success', 'Post baru telah ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $id_mhs = $request->input('id_mhs');
            $akademik = Akademik::where('id_mhs', $id_mhs)->first();
            if (!$akademik) {
                session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                return redirect()->back()->with('error', 'ID Mahasiswa tidak ditemukan di database.');
            }
                
            $nextPeriode = 1;
            $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5];
            $nilai2 = array(
                'Semester 1' => $akademik->semester_1,
                'Semester 2' => $akademik->semester_2,
                'Semester 3' => $akademik->semester_3,
                'Semester 4' => $akademik->semester_4,
                'Semester 5' => $akademik->semester_5,
            );
            $prediksi = new FTM($nilai2, $nextPeriode);  
            
            $nilai3 = [$prediksi->fx['Semester 1'], $prediksi->fx['Semester 2'], $prediksi->fx['Semester 3'], $prediksi->fx['Semester 4'], $prediksi->fx['Semester 5'], $prediksi->next_fx['Semester 6']];

            $prediksi_value = [
                'Semester 1' => $prediksi->fx['Semester 1'],
                'Semester 2' => $prediksi->fx['Semester 2'],
                'Semester 3' => $prediksi->fx['Semester 3'],
                'Semester 4' => $prediksi->fx['Semester 4'],
                'Semester 5' => $prediksi->fx['Semester 5'],
            ];

            return view('dashboard.predict.hasil', ['nilai' => json_encode($nilai1), 'akademik' => Akademik::all(), 'prediksi' => json_encode($nilai3), 'nilai_prediksi' => $prediksi, 'prediksi_value' => $prediksi_value]);
        }

        catch (DivisionByZeroError $e) {
            // Jika terjadi error pada proses prediksi, kembalikan halaman dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
            
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akademik $akademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAkademikRequest $request, Akademik $akademik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akademik $akademik)
    {
        //
    }
}
