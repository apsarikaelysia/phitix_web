<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Ayam;
use App\Models\Pakan;
use App\Models\Vaksin;
use App\Models\Distribusi;
use App\Models\Pendapatan;
use App\Models\Penghasilan;

class DashboardController extends Controller
{
    public function index()
    {

        $dataayambulanan = DB::table('tb_ayam')
            ->whereRaw('MONTH(tb_ayam.tanggal_masuk) = MONTH(curdate())')
            ->whereRaw('YEAR(tb_ayam.tanggal_masuk) = YEAR(curdate())')
            ->select(DB::raw('SUM(tb_ayam.total_ayam) as totalayam'))
            ->get();

        $dataayamkeluar = DB::table('tb_distribusi')
            ->whereRaw('MONTH(tb_distribusi.tanggal) = MONTH(curdate())')
            ->whereRaw('YEAR(tb_distribusi.tanggal) = YEAR(curdate())')
            ->select(DB::raw('SUM(tb_distribusi.total_ayam) as totalayamkeluar'))
            ->get();

        $datapakan = DB::table('tb_pakan')
            ->whereRaw('MONTH(tb_pakan.pembelian) = MONTH(curdate())')
            ->whereRaw('YEAR(tb_pakan.pembelian) = YEAR(curdate())')
            ->select(DB::raw('SUM(tb_pakan.sisa_stok_pakan) as totalpakan'))
            ->get();

        $datavaksin = Vaksin::all()->last();

        $dataayam = number_format($dataayambulanan->sum('totalayam'));
        $dataayamkeluar = number_format($dataayamkeluar->sum('totalayamkeluar'));
        $datapakan = number_format($datapakan->sum('totalpakan'));

        $datapenghasilan = DB::table('tb_penghasilan')
            // ->whereRaw('MONTH(tb_penghasilan.tanggal) = MONTH(curdate())')
            ->whereRaw('YEAR(tb_penghasilan.tanggal) = YEAR(curdate())')
            ->select(DB::raw('tb_penghasilan.tanggal, SUM(tb_penghasilan.penghasilan) as penghasilan'))
            ->groupBy('tb_penghasilan.tanggal')
            ->get();

        $penghasilantanggal = $datapenghasilan->pluck('tanggal');
        $penghasilanjumlah = $datapenghasilan->pluck('penghasilan');

        return view('admin.pages.index', [
            'dataayam' => $dataayam,
            'dataayamkeluar' => $dataayamkeluar,
            'datapakan' => $datapakan,
            'datavaksin' => $datavaksin,
            'penghasilantanggal' => $penghasilantanggal,
            'penghasilanjumlah' => $penghasilanjumlah,
        ]);

    }

}