<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailVaksin;
use App\Models\Vaksin;
use App\Models\PengeluaranVaksin;
use Illuminate\Support\Facades\DB;

class PengeluaranVaksinController extends Controller
{
    public function index()
    {
        $totalpengeluaranvaksin = DB::table('tb_pengeluaran_vaksin')
            ->join('tb_detail_pengeluaran_vaksin', 'tb_pengeluaran_vaksin.id', '=', 'tb_detail_pengeluaran_vaksin.id_pengeluaran_vaksin')
            ->join('tb_vaksin', 'tb_detail_pengeluaran_vaksin.id_vaksin', '=', 'tb_vaksin.id')
            ->select('tb_pengeluaran_vaksin.*', DB::raw('SUM(tb_vaksin.total_biaya) as total'), DB::raw('SUM(tb_vaksin.jumlah_ayam) as jumlahayam'), )
            ->orderBy('tb_pengeluaran_vaksin.tanggal', 'desc')
            ->groupBy('tb_pengeluaran_vaksin.id')
            ->get();

        return view('admin.pages.datapengeluaranvaksin', [
            'datapengeluaranvaksin' => $totalpengeluaranvaksin
        ]);
    }

    public function pengeluaranvaksindetail($id)
    {
        $pengeluaranvaksin = PengeluaranVaksin::find($id);
        $tampildatavaksin = Vaksin::where('id', '!=', 1)->get();
        $datapengeluaranvaksin = DetailVaksin::with('vaksin')->where('id_pengeluaran_vaksin', $id)->where('id_vaksin', '!=', 1)->get();

        return view('admin.pages.datapengeluaranvaksindetail', [
            'pengeluaranvaksin' => $pengeluaranvaksin,
            'datapengeluaranvaksin' => $datapengeluaranvaksin,
            'tampildatavaksin' => $tampildatavaksin
        ]);
    }

    public function addidvaksin(Request $request)
    {
        $request->validate([
            'id_vaksin' => 'required',
            'id_pengeluaran_vaksin' => 'required',
        ], [
                'id_vaksin.required' => 'Vaksin harus diisi',
                'id_pengeluaran_vaksin.required' => 'Pengeluaran Vaksin harus diisi',
            ]);

        $cekidvaksin = DetailVaksin::where('id_vaksin', $request->id_vaksin)->first();
        if ($cekidvaksin) {
            return redirect()->back()->with('sudahada', 'Data Vaksin Sudah Ada!');
        } else {

            $detailvaksin = new DetailVaksin;
            $detailvaksin->id_pengeluaran_vaksin = $request->id_pengeluaran_vaksin;
            $detailvaksin->id_vaksin = $request->id_vaksin;
            $detailvaksin->save();

            return redirect()->back()->with('create', 'Data Vaksin Berhasil Ditambahkan!');
        }
    }

    public function deleteidvaksin($id)
    {
        DetailVaksin::where('id_vaksin', $id)->delete();

        return redirect()->back()->with('delete', 'Data Vaksin Berhasil Dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',

            ]);

        $pengeluaranvaksin = new PengeluaranVaksin;
        $pengeluaranvaksin->tanggal = $request->tanggal;

        $pengeluaranvaksin->save();

        $datavaksin = Vaksin::find(1);
        $cekidpengeuaranvaksin = PengeluaranVaksin::all()->last();

        $detailvaksin = new DetailVaksin;
        $detailvaksin->id_pengeluaran_vaksin = $cekidpengeuaranvaksin->id;
        $detailvaksin->id_vaksin = $datavaksin->id;
        $detailvaksin->save();

        return redirect()->back()->with('create', 'Data Pengeluaran Vaksin Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',

            ]);

        $pengeluaranvaksin = PengeluaranVaksin::find($id);
        $pengeluaranvaksin->tanggal = $request->tanggal;

        $pengeluaranvaksin->save();

        return redirect()->back()->with('update', 'Data Pengeluaran Vaksin Berhasil Diubah!');
    }

    public function destroy($id)
    {
        DetailVaksin::where('id_pengeluaran_vaksin', $id)->delete();

        $pengeluaranvaksin = PengeluaranVaksin::find($id);
        $pengeluaranvaksin->delete();

        return redirect()->back()->with('delete', 'Data Pengeluaran Vaksin Berhasil Dihapus!');
    }


}