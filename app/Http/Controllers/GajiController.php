<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::where('tanggal', '!=', null)->orderBy('tanggal', 'desc')->get();
        return view('admin.pages.datatenagakerja', [
            'gaji' => $gaji
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string',
            'jabatan' => 'required|string',
            'gaji' => 'required|numeric|integer|gte:0',
            'tanggal' => 'required|date',
        ], [
                'nama_karyawan.required' => 'Nama tidak boleh kosong',
                'nama_karyawan.string' => 'Nama harus berupa huruf',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'jabatan.string' => 'Jabatan harus berupa huruf',
                'gaji.required' => 'Gaji tidak boleh kosong',
                'gaji.numeric' => 'Gaji harus berupa angka',
                'gaji.integer' => 'Gaji harus berupa angka',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tanggal.date' => 'Tanggal harus berupa tanggal',
                'gaji.gte' => 'Gaji tidak boleh kurang dari 0',
            ]);

        Gaji::create([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/datatenagakerja')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required|string',
            'jabatan' => 'required|string',
            'gaji' => 'required|numeric|integer|gte:0',
            'tanggal' => 'required|date',
        ], [
                'nama_karyawan.required' => 'Nama tidak boleh kosong',
                'nama_karyawan.string' => 'Nama harus berupa huruf',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'jabatan.string' => 'Jabatan harus berupa huruf',
                'gaji.required' => 'Gaji tidak boleh kosong',
                'gaji.numeric' => 'Gaji harus berupa angka',
                'gaji.integer' => 'Gaji harus berupa angka',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tanggal.date' => 'Tanggal harus berupa tanggal',
                'gaji.gte' => 'Gaji tidak boleh kurang dari 0',
            ]);

        Gaji::where('id', $id)->update([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/datatenagakerja')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Gaji::find($id)->delete();
        return redirect('/datatenagakerja')->with('delete', 'Data Berhasil Dihapus');
    }
}