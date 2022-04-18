@extends('mahasiswas.layout')
@section('content')

<div class="text-center mb-5">
    <h3>KARTU HASIL STUDI (KHS)</h3>
</div>

    <div class="row">
        <div class="biodata">
            <table border="0">
                <tr>
                    <td>Nama : </td>
                    <td>{{$Mahasiswa->nama}}</td>
                </tr>
                <tr>
                    <td>Nim &nbsp; &nbsp;: </td>
                    <td>{{$Mahasiswa->nim}}</td>
                </tr>
                <tr>
                    <td>Kelas &nbsp;: </td>
                    <td>{{$Mahasiswa->kelas->nama_kelas}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-5">
        <div class="detail-matakuliah col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Matakuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Mahasiswa ->matakuliah as $data)
                    {{-- {{dd($Mahasiswa->matakuliah)}} --}}
                        <tr>
                            <td>{{$data->nama_matkul}}</td>
                            <td>{{$data->sks}}</td>
                            <td>{{$data->semester}}</td>
                            <td>{{$data->pivot->nilai}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
