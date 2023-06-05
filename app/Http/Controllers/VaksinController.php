<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksin;

class VaksinController extends Controller
{
    public function index()
    {
        $vaksin = Vaksin::where('tanggal_ovk', '!=', null)->orderBy('tanggal_ovk', 'desc')->get();
        return view('admin.pages.dataovk', [
            'vaksin' => $vaksin
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_ovk' => 'required|date',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required|numeric|integer|gt:0',
            'next_ovk' => 'required|date',
            'biaya_ovk' => 'required|numeric|integer|gt:0',
        ], [
                'tanggal_ovk.required' => 'Tanggal tidak boleh kosong',
                'tanggal_ovk.date' => 'Tanggal harus berupa tanggal',
                'jenis_ovk.required' => 'Jenis Vaksin tidak boleh kosong',
                'jumlah_ayam.required' => 'Jumlah Vaksin tidak boleh kosong',
                'jumlah_ayam.numeric' => 'Jumlah Vaksin harus berupa angka',
                'jumlah_ayam.integer' => 'Jumlah Vaksin harus berupa angka',
                'next_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'next_ovk.date' => 'Harga Satuan harus berupa tanggal',
                'biaya_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'biaya_ovk.numeric' => 'Harga Satuan harus berupa angka',
                'biaya_ovk.integer' => 'Harga Satuan harus berupa angka',
                'jumlah_ayam.gt' => 'Jumlah Vaksin tidak boleh kurang dari 0',
                'biaya_ovk.gt' => 'Harga Satuan tidak boleh kurang dari 0',
            ]);

        $totalbiaya = $request->biaya_ovk * $request->jumlah_ayam;

        Vaksin::create([
            'tanggal_ovk' => $request->tanggal_ovk,
            'jenis_ovk' => $request->jenis_ovk,
            'jumlah_ayam' => $request->jumlah_ayam,
            'next_ovk' => $request->next_ovk,
            'biaya_ovk' => $request->biaya_ovk,
            'total_biaya' => $totalbiaya
        ]);

        return redirect('/dataovk')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_ovk' => 'required|date',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required|numeric|integer|gt:0',
            'next_ovk' => 'required|date',
            'biaya_ovk' => 'required|numeric|integer|gt:0',
        ], [
                'tanggal_ovk.required' => 'Tanggal tidak boleh kosong',
                'tanggal_ovk.date' => 'Tanggal harus berupa tanggal',
                'jenis_ovk.required' => 'Jenis Vaksin tidak boleh kosong',
                'jumlah_ayam.required' => 'Jumlah Vaksin tidak boleh kosong',
                'jumlah_ayam.numeric' => 'Jumlah Vaksin harus berupa angka',
                'jumlah_ayam.integer' => 'Jumlah Vaksin harus berupa angka',
                'next_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'next_ovk.date' => 'Harga Satuan harus berupa tanggal',
                'biaya_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'biaya_ovk.numeric' => 'Harga Satuan harus berupa angka',
                'biaya_ovk.integer' => 'Harga Satuan harus berupa angka',
                'jumlah_ayam.gt' => 'Jumlah Vaksin tidak boleh kurang dari 0',
                'biaya_ovk.gt' => 'Harga Satuan tidak boleh kurang dari 0',
            ]);

        $totalbiaya = $request->biaya_ovk * $request->jumlah_ayam;

        Vaksin::find($id)->update([
            'tanggal_ovk' => $request->tanggal_ovk,
            'jenis_ovk' => $request->jenis_ovk,
            'jumlah_ayam' => $request->jumlah_ayam,
            'next_ovk' => $request->next_ovk,
            'biaya_ovk' => $request->biaya_ovk,
            'total_biaya' => $totalbiaya
        ]);

        return redirect('/dataovk')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Vaksin::find($id)->delete();
        return redirect('/dataovk')->with('delete', 'Data Berhasil Dihapus');
    }
}