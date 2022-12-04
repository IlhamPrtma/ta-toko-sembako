<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    public function index() {
        $datas = DB::select('select * from pembeli WHERE deleted_at is null');

        return view('pembeli.index')
            ->with('datas', $datas);
    }

    public function search(Request $request)
	{
		// menangkap data pensearchan
		$search = $request->search;
 
    	// mengambil data dari table Pembeli sesuai pencarian data
		$datas = DB::table('pembeli')
		->where('nama_pembeli','like',"%".$search."%")
		->paginate();
 
    	// mengirim data Pembeli ke view index
		return view('pembeli.index')
            ->with('datas', $datas);
	}

    public function create() {
        return view('pembeli.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'no_telp',
            'alamat',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO Pembeli(id_pembeli, nama_pembeli, no_telp, alamat, created_at, updated_at) VALUES (:id_pembeli, :nama_pembeli, :no_telp, :alamat, now(), now())',
        [
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]
        );

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pembeli')->where('id_pembeli', $id)->first();

        return view('pembeli.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'no_telp',
            'alamat',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE Pembeli SET id_pembeli = :id_pembeli, nama_pembeli = :nama_pembeli, no_telp = :no_telp, alamat = :alamat, updated_at = now() WHERE id_pembeli = :id',
        [
            'id' => $id,
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]
        );

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil diubah');
    }

    public function softDeleted($id){
        DB::update('UPDATE pembeli SET deleted_at = now() WHERE id_pembeli = :id_pembeli',
        [
            'id_pembeli' => $id,
        ]);
        return redirect('pembeli')->with('success', 'Data barang berhasil dibuang');
    }

    public function trash() {
        $datas = DB::select('select * from pembeli WHERE deleted_at is not null ');

        return view('pembeli.trash')
            ->with('datas', $datas);
    }

    public function restore($id){
        DB::update('UPDATE pembeli SET deleted_at = null WHERE id_pembeli = :id_pembeli',
        [
            'id_pembeli' => $id,
        ]);
        return redirect('pembeli')->with('success', 'Data barang berhasil di restore');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pembeli WHERE id_pembeli = :id_pembeli', ['id_pembeli' => $id]);

        return redirect('pembeli/trash')->with('success', 'Data Pembeli berhasil dihapus');
    }

}