<?php

namespace App\Http\Controllers;

use App\Models\Vaksin;
use Illuminate\Http\Request;

class ApiDataOvkController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'tanggal_ovk' => 'required',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required',
            'next_ovk' => 'required',
            'biaya_ovk' => 'required',
        ]);

        $totalbiayaovk = $data['jumlah_ayam'] * $data['biaya_ovk'];

        $ovk = Vaksin::create([
            'tanggal_ovk' => $data['tanggal_ovk'],
            'jenis_ovk' => $data['jenis_ovk'],
            'jumlah_ayam' => $data['jumlah_ayam'],
            'next_ovk' => $data['next_ovk'],
            'biaya_ovk' => $data['biaya_ovk'],
            'total_biaya' => $totalbiayaovk
        ]);
        return response()->json([
            'message' => "success",
            'ovk' => $ovk
        ]);
    }

    public function read()
    {
        $ovk = Vaksin::whereNotNull('tanggal_ovk')->orderByDesc('id')->get();

        return response()->json([
            'message' => "success",
            'ovk' => $ovk
        ]);
    }

    public function readIdTerakhir()
    {
        $ovk = Vaksin::whereNotNull('tanggal_ovk')->orderByDesc('id')->first();

        return response()->json([
            'message' => "success",
            'ovk' => $ovk
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal_ovk' => 'required',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required',
            'next_ovk' => 'required',
            'biaya_ovk' => 'required',
        ]);

        $ovk = Vaksin::findOrFail($id);

        $totalbiayaovk = $data['jumlah_ayam'] * $data['biaya_ovk'];

        $ovk->update([
            'tanggal_ovk' => $data['tanggal_ovk'],
            'jenis_ovk' => $data['jenis_ovk'],
            'jumlah_ayam' => $data['jumlah_ayam'],
            'next_ovk' => $data['next_ovk'],
            'biaya_ovk' => $data['biaya_ovk'],
            'total_biaya' => $totalbiayaovk
        ]);
        return response()->json([
            'message' => "success",
            'ovk' => $ovk
        ]);
    }

    public function delete($id)
    {

        $ovk = Vaksin::findOrFail($id);
        $ovk->delete();

        return response()->json([
            'message' => "success",
            'ovk' => $ovk
        ]);
    }
}
