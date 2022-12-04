<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index() {
        $datas = DB::select('select * from barang WHERE deleted_at is null ');

        return view('barang.index')
            ->with('datas', $datas);
    }

    public function search(Request $request)
	{
		// menangkap data pensearchan
		$search = $request->search;
 
    	// mengambil data dari table barang sesuai pencarian data
		$datas = DB::table('barang')
		->where('nama_barang','like',"%".$search."%")
		->paginate();
 
    	// mengirim data barang ke view index
		return view('barang.index')
            ->with('datas', $datas);
	}

    public function create() {
        return view('barang.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO barang(id_barang, nama_barang, harga, stok, created_at, updated_at) VALUES (:id_barang, :nama_barang, :harga, :stok, now(), now())',
        [
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]
        );

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('barang')->where('id_barang', $id)->first();

        return view('barang.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE barang SET id_barang = :id_barang, nama_barang = :nama_barang, harga = :harga, stok = :stok, updated_at = now() WHERE id_barang = :id',
        [
            'id' => $id,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]
        );

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
    }

    public function softDeleted($id){
        DB::update('UPDATE barang SET deleted_at = now() WHERE id_barang = :id_barang',
        [
            'id_barang' => $id,
        ]);
        return redirect('barang')->with('success', 'Data barang berhasil dibuang');
    }

    public function trash() {
        $datas = DB::select('select * from barang WHERE deleted_at is not null ');

        return view('barang.trash')
            ->with('datas', $datas);
    }

    public function restore($id){
        DB::update('UPDATE barang SET deleted_at = null WHERE id_barang = :id_barang',
        [
            'id_barang' => $id,
        ]);
        return redirect('barang/trash')->with('success', 'Data barang berhasil di restore');
    }


    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM barang WHERE id_barang = :id_barang', 
        [
            'id_barang' => $id
        ]);

        return redirect('barang/trash')->with('success', 'Data barang berhasil dihapus');
    }

}