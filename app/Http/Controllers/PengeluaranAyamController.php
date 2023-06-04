<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use App\Models\DetailAyam;
use App\Models\PengeluaranAyam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranAyamController extends Controller
{
    public function index()
    {
        $pengeluaran_ayam = DB::table('tb_pengeluaran_ayam')
            ->join('tb_detail_pengeluaran_ayam', 'tb_pengeluaran_ayam.id', '=', 'tb_detail_pengeluaran_ayam.id_pengeluaran_ayam')
            ->join('tb_ayam', 'tb_detail_pengeluaran_ayam.id_ayam', '=', 'tb_ayam.id')
            ->select('tb_pengeluaran_ayam.*', DB::raw('SUM(tb_ayam.total_harga) as total'), DB::raw('SUM(tb_ayam.total_ayam) as jumlahayam'), )
            ->groupBy('tb_pengeluaran_ayam.id')
            ->get();

        return view('admin.pages.datapengeluaranayam', [
            'pengeluaran_ayam' => $pengeluaran_ayam,
        ]);
    }

    public function pengeluaranayamdetail($id)
    {
        $pengeluaranayam = PengeluaranAyam::find($id);

        $tampildataayam = Ayam::where('id', '!=', 1)->get();
        $pengeluaran_ayam = DetailAyam::with('ayam')->where('id_pengeluaran_ayam', $id)->where('id_ayam', '!=', 1)->get();
        return view('admin.pages.datapengeluaranayamdetail', [
            'pengeluaran_ayam' => $pengeluaran_ayam,
            'pengeluaranayam' => $pengeluaranayam,
            'tampildataayam' => $tampildataayam,
        ]);
    }

    public function addidayam(Request $request)
    {
        $request->validate([
            'id_ayam' => 'required',
            'id_pengeluaran_ayam' => 'required',
        ], [
                'id_ayam.required' => 'Ayam harus diisi',
                'id_pengeluaran_ayam.required' => 'Pengeluaran Ayam harus diisi',
            ]);

        $cekidayam = DetailAyam::where('id_ayam', $request->id_ayam)->first();
        if ($cekidayam) {
            return redirect()->back()->with('sudahada', 'Data Ayam Sudah Ada!');
        } else {

            $detailayam = new DetailAyam;
            $detailayam->id_pengeluaran_ayam = $request->id_pengeluaran_ayam;
            $detailayam->id_ayam = $request->id_ayam;
            $detailayam->save();

            return redirect()->back()->with('create', 'Data Berhasil Ditambahkan');
        }
    }

    public function deleteidayam($id)
    {
        DetailAyam::where('id_ayam', $id)->delete();
        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',

        ]);

        PengeluaranAyam::create([
            'tanggal' => $request->tanggal,
        ]);

        $dataayam = Ayam::find(1);
        $cekidpengeluaranayam = PengeluaranAyam::all()->last();

        DetailAyam::create([
            'id_pengeluaran_ayam' => $cekidpengeluaranayam->id,
            'id_ayam' => $dataayam->id,
        ]);

        return redirect('/datapengeluaranayam')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pengeluaran_ayam = PengeluaranAyam::find($id);
        $pengeluaran_ayam->update([
            'tanggal' => $request->tanggal,
        ]);
        return redirect('/datapengeluaranayam')->with('update', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        DetailAyam::where('id_pengeluaran_ayam', $id)->delete();
        PengeluaranAyam::find($id)->delete();

        return redirect('/datapengeluaranayam')->with('delete', 'Data Berhasil Dihapus');
    }
}