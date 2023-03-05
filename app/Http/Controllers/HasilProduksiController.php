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
        $this->authorize('check_bom_mps_mrp_hasilproduksi');

        $queryBuilder = HasilProduksi::all();
        $barang = Barang::all();
        $surat_perintah_kerja = SPK::all();
        $user = User::all();

        // dd($queryBuilder);

        return view('hasilproduksi.index', ['data' => $queryBuilder, 'barang' => $barang, 'surat_perintah_kerja' => $surat_perintah_kerja, 'user' => $user]);
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
        return view('pemasukantelur.create', ['barang' => $barang, 'user' => $user, 'spk' => $spk]);
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

        # code...
        $data = new HasilProduksi();
        $data->tgl_pencatatan = $request->get('tgl_pencatatan');
        $data->kuantitas_reject = $request->get('input_kn_reject');
        $data->kuantitas_bersih = $request->get('input_kn_bersih');
        $data->total_kuantitas = $request->get('input_kn_total');
        $data->keterangan = $request->get('keterangan');
        $data->pengguna_id = $user->id;

        //bertambah stok
        $barang_update = Barang::find($request->get('barang'));

        $kuantitas_stok_ready_old = $barang_update->kuantitas_stok_ready;
        $kuantitas_stok_ready_new = $kuantitas_stok_ready_old  + $request->get('input_kn_bersih');
        $total_kuantitas_stok_old  = $barang_update->total_kuantitas_stok;
        $total_kuantitas_stok_new  = $total_kuantitas_stok_old + $request->get('input_kn_bersih');

        $barang_update->kuantitas_stok_ready = $kuantitas_stok_ready_new;
        $barang_update->total_kuantitas_stok = $total_kuantitas_stok_new;
        $barang_update->save();

        $spk = SPK::find($request->get('no_surat_perintah_kerja'));
        // dd($spk);
        $spk->hasilproduksi()->save($data);
        $barang = Barang::find($request->get('barang'));
        $barang->hasilproduksi()->save($data);

        return redirect()->route('hasilproduksi.index')->with('status', 'Hasil produksi ID '.$data->id.' berhasil ditambahkan');
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
}
