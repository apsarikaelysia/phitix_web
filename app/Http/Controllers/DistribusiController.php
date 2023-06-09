<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use Illuminate\Http\Request;
use App\Models\Distribusi;
use App\Models\DetailPendapatan;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusi = Distribusi::where('tanggal', '!=', null)->orderBy('tanggal', 'desc')->get();
        return view('admin.pages.datadistribusi2', [
            'distribusi' => $distribusi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|string',
            // 'tanggal' => 'required|date',
            'total_ayam' => 'required|numeric|integer|gte:1',
            'harga_satuan' => 'required|numeric|integer|gte:1',
            'contact' => 'required|numeric|min:11',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'customer.string' => 'Customer harus berupa huruf',
                // 'tanggal.required' => 'Tanggal tidak boleh kosong',
                // 'tanggal.date' => 'Tanggal harus berupa tanggal',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'total_ayam.numeric' => 'Total Ayam harus berupa angka',
                'total_ayam.integer' => 'Total Ayam harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'contact.required' => 'Contact tidak boleh kosong',
                'contact.numeric' => 'Contact harus berupa angka',
                'contact.min' => 'Contact minimal 11 angka',
                'total_ayam.gte' => 'Total Ayam tidak boleh kurang dari 1',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 1',

            ]);



        $dataayambulanini = Ayam::where('tanggal_masuk', '!=', null)->whereMonth('tanggal_masuk', date('m'))->first();

        if ($dataayambulanini == null) {
            return redirect('/datadistribusi2')->with('dataayamtidakada', 'Data Ayam Bulan Ini Tidak Cukup');
        }
        $datayam = $dataayambulanini->total_ayam;

        if ($datayam < $request->total_ayam) {
            return redirect('/datadistribusi2')->with('tidakcukup', 'Data Ayam Bulan Ini Tidak Cukup');
        } else {
            $dataayambulanini->update([
                'total_ayam' => $dataayambulanini->total_ayam - $request->total_ayam,
            ]);

            $totalharga = $request->harga_satuan * $request->total_ayam;

            Distribusi::create([
                'customer' => $request->customer,
                'tanggal' => date('Y-m-d'),
                'total_ayam' => $request->total_ayam,
                'harga_satuan' => $request->harga_satuan,
                'payment' => $totalharga,
                'contact' => $request->contact,
            ]);

            return redirect('/datadistribusi2')->with('create', 'Data Berhasil Diubah');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer' => 'required|string',
            // 'tanggal' => 'required|date',
            'total_ayam' => 'required|numeric|integer|gte:1',
            'harga_satuan' => 'required|numeric|integer|gte:1',
            'contact' => 'required|numeric|min:11',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'customer.string' => 'Customer harus berupa huruf',
                // 'tanggal.required' => 'Tanggal tidak boleh kosong',
                // 'tanggal.date' => 'Tanggal harus berupa tanggal',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'contact.numeric' => 'Contact harus berupa angka',
                'contact.required' => 'Contact tidak boleh kosong',
                'contact.min' => 'Contact minimal 11 angka',
                'total_ayam.gte' => 'Total Ayam tidak boleh kurang dari 1',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 1',
            ]);

        $datadistribusi = Distribusi::where('id', $id)->first();
        $totalayam = $datadistribusi->total_ayam;

        $dataayambulanini = Ayam::where('tanggal_masuk', '!=', null)->whereMonth('tanggal_masuk', date('m'))->first();

        if ($dataayambulanini) {

            if ($dataayambulanini->total_ayam == $request->total_ayam) {
                $dataayambulanini->update([
                    'total_ayam' => $request->total_ayam,
                ]);
            } elseif ($totalayam > $request->total_ayam) {
                $dataayambulanini->update([
                    'total_ayam' => $dataayambulanini->total_ayam + ($totalayam - $request->total_ayam),
                ]);
            } elseif ($totalayam < $request->total_ayam) {
                $dataayambulanini->update([
                    'total_ayam' => $dataayambulanini->total_ayam - ($request->total_ayam - $totalayam),
                ]);
            } elseif ($dataayambulanini->total_ayam < $request->total_ayam) {
                return redirect('/datadistribusi2')->with('tidakcukup', 'Data Ayam Bulan Ini Tidak Cukup');
            }
        } else {
            return redirect('/datadistribusi2')->with('tidakbisaedit', 'Tidak bisa edit data ayam pada bulan sebelumnya');
        }

        $totalharga = $request->harga_satuan * $request->total_ayam;

        Distribusi::where('id', $id)->update([
            'customer' => $request->customer,
            // 'tanggal' => date('Y-m-d'),
            'total_ayam' => $request->total_ayam,
            'harga_satuan' => $request->harga_satuan,
            'payment' => $totalharga,
            'contact' => $request->contact,
        ]);



        return redirect('/datadistribusi2')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $datadistribusi = Distribusi::where('id', $id)->first();
        $totalayam = $datadistribusi->total_ayam;

        $detailpendapatan = DetailPendapatan::where('id_distribusi', $id)->first();

        $cekdatadistribusi = Distribusi::wheremonth('tanggal', date('m'))->whereyear('tanggal', date('Y'))->count();
        $dataayambulanini = Ayam::where('tanggal_masuk', '!=', null)->whereMonth('tanggal_masuk', date('m'))->first();

        if ($detailpendapatan) {
            return redirect('/datadistribusi2')->with('punyarelasi', 'Data Sudah Ada Di Detail Pendapatan');
        } else {
            if ($dataayambulanini == null or $dataayambulanini == '1') {
                return redirect('/datadistribusi2')->with('tidakbisahapus', 'Data Ayam Bulan Ini Tidak Cukup');
            } else {

                $dataayambulanini->update([
                    'total_ayam' => $dataayambulanini->total_ayam + $totalayam,
                ]);

                Distribusi::where('id', $id)->delete();
                return redirect('/datadistribusi2')->with('delete', 'Data Berhasil Dihapus');

            }
        }
    }

}
