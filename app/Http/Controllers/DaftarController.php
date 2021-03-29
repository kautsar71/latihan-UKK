<?php

namespace App\Http\Controllers;
use PDF;
use DB;
use App\Models\Daftar;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftars = Daftar::latest()->paginate(5);
    
        return view('daftars.index',compact('daftars'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

     public function daftar_post()
    {
        return view('daftarr');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('daftars.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
         ]);

        Daftar::create($request->all());

        return redirect()->route('daftarsiswa')
            ->with('success', 'Data Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftar  $daftar
     * @return \Illuminate\Http\Response
     */
    public function show(Daftar $daftar)
    {
        return view('daftars.show', compact('daftar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daftar  $daftar
     * @return \Illuminate\Http\Response
     */
    public function edit(Daftar $daftar)
    {
        return view('daftars.edit', compact('daftar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daftar  $daftar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daftar $daftar)
    {
         $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'asal_sekolah' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
         ]);

         $daftar->update($request->all());

         return redirect()->route('daftars.index')
                        ->with('succes','Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftar  $daftar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daftar $daftar)
    {
        $daftar->delete();

        return redirect()->route('daftars.index')
                        ->with('succes','Data Berhasil Di Hapus');

    }
    public function generatePDF(Request $request)
    {
        $data_peserta = DB::table('daftars')
            ->where('id', $request->id)
            ->get();
        $nama = $data_peserta[0]->nama;
        $pdf = PDF::loadView('daftars.print', [
            'daftars' => $data_peserta
        ])
            ->setPaper('a4', 'potrait');

        return $pdf->stream($nama . '.pdf');
    }
}
