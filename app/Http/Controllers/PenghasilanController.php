<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranAyam;
use App\Models\PengeluaranPakan;
use App\Models\PengeluaranGaji;
use App\Models\PengeluaranVaksin;
use App\Models\Penghasilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class PenghasilanController extends Controller
{
    public function index()
    {
        $datapendapatan = DB::table('tb_pendapatan')
            ->join('tb_detail_pendapatan', 'tb_pendapatan.id', '=', 'tb_detail_pendapatan.id_pendapatan')
            ->join('tb_distribusi', 'tb_detail_pendapatan.id_distribusi', '=', 'tb_distribusi.id')
            ->select('tb_pendapatan.*', DB::raw('SUM(tb_distribusi.payment) as total'))
            ->orderBy('tb_pendapatan.tanggal', 'desc')
            ->groupBy('tb_pendapatan.id')
            ->get();

        $datapengeluaranayam = DB::table('tb_pengeluaran_ayam')
            ->join('tb_detail_pengeluaran_ayam', 'tb_pengeluaran_ayam.id', '=', 'tb_detail_pengeluaran_ayam.id_pengeluaran_ayam')
            ->join('tb_ayam', 'tb_detail_pengeluaran_ayam.id_ayam', '=', 'tb_ayam.id')
            ->select('tb_pengeluaran_ayam.*', DB::raw('SUM(tb_ayam.total_harga) as total'), DB::raw('SUM(tb_ayam.jumlah_masuk) as jumlahayam'), )
            ->orderBy('tb_pengeluaran_ayam.tanggal', 'desc')
            ->groupBy('tb_pengeluaran_ayam.id')
            ->get();

        $datapengeluaranvaksin = DB::table('tb_pengeluaran_vaksin')
            ->join('tb_detail_pengeluaran_vaksin', 'tb_pengeluaran_vaksin.id', '=', 'tb_detail_pengeluaran_vaksin.id_pengeluaran_vaksin')
            ->join('tb_vaksin', 'tb_detail_pengeluaran_vaksin.id_vaksin', '=', 'tb_vaksin.id')
            ->select('tb_pengeluaran_vaksin.*', DB::raw('SUM(tb_vaksin.total_biaya) as total'), DB::raw('SUM(tb_vaksin.jumlah_ayam) as jumlahayam'), )
            ->orderBy('tb_pengeluaran_vaksin.tanggal', 'desc')
            ->groupBy('tb_pengeluaran_vaksin.id')
            ->get();

        $datapengeluaranpakan = DB::table('tb_pengeluaran_pakan')
            ->join('tb_detail_pengeluaran_pakan', 'tb_pengeluaran_pakan.id', '=', 'tb_detail_pengeluaran_pakan.id_pengeluaran_pakan')
            ->join('tb_pakan', 'tb_detail_pengeluaran_pakan.id_pakan', '=', 'tb_pakan.id')
            ->select('tb_pengeluaran_pakan.*', DB::raw('SUM(tb_pakan.total_harga) as total'), DB::raw('SUM(tb_pakan.stok_pakan) as totalpakan'), )
            ->orderBy('tb_pengeluaran_pakan.tanggal', 'desc')
            ->groupBy('tb_pengeluaran_pakan.id')
            ->get();

        // $datapengeluarangaji = DB::table('tb_pengeluaran_gaji')
        //     ->join('tb_detail_pengeluaran_gaji', 'tb_pengeluaran_gaji.id', '=', 'tb_detail_pengeluaran_gaji.id_pengeluaran_gaji')
        //     ->join('tb_gaji', 'tb_detail_pengeluaran_gaji.id_gaji', '=', 'tb_gaji.id')
        //     ->select('tb_pengeluaran_gaji.*', DB::raw('SUM(tb_gaji.gaji) as total'))
        //     ->orderBy('tb_pengeluaran_gaji.tanggal', 'desc')
        //     ->groupBy('tb_pengeluaran_gaji.id')
        //     ->get();

        $datapenghasilan = Penghasilan::all();

        return view('admin.pages.datapenghasilan', [
            'datapenghasilan' => $datapenghasilan,
            'datapendapatan' => $datapendapatan,
            'datapengeluaranayam' => $datapengeluaranayam,
            'datapengeluaranvaksin' => $datapengeluaranvaksin,
            'datapengeluaranpakan' => $datapengeluaranpakan,
            // 'datapengeluarangaji' => $datapengeluarangaji,
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pendapatan' => 'required|numeric|integer',
            'pengeluaran_ayam' => 'required|numeric|integer',
            'pengeluaran_pakan' => 'required|numeric|integer',
            // 'pengeluaran_gaji' => 'required|numeric|integer',
            'pengeluaran_vaksin' => 'required|numeric|integer',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'tanggal.date' => 'Tanggal harus berupa tanggal!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pendapatan.numeric' => 'Pendapatan harus berupa angka!',
                'pendapatan.integer' => 'Pendapatan harus berupa angka!',
                'pengeluaran_ayam' => 'Pengeluaran Ayam harus diisi!',
                'pengeleuran_ayam.numeric' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_ayam.integer' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan' => 'Pengeluaran Pakan harus diisi!',
                'pengeluaran_pakan.numeric' => 'Pengeluaran Pakan harus berupa angka!',
                'pengeluaran_pakan.integer' => 'Pengeluaran Pakan harus berupa angka!',
                // 'pengeluaran_gaji' => 'Pengeluaran Gaji harus diisi!',
                // 'pengeluaran_gaji.numeric' => 'Pengeluaran Gaji harus berupa angka!',
                // 'pengeluaran_gaji.integer' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_vaksin' => 'Pengeluaran Vaksin harus diisi!',
                'pengeluaran_vaksin.numeric' => 'Pengeluaran Vaksin harus berupa angka!',
                'pengeluaran_vaksin.integer' => 'Pengeluaran Vaksin harus berupa angka!',
            ]);

        $penghasilan = $request->pendapatan - ($request->pengeluaran_ayam + $request->pengeluaran_pakan + $request->pengeluaran_vaksin);

        Penghasilan::create([
            'tanggal' => $request->tanggal,
            'pendapatan' => $request->pendapatan,
            'pengeluaran_ayam' => $request->pengeluaran_ayam,
            'pengeluaran_pakan' => $request->pengeluaran_pakan,
            // 'pengeluaran_gaji' => $request->pengeluaran_gaji,
            'pengeluaran_vaksin' => $request->pengeluaran_vaksin,
            'penghasilan' => $penghasilan,

        ]);

        return redirect('/datapenghasilan')->with('create', 'Data Penghasilan Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'tanggal' => 'required|date',
            'pendapatan' => 'required|numeric|integer',
            'pengeluaran_ayam' => 'required|numeric|integer',
            'pengeluaran_pakan' => 'required|numeric|integer',
            // 'pengeluaran_gaji' => 'required|numeric|integer',
            'pengeluaran_vaksin' => 'required|numeric|integer',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'pendapatan.numeric' => 'Pendapatan harus berupa angka!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pengeluaran_ayam.numeric' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan.numeric' => 'Pengeluaran Pakan harus berupa angka!',
                // 'pengeluaran_gaji.numeric' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_vaksin.numeric' => 'Pengeluaran Vaksin harus berupa angka!',
                'pendapatan.integer' => 'Pendapatan harus berupa angka!',
                'pengeluaran_ayam.integer' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan.integer' => 'Pengeluaran Pakan harus berupa angka!',
                // 'pengeluaran_gaji.integer' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_ayam' => 'Pengeluaran Ayam harus diisi!',
                'pengeluaran_pakan' => 'Pengeluaran Pakan harus diisi!',
                // 'pengeluaran_gaji' => 'Pengeluaran Gaji harus diisi!',
                'pengeluaran_vaksin' => 'Pengeluaran Vaksin harus diisi!',
            ], [

            ]);

        $penghasilan = (($request->pendapatan) - ($request->pengeluaran_ayam + $request->pengeluaran_pakan + $request->pengeluaran_vaksin));
        Penghasilan::where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'pendapatan' => $request->pendapatan,
            'pengeluaran_ayam' => $request->pengeluaran_ayam,
            'pengeluaran_pakan' => $request->pengeluaran_pakan,
            // 'pengeluaran_gaji' => $request->pengeluaran_gaji,
            'pengeluaran_vaksin' => $request->pengeluaran_vaksin,
            'penghasilan' => $penghasilan,
        ]);

        return redirect('/datapenghasilan')->with('update', 'Data Penghasilan Berhasil Diubah!');

    }

    public function destroy($id)
    {
        Penghasilan::where('id', $id)->delete();
        return redirect('/datapenghasilan')->with('delete', 'Data Penghasilan Berhasil Dihapus!');
    }

}