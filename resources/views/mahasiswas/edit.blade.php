@extends('mahasiswas.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('mahasiswa.update',$Mahasiswa->nim)}}" id="myForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="nim" value="{{$Mahasiswa->nim}}"
                            ariadescribedby="nim">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{$Mahasiswa->nama}}"
                            ariadescribedby="nama">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach ($kelas as $kls)
                                <option value="{{$kls->id}}" {{$Mahasiswa->kelas_id == $kls->id ? 'selected' : ''}}>{{$kls->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" id="jurusan"
                            value="{{$Mahasiswa->jurusan}}" ariadescribedby="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="no_handphone">No_Handphone</label>
                        <input type="text" name="no_handphone" class="form-control" id="no_handphone"
                            value="{{$Mahasiswa->no_handphone}}" ariadescribedby="no_handphone">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
