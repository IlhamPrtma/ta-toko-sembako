<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function index() {
        $datas = DB::select('select * from data_transaksi');

        return view('informasi.index')
            ->with('datas', $datas);
    }

    public function search(Request $request)
	{
		// menangkap data pensearchan
		$search = $request->search;
 
    	// mengambil data dari table barang sesuai pencarian data
		$datas = DB::table('data_transaksi')
			->where('nama_barang','like',"%".$search."%")
			->paginate();
 
    	// mengirim data barang ke view index
		return view('informasi.index')
            ->with('datas', $datas);
	}

}