@extends('barang.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif
<body style="background-image: url('https://img.freepik.com/free-photo/abstract-grunge-decorative-relief-navy-blue-stucco-wall-texture-wide-angle-rough-colored-background_1258-28311.jpg?w=2000'); 
    background-repeat: no-repeat; 
    background-size: cover" >

<div class="card mt-4 mb-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Tambah Barang</h5>

		<form method="post" action="{{ route('barang.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang">
            </div>
			<div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="text" class="form-control" id="stok" name="stok">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-success" value="Tambah" />
                <a class="btn btn-primary" href="http://127.0.0.1:8000/barang" role="button">Kembali</a>
			</div>
		</form>
	</div>
</div>

@stop