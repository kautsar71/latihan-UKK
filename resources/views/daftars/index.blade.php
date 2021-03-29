@extends('daftars.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Siswa</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('login') }}"> Kembali</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Asal Sekolah</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($daftars as $daftar)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $daftar->nis }}</td>
            <td>{{ $daftar->nama }}</td>
            <td>{{ $daftar->jenis_kelamin}}</td>
            <td>{{ $daftar->tempat_lahir}}</td>
            <td>{{ $daftar->tanggal_lahir}}</td>
            <td>{{ $daftar->alamat}}</td>
            <td>{{ $daftar->asal_sekolah}}</td>
            <td>{{ $daftar->kelas}}</td>
            <td>{{ $daftar->jurusan}}</td>
            <td>
                <form action="{{ route('daftars.destroy',$daftar->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('daftars.show',$daftar->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('daftars.edit',$daftar->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $daftars->links() !!}   
      
@endsection