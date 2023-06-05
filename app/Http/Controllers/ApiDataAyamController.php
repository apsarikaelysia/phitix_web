<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use Illuminate\Http\Request;

class ApiDataAyamController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required'
        ]);

        $total_harga = $data['harga_satuan'] * $data['jumlah_masuk'];
        $total = $data['jumlah_masuk'] - $data['mati'];

        $dataayam = Ayam::create([
            'tanggal_masuk' => $data['tanggal_masuk'],
            'jumlah_masuk' => $data['jumlah_masuk'],
            'harga_satuan' => $data['harga_satuan'],
            'mati' => $data['mati'],
            'total_harga' => $total_harga,
            'total_ayam' => $total
        ]);

        return response()->json([
            'message' => 'success',
            'dataayam' => $dataayam
        ]);
    }

    public function read()
    {
        $dataayam = Ayam::orderByDesc('id')->get();

        return response()->json([
            "message" => "success",
            "data" => $dataayam
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required'
        ]);

        $dataayam = Ayam::findOrFail($id);

        $total_harga = $data['harga_satuan'] * $data['jumlah_masuk'];
        $total = $data['jumlah_masuk'] - $data['mati'];

        $dataayam->update([
            'tanggal_masuk' => $data['tanggal_masuk'],
            'jumlah_masuk' => $data['jumlah_masuk'],
            'harga_satuan' => $data['harga_satuan'],
            'mati' => $data['mati'],
            'total_harga' => $total_harga,
            'total_ayam' => $total
        ]);

        return response()->json([
            'message' => 'success',
            'dataayam' => $dataayam
        ]);
    }

    public function delete($id)
    {
        $dataayam = Ayam::findOrFail($id);

        $dataayam->delete();

        return response()->json([
            'message' => 'success',
            'data' => null
        ]);
    }
    public function getTotalCounts()
    {
        $totalAyam = Ayam::sum('total_ayam');
        $totalMati = Ayam::sum('mati');
        $ayamMasuk = Ayam::sum('jumlah_masuk');

        return response()->json([
            'message' => 'success',
            'total_ayam' => $totalAyam,
            'total_mati' => $totalMati,
            'jumlah_masuk' => $ayamMasuk
        ]);
    }
}
