@extends('pembeli.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h2 class="mt-5 p-2 bg-white text-dark rounded-2">Data Pembeli</h2>
<div class="p-2 bg-white rounded-2">
    <h6 > Cari Data Pembeli :</h6>
	<form action="/pembeli/search" method="get" >
		<input class="p-1 rounded-3"type="text" name="search" placeholder="Nama Pembeli..." value="{{ old('search') }}">
		<input class="btn btn-primary rounded-3" type="submit" value="Search">
	</form>
</div>


<a href="{{ route('pembeli.create') }}" type="button" class="mt-1 btn btn-success p-2 rounded-3">Tambah Data</a>
<a href="{{ route('pembeli.trash') }}" type="button" class="mt-1 btn btn-secondary p-2 rounded-3">Kotak Sampah</a>


@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif
<body style="background-image: url('https://img.freepik.com/free-photo/abstract-grunge-decorative-relief-navy-blue-stucco-wall-texture-wide-angle-rough-colored-background_1258-28311.jpg?w=2000'); 
    background-repeat: no-repeat; 
    background-size: cover" >
    
</body>
<table class="table text-center table-hover mt-2 bg-light p-2 rounded-2" >
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Pembeli</th>
        <th>NO Telepon</th>
        <th>Alamat</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_pembeli }}</td>
                <td>{{ $data->nama_pembeli }}</td>
                <td>{{ $data->no_telp }}</td>
                <td>{{ $data->alamat }}</td>
                
                <td>
                    <a href="{{ route('pembeli.edit', $data->id_pembeli) }}" type="button" class="btn btn-warning rounded-3"><i class="fa fa-pencil"></i>Ubah</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_pembeli }}"> <i class="fa fa-trash"></i>
                        Buang
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_pembeli }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('pembeli.softDeleted', $data->id_pembeli) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin membuang data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer">
    <a href="{{ route('informasi.index') }}" type="button" class="mt-1 btn btn-primary p-2 rounded-3">Kembali</a>
</div>
@stop