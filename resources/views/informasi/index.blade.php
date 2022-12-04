@extends('informasi.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h2 class="mt-5 p-2 bg-white text-dark rounded-2">Informasi Transaksi</h2>
<div class="p-2 bg-white rounded-2">
    <h6 > Cari Transaksi :</h6>
	<form action="/info/search" method="get" >
		<input class="p-1 rounded-3"type="text" name="search" placeholder="Nama Barang..." value="{{ old('search') }}">
		<input class="btn btn-primary rounded-3" type="submit" value="Search">
	</form>
</div>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif
<body style="background-image: url('https://img.freepik.com/free-vector/memphis-blue-background-with-halftone-line-elements_1017-33622.jpg?w=1380&t=st=1669977800~exp=1669978400~hmac=385e492bba448ffae6bbfa454a5ea599536e7dacbbd77287ee016578637dbcc2'); 
    background-repeat: no-repeat; 
    background-size: cover" >
    
</body>
<table class="table text-center table-hover mt-2 mb-4 bg-light p-2 rounded-2" >
    <thead>
      <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Tanggal</th>
        <th>Nama Pembeli</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_barang }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->harga }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->nama_pembeli }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card-footer">
    <a href="{{ route('logout') }}" class="mb-3 btn btn-danger btn-block">Logout</a>
</div>
@stop