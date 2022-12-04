@extends('transaksi.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h2 class="mt-5 p-2 bg-white text-dark rounded-2">Kotak Sampah (Data Transaksi)</h2>
<div class="p-2 bg-white rounded-2">
    <h6 > Cari Data Transaksi :</h6>
	<form action="/transaksi/search" method="get" >
		<input class="p-1 rounded-3"type="text" name="search" placeholder="keterangan..." value="{{ old('search') }}">
		<input class="btn btn-primary rounded-3" type="submit" value="Search">
	</form>
</div>


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
        <th>ID Transaksi</th>
        <th>ID Barang</th>
        <th>ID Pembeli</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_transaksi }}</td>
                <td>{{ $data->id_barang }}</td>
                <td>{{ $data->id_pembeli }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->keterangan }}</td>
                
                <td>
                    <a href="{{ route('transaksi.restore', $data->id_transaksi) }}" type="button" class="btn btn-warning rounded-3"><i class="fa fa-pencil"></i>Restore</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_transaksi }}"> 
                        <i class="fa fa-trash"></i>Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_transaksi }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('transaksi.delete', $data->id_transaksi) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini?
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
    <a href="{{ route('transaksi.index') }}" type="button" class="mt-1 btn btn-primary p-2 rounded-3">Kembali</a>
</div>
@stop