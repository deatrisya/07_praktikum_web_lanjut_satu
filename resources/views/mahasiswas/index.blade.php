@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success"href="{{route('mahasiswa.create')}}">Input Mahasiswa</a>
       </div>
       <div class="col-md-6">
        <div class="float-left">
            <form action="{{url()->current()}}" method="get" class="form-inline">
                <div class="relative mx-auto">
                    <input type="search" name="keyword" value="{{request('keyword')}}"
                    placeholder="Search" class="form-control mr-sm-2">
                    <button type="submit" class="btn btn-outline-success my-2">Cari</button>
                    <a type="submit" class="btn btn-info" href="{{route('mahasiswa.index')}}"> Refresh</a>
                </div>
            </form>
        </div>
    </div>
   </div>
</div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="5%">Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No Handphone</th>
            <th width="350px">Action</th>
        </tr>
        @foreach ($mahasiswas as $Mahasiswa)
        <tr>
            {{-- {{dd($Mahasiswa)}} --}}

            <td>{{$Mahasiswa->nim}}</td>
            <td>{{$Mahasiswa->nama}}</td>
            <td>{{$Mahasiswa->kelas->nama_kelas}}</td>
            <td>{{$Mahasiswa->jurusan}}</td>
            <td>{{$Mahasiswa->no_handphone}}</td>
            <td>
                <form action="{{route('mahasiswa.destroy',$Mahasiswa->nim)}}" method="POST">
                    <a href="{{route('mahasiswa.show',$Mahasiswa->nim)}}" class="btn btn-info">Show</a>
                    <a href="{{route('mahasiswa.edit',$Mahasiswa->nim)}}" class="btn btn-info">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="{{route('mahasiswa.nilai',$Mahasiswa->nim)}}" class="btn btn-warning">Nilai</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="paginate-button col-md-12">
        {!! $mahasiswas->links() !!}
    </div>
@endsection
