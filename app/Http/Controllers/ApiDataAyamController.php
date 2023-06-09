<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use Illuminate\Http\Request;

class ApiDataAyamController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            // 'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required'
        ]);
        $bulanIni = date('Y-m');
        $cekPembelianAyam = Ayam::where('tanggal_masuk', 'like', $bulanIni.'%')->first();
        if ($cekPembelianAyam) {
            return response()->json([
                'message' => 'Data pembelian ayam bulan ini sudah ada'
            ], 400);
        } else {
            $total_harga = $data['harga_satuan'] * $data['jumlah_masuk'];
            $total = $data['jumlah_masuk'] - $data['mati'];

            $dataayam = Ayam::create([
                'tanggal_masuk' => date('Y-m-d'),
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
    }

    public function read()
    {
        $dataayam = Ayam::whereNotNull('tanggal_masuk')->orderByDesc('id')->get();

        return response()->json([
            "message" => "success",
            "data" => $dataayam
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            // 'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required'
        ]);

        $dataayam = Ayam::findOrFail($id);

        $total_harga = $data['harga_satuan'] * $data['jumlah_masuk'];
        $total = $data['jumlah_masuk'] - $data['mati'];

        $dataayam->update([
            // 'tanggal_masuk' => $data['tanggal_masuk'],
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
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'jumlah_masuk' => 'required|numeric|integer|gte:0',
    //         'harga_satuan' => 'required|numeric|integer|gte:0',
    //         'mati' => 'required|numeric|integer|gte:0|lte:jumlah_masuk',
    //     ], [
    //             'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
    //             'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
    //             'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
    //             'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
    //             'mati.numeric' => 'Mati harus berupa angka',
    //             'mati.required' => 'Mati tidak boleh kosong',
    //             'mati.integer' => 'Mati harus berupa angka',
    //             'jumlah_masuk.numeric' => 'Jumlah Masuk harus berupa angka',
    //             'jumlah_masuk.integer' => 'Jumlah Masuk harus berupa angka',
    //             'jumlah_masuk.gte' => 'Jumlah Masuk tidak boleh kurang dari 0',
    //             'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 0',
    //             'mati.gte' => 'Mati tidak boleh kurang dari 0',
    //             'mati.lte' => 'Mati tidak boleh lebih dari Jumlah Masuk',
    //         ]);

    //     $datadistribusi = Distribusi::whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->sum('total_ayam');
    //     $dataayamjual = $datadistribusi;

    //     $dataayam = Ayam::find($id);
    //     $totalayamlama = $dataayam->total_ayam;
    //     $jumlahmasuklama = $dataayam->jumlah_masuk;
    //     $dataayammatilama = $dataayam->mati;


    //     if ($dataayamjual >= $request->jumlah_masuk - $request->mati) {
    //         return redirect('/dataayam')->with('jumlahayamjuallebih', 'Jumlah Ayam Terjual Lebih Banyak Dari Jumlah Ayam');
    //     } else {

    //         if ($request->jumlah_masuk >= $jumlahmasuklama) { // Jika Jumlah Masuk Baru Lebih Besar Dari Jumlah Masuk Lama
    //             $totalayam = $totalayamlama + ($request->jumlah_masuk - $jumlahmasuklama); // Total Ayam Lama Ditambah Jumlah Masuk Baru - Jumlah Masuk Lama

    //             if ($request->mati >= $dataayammatilama) { // Jika Jumlah Mati Baru Lebih Besar Dari Jumlah Mati Lama
    //                 $totalayamakhir = $totalayam - ($request->mati - $dataayammatilama); // Total Ayam Lama Dikurang Jumlah Mati Baru - Jumlah Mati Lama

    //                 $totalharga = $request->harga_satuan * $request->jumlah_masuk; // Total Harga Baru

    //                 Ayam::find($id)->update([
    //                     'jumlah_masuk' => $request->jumlah_masuk,
    //                     'harga_satuan' => $request->harga_satuan,
    //                     'total_harga' => $totalharga,
    //                     'mati' => $request->mati,
    //                     'total_ayam' => $totalayamakhir
    //                 ]);

    //                 return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
    //             } else {
    //                 $totalayamakhir = $totalayam + ($dataayammatilama - $request->mati);

    //                 $totalharga = $request->harga_satuan * $request->jumlah_masuk;

    //                 Ayam::find($id)->update([
    //                     'jumlah_masuk' => $request->jumlah_masuk,
    //                     'harga_satuan' => $request->harga_satuan,
    //                     'total_harga' => $totalharga,
    //                     'mati' => $request->mati,
    //                     'total_ayam' => $totalayamakhir
    //                 ]);

    //                 return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
    //             }

    //         } elseif ($request->jumlah_masuk <= $jumlahmasuklama) {
    //             $totalayam = $totalayamlama - ($jumlahmasuklama - $request->jumlah_masuk);

    //             if ($request->mati >= $dataayammatilama) {
    //                 $totalayamakhir = $totalayam - ($dataayammatilama - $request->mati);

    //                 $totalharga = $request->harga_satuan * $request->jumlah_masuk;

    //                 Ayam::find($id)->update([
    //                     'jumlah_masuk' => $request->jumlah_masuk,
    //                     'harga_satuan' => $request->harga_satuan,
    //                     'total_harga' => $totalharga,
    //                     'mati' => $request->mati,
    //                     'total_ayam' => $totalayamakhir
    //                 ]);

    //                 return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
    //             } else {
    //                 $totalayamakhir = $totalayam + ($dataayammatilama - $request->mati);

    //                 $totalharga = $request->harga_satuan * $request->jumlah_masuk;

    //                 Ayam::find($id)->update([
    //                     'jumlah_masuk' => $request->jumlah_masuk,
    //                     'harga_satuan' => $request->harga_satuan,
    //                     'total_harga' => $totalharga,
    //                     'mati' => $request->mati,
    //                     'total_ayam' => $totalayamakhir
    //                 ]);

    //                 return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
    //             }
    //         } else {
    //             $totalayamakhir = $request->jumlah_masuk - $request->mati;
    //             $totalharga = $request->harga_satuan * $request->jumlah_masuk;

    //             Ayam::find($id)->update([
    //                 'jumlah_masuk' => $request->jumlah_masuk,
    //                 'harga_satuan' => $request->harga_satuan,
    //                 'total_harga' => $totalharga,
    //                 'mati' => $request->mati,
    //                 'total_ayam' => $totalayamakhir
    //             ]);

    //             return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
    //         }
    //     }

    // }

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
