<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use App\Models\DetailPendapatan;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function index()
    {
        $totalpendapatan = DB::table('tb_pendapatan')
            ->join('tb_detail_pendapatan', 'tb_pendapatan.id', '=', 'tb_detail_pendapatan.id_pendapatan')
            ->join('tb_distribusi', 'tb_detail_pendapatan.id_distribusi', '=', 'tb_distribusi.id')
            ->select('tb_pendapatan.*', DB::raw('SUM(tb_distribusi.payment) as total'))
            ->orderBy('tb_pendapatan.tanggal', 'desc')
            ->groupBy('tb_pendapatan.id')
            ->get();

        return view('admin.pages.datapendapatan', [
            // 'pendapatan' => $pendapatan
            'datapendapatan' => $totalpendapatan
        ]);
    }

    public function detailpendapatan($id)
    {
        $pendapatan = Pendapatan::find($id);

        $tampildatadistribusi = Distribusi::where('id', '!=', 1)->get();
        $datapendapatan = DetailPendapatan::with('distribusi')->where('id_pendapatan', $id)->where('id_distribusi', '!=', 1)->get();

        return view('admin.pages.datapendapatandetail', [
            'pendapatan' => $pendapatan,
            'datapendapatan' => $datapendapatan,
            'tampildatadistribusi' => $tampildatadistribusi
        ]);
    }

    public function addiddistribusi(Request $request)
    {
        $request->validate([
            'id_distribusi' => 'required',
        ], [
                'id_distribusi.required' => 'Distribusi harus diisi',
            ]);

        $cekiddistribusi = DetailPendapatan::where('id_distribusi', $request->id_distribusi)->first();
        if ($cekiddistribusi) {
            return redirect()->back()->with('sudahada', 'Data Distribusi Sudah Ada!');
        } else {

            $detailpendapatan = new DetailPendapatan;
            $detailpendapatan->id_pendapatan = $request->id_pendapatan;
            $detailpendapatan->id_distribusi = $request->id_distribusi;
            $detailpendapatan->save();
        }

        return redirect('/datapendapatan/' . $request->id_pendapatan)->with('create', 'Data Ayam Berhasil Ditambahkan!');
    }

    public function deleteiddistribusi($id)
    {
        DetailPendapatan::where('id_distribusi', $id)->delete();

        return redirect()->back()->with('delete', 'Data Ayam Berhasil Dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pendapatan = new Pendapatan;
        $pendapatan->tanggal = $request->tanggal;
        $pendapatan->save();

        $datadistribusi = Distribusi::find(1);
        $cekidpendapatan = Pendapatan::all()->last();

        DetailPendapatan::create([
            'id_pendapatan' => $cekidpendapatan->id,
            'id_distribusi' => $datadistribusi->id
        ]);

        return redirect('/datapendapatan')->with('create', 'Data berhasil ditambahkan');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pendapatan = Pendapatan::find($id);
        $pendapatan->tanggal = $request->tanggal;
        $pendapatan->save();

        return redirect('/datapendapatan')->with('update', 'Data berhasil diupdate');

    }

    public function destroy($id)
    {
        $detailpendapatan = DetailPendapatan::where('id_pendapatan', $id);
        $detailpendapatan->delete();

        $pendapatan = Pendapatan::find($id);
        $pendapatan->delete();

        return redirect('/datapendapatan')->with('delete', 'Data berhasil dihapus');
    }

}