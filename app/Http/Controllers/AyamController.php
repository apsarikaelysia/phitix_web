<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use Illuminate\Http\Request;

class AyamController extends Controller
{
    public function index()
    {
        $ayam = Ayam::where('tanggal_masuk', '!=', null)->get();
        return view('admin.pages.dataayam', [
            'ayam' => $ayam
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric|integer',
            'harga_satuan' => 'required|numeric|integer',
            'mati' => 'required|numeric|integer',
        ], [
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'tanggal_masuk.date' => 'Tanggal Masuk harus berupa tanggal',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'jumlah_masuk.numeric' => 'Jumlah Masuk harus berupa angka',
                'jumlah_masuk.integer' => 'Jumlah Masuk harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'mati.required' => 'Mati tidak boleh kosong',
                'mati.numeric' => 'Mati harus berupa angka',
                'mati.integer' => 'Mati harus berupa angka',
            ]);

        $totalayam = $request->jumlah_masuk - $request->mati;
        $totalharga = $request->harga_satuan * $request->jumlah_masuk;

        Ayam::create([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $totalharga,
            'mati' => $request->mati,
            'total_ayam' => $totalayam
        ]);

        return redirect('/dataayam')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric|integer',
            'harga_satuan' => 'required|numeric|integer',
            'mati' => 'required|numeric|integer',
        ], [
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'tanggal_masuk.date' => 'Tanggal Masuk harus berupa tanggal',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'mati.numeric' => 'Mati harus berupa angka',
                'mati.required' => 'Mati tidak boleh kosong',
                'mati.integer' => 'Mati harus berupa angka',
            ]);

        $totalayam = $request->jumlah_masuk - $request->mati;
        $totalharga = $request->harga_satuan * $request->jumlah_masuk;

        Ayam::where('id', $id)->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $totalharga,
            'mati' => $request->mati,
            'total_ayam' => $totalayam
        ]);

        return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');

    }

    public function destroy($id)
    {
        Ayam::find($id)->delete();
        return redirect('/dataayam')->with('delete', 'Data Berhasil Dihapus');
    }
}