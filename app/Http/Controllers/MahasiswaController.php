<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); //Mengambil semua isi tabel

        //yang semula mahasiswa all diubah menjadi with
        $pagination = 2;
        $mahasiswas =Mahasiswa::with('kelas')->when($request->keyword, function($query) use ($request){
            $query
            ->where('nim','like',"%{$request->keyword}%")
            ->orWhere('nama','like',"%{$request->keyword}%")
            ->orWhere('jurusan','like',"%{$request->keyword}%")
            ->orWhere('no_handphone','like',"%{$request->keyword}%")
            ->orWhereHas('kelas',function (Builder $kelas) use ($request){
                $kelas->where('nama_kelas', 'like', "%{$request->keyword}%");
            });
        })
        ->orderBy('nim')
        ->paginate($pagination);
        //note : jika sudah menggunakan pagination tidak perlu function get().

        // $mahasiswas = Mahasiswa::with('kelas')->get(); //mengambil semua isi tabel
        // $mahasiswas = Mahasiswa::orderBy('Nim')->paginate(6);
        $mahasiswas->appends($request->only('keyword'));
        return view('mahasiswas.index',compact('mahasiswas'))
            ->with('i', (request()->input('page',1)-1)*$pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'foto' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
        ]);



        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_handphone = $request->get('no_handphone');

        if ($request->file('foto')) {
            $image_name = $request -> file('foto')->store('images','public');
        }

        $mahasiswa->foto = $image_name;
        // $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        // fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        // jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //code sebelum dibuat relasi --> $Mahasiswa = Mahasiswa::find($nim);
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        return view('mahasiswas.detail',['Mahasiswa' => $Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
         //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        //  $Mahasiswa = Mahasiswa::find($nim);
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        $kelas = Kelas::all();
         return view('mahasiswas.edit',compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //Melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
        ]);



        // fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($nim)->update($request->all());
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        $Mahasiswa->nim = $request->get('nim');
        $Mahasiswa->nama = $request->get('nama');
        $Mahasiswa->jurusan = $request->get('jurusan');
        $Mahasiswa->no_handphone = $request->get('no_handphone');

        if ($request->hasFile('foto')) {
            if ($Mahasiswa->foto && file_exists(storage_path('app/public/'.$Mahasiswa->foto))) {
                Storage::delete('public/'.$Mahasiswa->foto);
            }
            $image_name = $request->file('foto')->store('images','public');
            $Mahasiswa->foto = $image_name;
        }

        $Mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();

        // jika data berhasil diupdate,akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        // fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa berhasil Dihapus');
    }
    public function showNilai($nim)
    {
        // menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa

        // $Mahasiswa = Mahasiswa_Matakuliah::with('mhs_matkul')->where('mahasiswa_id',$nim)->get();
        $Mahasiswa = Mahasiswa::where('nim',$nim)->first();
        // $Mahasiswa = Mahasiswa::with('matakuliah')->get();
        // dd($Mahasiswa->matakuliah);

        return view('mahasiswas.detailnilai',['Mahasiswa' => $Mahasiswa]);
    }

    public function cetak_pdf($nim){
        $Mahasiswa = Mahasiswa::where('nim',$nim)->first();
        $pdf = PDF::loadview('mahasiswas.cetakKHS',['Mahasiswa'=>$Mahasiswa]);
        return $pdf->stream();
    }
}
