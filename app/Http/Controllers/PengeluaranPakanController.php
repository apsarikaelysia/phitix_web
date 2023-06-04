<?php

namespace App\Http\Controllers;

use App\Models\DetailPakan;
use Illuminate\Http\Request;
use App\Models\Pakan;
use App\Models\PengeluaranPakan;
use Illuminate\Support\Facades\DB;

class PengeluaranPakanController extends Controller
{
    public function index()
    {
        $totalpengeluaranpakan = DB::table('tb_pengeluaran_pakan')
            ->join('tb_detail_pengeluaran_pakan', 'tb_pengeluaran_pakan.id', '=', 'tb_detail_pengeluaran_pakan.id_pengeluaran_pakan')
            ->join('tb_pakan', 'tb_detail_pengeluaran_pakan.id_pakan', '=', 'tb_pakan.id')
            ->select('tb_pengeluaran_pakan.*', DB::raw('SUM(tb_pakan.total_harga) as total'), DB::raw('SUM(tb_pakan.stok_pakan) as totalpakan'), )
            ->groupBy('tb_pengeluaran_pakan.id')
            ->get();

        return view('admin.pages.datapengeluaranpakan', [
            'datapengeluaranpakan' => $totalpengeluaranpakan
        ]);
    }

    public function pengeluaranpakandetail($id)
    {
        $tampildatapakan = Pakan::where('id', '!=', 1)->get();

        $datapengeluaranpakan = PengeluaranPakan::find($id);

        $pengeluaran_pakan = DetailPakan::with('pakan')->where('id_pengeluaran_pakan', $id)->where('id_pakan', '!=', 1)->get();
        return view('admin.pages.datapengeluaranpakandetail', [
            'pengeluaran_pakan' => $pengeluaran_pakan,
            'tampildatapakan' => $tampildatapakan,
            'datapengeluaranpakan' => $datapengeluaranpakan,
        ]);
    }

    public function addipakan(Request $request)
    {
        $request->validate([
            'id_pakan' => 'required',
            'id_pengeluaran_pakan' => 'required',
        ], [
                'id_pakan.required' => 'Pakan harus diisi',
                'id_pengeluaran_pakan.required' => 'Pengeluaran Pakan harus diisi',
            ]);

        $cekidpakan = DetailPakan::where('id_pakan', $request->id_pakan)->first();
        if ($cekidpakan) {
            return redirect()->back()->with('sudahada', 'Data Pakan Sudah Ada!');
        } else {

            $detailpakan = new DetailPakan;
            $detailpakan->id_pengeluaran_pakan = $request->id_pengeluaran_pakan;
            $detailpakan->id_pakan = $request->id_pakan;
            $detailpakan->save();

            return redirect()->back()->with('create', 'Data Berhasil Ditambahkan!');
        }
    }

    public function deleteipakan($id)
    {
        DetailPakan::where('id_pakan', $id)->delete();
        return redirect()->back()->with('delete', 'Data Berhasil Dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',

        ], [
                'tanggal.required' => 'Tanggal harus diisi',

            ]);

        $pengeluaranpakan = new PengeluaranPakan;
        $pengeluaranpakan->tanggal = $request->tanggal;
        $pengeluaranpakan->save();

        $datapakan = Pakan::find(1);

        $cekidpengeluaranpakan = PengeluaranPakan::all()->last();

        $detailpakan = new DetailPakan;
        $detailpakan->id_pengeluaran_pakan = $cekidpengeluaranpakan->id;
        $detailpakan->id_pakan = $datapakan->id;
        $detailpakan->save();

        return redirect()->back()->with('create', 'Data Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',

        ], [
                'tanggal.required' => 'Tanggal harus diisi',

            ]);

        $pengeluaranpakan = PengeluaranPakan::find($id);
        $pengeluaranpakan->tanggal = $request->tanggal;
        $pengeluaranpakan->save();

        return redirect()->back()->with('update', 'Data Berhasil Diubah!');
    }

    public function delete($id)
    {
        DetailPakan::where('id_pengeluaran_pakan', $id)->delete();

        PengeluaranPakan::find($id)->delete();
        return redirect()->back()->with('delete', 'Data Berhasil Dihapus!');
    }
}