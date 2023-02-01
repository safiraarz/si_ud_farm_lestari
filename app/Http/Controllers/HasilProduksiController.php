<?php

namespace App\Http\Controllers;

use App\Barang;
use App\HasilProduksi;
use App\SPK;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = HasilProduksi::all();
        $barang = Barang::all();
        $surat_perintah_kerja = SPK::all();
        $user = User::all();
        
        // dd($queryBuilder);

        return view('hasilproduksi.index', ['data' => $queryBuilder,'barang'=>$barang,'surat_perintah_kerja'=>$surat_perintah_kerja,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $user = User::all();
        $spk = SPK::all();
        return view('pemasukantelur.create', ['barang' => $barang, 'user' => $user,'spk' => $spk]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        // dd($request->get('barang'));
        foreach ($request->get('barang') as  $value) {
            # code...
            $data = new HasilProduksi();
            $data->tgl_pencatatan = $request->get('tgl_pencatatan');
            $data->kuantitas_reject = $request->get('input_kn_reject');
            $data->kuantitas_bersih = $request->get('input_kn_bersih');
            $data->total_kuantitas = $request->get('input_kn_total');
            $data->keterangan = $request->get('keterangan');
            $data->pengguna_id = $user->id;

            $spk = SPK::find($request->get('no_surat_perintah_kerja'));
            // dd($spk);
            $spk->hasilproduksi()->save($data);
            $barang = Barang::find($value['barang_id']);
            $barang->hasilproduksi()->save($data);
        }
        return redirect()->route('hasilproduksi.index')->with('status', 'Success Add Hasil Produksi');
        



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function show(HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilProduksi $hasilProduksi)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = HasilProduksi::find($id);
        $barang = Barang::all();
        $surat_perintah_kerja = SPK::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('hasilproduksi.getEditForm', compact('data', 'barang','surat_perintah_kerja'))->render()
        ), 200);
    }
}
