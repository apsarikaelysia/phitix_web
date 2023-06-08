<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailGaji;
use App\Models\Gaji;
use App\Models\PengeluaranGaji;
use Illuminate\Support\Facades\DB;

class PengeluaranGajiController extends Controller
{
    public function index()
    {
        $pengeluarangaji = DB::table('tb_pengeluaran_gaji')
            ->join('tb_detail_pengeluaran_gaji', 'tb_pengeluaran_gaji.id', '=', 'tb_detail_pengeluaran_gaji.id_pengeluaran_gaji')
            ->join('tb_gaji', 'tb_detail_pengeluaran_gaji.id_gaji', '=', 'tb_gaji.id')
            ->select('tb_pengeluaran_gaji.*', DB::raw('SUM(tb_gaji.gaji) as total'))
            ->orderBy('tb_pengeluaran_gaji.tanggal', 'desc')
            ->groupBy('tb_pengeluaran_gaji.id')
            ->get();

        return view('admin.pages.datapengeluarangaji', [
            'pengeluarangaji' => $pengeluarangaji
        ]);
    }

    public function pengeluarangajidetail($id)
    {
        $tampildatagaji = Gaji::where('id', '!=', 1)->get();
        $datapengeluarangaji = PengeluaranGaji::find($id);

        $pengeluarangaji = DetailGaji::with('gaji')->where('id_pengeluaran_gaji', $id)->where('id_gaji', '!=', 1)->get();
        return view('admin.pages.datapengeluarangajidetail', [
            'pengeluarangaji' => $pengeluarangaji,
            'tampildatagaji' => $tampildatagaji,
            'datapengeluarangaji' => $datapengeluarangaji,
        ]);
    }

    public function addidgaji(Request $request)
    {
        $request->validate([
            'id_gaji' => 'required',
            'id_pengeluaran_gaji' => 'required',
        ], [
                'id_gaji.required' => 'Gaji harus diisi',
                'id_pengeluaran_gaji.required' => 'Pengeluaran Gaji harus diisi',
            ]);

        $cekidgaji = DetailGaji::where('id_gaji', $request->id_gaji)->first();
        if ($cekidgaji) {
            return redirect()->back()->with('sudahada', 'Data Gaji Sudah Ada!');
        } else {

            $detailgaji = new DetailGaji;
            $detailgaji->id_pengeluaran_gaji = $request->id_pengeluaran_gaji;
            $detailgaji->id_gaji = $request->id_gaji;
            $detailgaji->save();

            return redirect()->back()->with('create', 'Data Gaji Berhasil Ditambahkan!');
        }
    }

    public function deleteidgaji($id)
    {
        DetailGaji::where('id_gaji', $id)->delete();

        return redirect()->back()->with('delete', 'Data Gaji Berhasil Dihapus!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pengeluarangaji = new PengeluaranGaji;
        $pengeluarangaji->tanggal = $request->tanggal;
        $pengeluarangaji->save();

        $datagaji = Gaji::find(1);

        $cekidpengeluarangaji = PengeluaranGaji::all()->last();

        $detailgaji = new DetailGaji;
        $detailgaji->id_pengeluaran_gaji = $cekidpengeluarangaji->id;
        $detailgaji->id_gaji = $datagaji->id;
        $detailgaji->save();


        return redirect('/datapengeluarangaji')->with('create', 'Data Pengeluaran Gaji Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pengeluarangaji = PengeluaranGaji::find($id);
        $pengeluarangaji->update([
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/datapengeluarangaji')->with('update', 'Data Pengeluaran Gaji Berhasil Diubah!');
    }

    public function delete($id)
    {
        DetailGaji::where('id_pengeluaran_gaji', $id)->delete();
        PengeluaranGaji::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Data Berhasil Dihapus');
    }
}
