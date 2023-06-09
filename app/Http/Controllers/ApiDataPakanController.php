<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class ApiDataPakanController extends Controller
{
    public function create(Request $request)
    {
        $data =  $request->validate([
            'pembelian' => 'required',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required',
            'harga_kg' => 'required',
        ]);

        $total_harga = $data['stok_pakan'] * $data['harga_kg'];

        $datapakan = Pakan::create([
            'pembelian' => $data['pembelian'],
            'jenis_pakan' => $data['jenis_pakan'],
            'stok_pakan' => $data['stok_pakan'],
            'harga_kg' => $data['harga_kg'],
            'total_harga' => $total_harga,
        ]);

        return response()->json([
            'message' => "success",
            'datapakan' => $datapakan
        ]);
    }

    public function read()
    {
        $datapakan = Pakan::whereNotNull('pembelian')->orderByDesc('id')->get();

        return response()->json([
            'message' => "success",
            'datapakan' => $datapakan
        ]);
    }

    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'pembelian' => 'required',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required',
            'harga_kg' => 'required',
        ]);

        $datapakan = Pakan::findOrFail($id);

        $total_harga = $data['stok_pakan'] * $data['harga_kg'];

        $datapakan->update([
            'pembelian' => $data['pembelian'],
            'jenis_pakan' => $data['jenis_pakan'],
            'stok_pakan' => $data['stok_pakan'],
            'harga_kg' => $data['harga_kg'],
            'total_harga' => $total_harga,
        ]);

        return response()->json([
            'message' => "success",
            'datapakan' => $datapakan
        ]);
    }

    public function delete($id)
    {

        $datapakan = Pakan::findOrFail($id);
        $datapakan->delete();


        return response()->json([
            'message' => "success",
            'datapakan' => $datapakan
        ]);
    }

    public function jumlahPakanMingguIni()
    {
        $jumlahPakanMingguIni = Pakan::whereBetween('pembelian', [now()->startOfWeek(), now()->endOfWeek()])->sum('stok_pakan');

        return response()->json([
            'message' => "success",
            'jumlah_pakan_minggu_ini' => $jumlahPakanMingguIni
        ]);
    }

    public function jumlahPakanBulanIni()
    {
        $jumlahPakanBulanIni = Pakan::whereBetween('pembelian', [now()->startOfMonth(), now()->endOfMonth()])->sum('stok_pakan');

        return response()->json([
            'message' => "success",
            'jumlah_pakan_bulan_ini' => $jumlahPakanBulanIni
        ]);
    }

    public function stockPakan()
    {
        $stockPakan = Pakan::sum('stok_pakan');

        return response()->json([
            'message' => "success",
            'stock_pakan' => $stockPakan
        ]);
    }
}
