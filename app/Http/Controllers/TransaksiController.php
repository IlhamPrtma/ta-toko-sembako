<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller

    {
        public function index() {
            $datas = DB::select('select * from transaksi WHERE deleted_at is null');
    
            return view('transaksi.index')
                ->with('datas', $datas);
        }
    
        public function search(Request $request)
        {
            // menangkap data pensearchan
            $search = $request->search;
     
            // mengambil data dari table Transaksi sesuai pencarian data
            $datas = DB::table('transaksi')
            ->where('keterangan','like',"%".$search."%")
            ->paginate();
     
            // mengirim data Transaksi ke view index
            return view('transaksi.index')
                ->with('datas', $datas);
        }
    
        public function create() {
            return view('transaksi.add');
        }
    
        public function store(Request $request) {
            $request->validate([
                'id_transaksi' => 'required',
                'id_barang' => 'required',
                'id_pembeli' => 'required',
                'tanggal' => 'required',
                'keterangan' => 'required',
            ]);
    
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::insert('INSERT INTO transaksi(id_transaksi, id_barang, id_pembeli, tanggal, keterangan, created_at, updated_at) VALUES (:id_transaksi, :id_barang, :id_pembeli, :tanggal, :keterangan, now(), now())',
            [    
                'id_transaksi' => $request->id_transaksi,
                'id_barang' => $request->id_barang,
                'id_pembeli' => $request->id_pembeli,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ]
            );
    
            return redirect()->route('transaksi.index')->with('success', 'Data Transaksi berhasil disimpan');
        }
    
        public function edit($id) {
            $data = DB::table('transaksi')->where('id_Transaksi', $id)->first();
    
            return view('transaksi.edit')->with('data', $data);
        }
    
        public function update($id, Request $request) {
            $request->validate([
                'id_transaksi' => 'required',
                'id_barang' => 'required',
                'id_pembeli' => 'required',
                'tanggal' => 'required',
                'keterangan' => 'required',
            ]);
    
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::update('UPDATE Transaksi SET id_transaksi = :id_transaksi, id_barang = :id_barang, id_pembeli = :id_pembeli, tanggal = :tanggal, keterangan = :keterangan, updated_at = now() WHERE id_transaksi = :id',
            [
                'id' => $id,
                'id_transaksi' => $request->id_transaksi,
                'id_barang' => $request->id_barang,
                'id_pembeli' => $request->id_pembeli,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ]
            );
    
            return redirect()->route('transaksi.index')->with('success', 'Data Transaksi berhasil diubah');
        }

        public function softDeleted($id){
            DB::update('UPDATE transaksi SET deleted_at = now() WHERE id_transaksi = :id_transaksi',
            [
                'id_transaksi' => $id,
            ]);
            return redirect('transaksi')->with('success', 'Data barang berhasil dibuang');
        }
    
        public function trash() {
            $datas = DB::select('select * from transaksi WHERE deleted_at is not null ');
    
            return view('transaksi.trash')
                ->with('datas', $datas);
        }
    
        public function restore($id){
            DB::update('UPDATE transaksi SET deleted_at = null WHERE id_transaksi = :id_transaksi',
            [
                'id_transaksi' => $id,
            ]);
            return redirect('transaksi')->with('success', 'Data barang berhasil di restore');
        }
    
        public function delete($id) {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::delete('DELETE FROM transaksi WHERE id_transaksi = :id_transaksi', ['id_transaksi' => $id]);
    
            return redirect('transaksi/trash')->with('success', 'Data Transaksi berhasil dihapus');
        }
    
    }

