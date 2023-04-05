<?php

namespace App\Http\Controllers;

use App\Barang;
use App\MPS;
use App\SPK;
use Illuminate\Http\Request;

class MPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('check_bom_mps_mrp_hasilproduksi');

        $queryBuilder = MPS::all();
        $spk = SPK::all();
        $barang = Barang::all();
        return view('mps.index', ['data' => $queryBuilder,'barang' => $barang,'spk' => $spk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spk = SPK::all();
        $barang = Barang::all();
        return view('mps.create', ['spk' => $spk,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new MPS();
        // $barang = Barang::find($request->get('bahan_baku'));
        // dd($barang);
        $data->tgl_mulai_produksi = $request->get('tgl_mulai_produksi');
        $data->tgl_selesai_produksi = $request->get('tgl_selesai_produksi');
        $data->kuantitas_barang_jadi = $request->get('kuantitas_barang_jadi');
        $data->status = "belum diproses";

        $spk = SPK::find($request->get('spk'));
        // dd($spk);
        $spk->mps2()->save($data);
        $barang = Barang::find($request->get('bahan_baku'));
        $barang->mps()->save($data);

        
        return redirect()->route('mps.index')->with('status', 'MPS '.$data->id.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function show(MPS $mPS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function edit(MPS $mPS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPS $mPS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MPS  $mPS
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPS $mPS)
    {
        //
    }

    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');
        // dd($fnama);
        $MPS = MPS::find($id);
        $kuantitas = $MPS->kuantitas_barang_jadi;
        $barang_id = $MPS->barang->id;
        if($value == "proses produksi"){
            // “stok_kuantitas_on_produksi” dan “total_kuantitas_stok” pada DB barang akan bertambah
            $barang = Barang::find($barang_id);
            $stok_kuantitas_on_produksi_old = $barang->kuantitas_stok_onorder_produksi;
            $total_kuantitas_old = $barang->total_kuantitas_stok;

            $stok_kuantitas_on_produksi_new = $kuantitas +  $stok_kuantitas_on_produksi_old;
            $total_kuantitas_new = $kuantitas + $total_kuantitas_old;

            $barang->kuantitas_stok_onorder_produksi = $stok_kuantitas_on_produksi_new;
            $barang->total_kuantitas_stok = $total_kuantitas_new;
            $barang->save();

        }else if($value == "selesai produksi"){
            // “stok_kuantitas_on_produksi” dan “total_kuantitas_stok” pada DB barang akan berkurang
            $barang = Barang::find($barang_id);
            $stok_kuantitas_on_produksi_old = $barang->kuantitas_stok_onorder_produksi;
            $total_kuantitas_old = $barang->total_kuantitas_stok;

            $stok_kuantitas_on_produksi_new =  $stok_kuantitas_on_produksi_old - $kuantitas ;
            $total_kuantitas_new = $total_kuantitas_old -  $kuantitas;

            $barang->kuantitas_stok_onorder_produksi = $stok_kuantitas_on_produksi_new;
            $barang->total_kuantitas_stok = $total_kuantitas_new;
            $barang->save();

        }
        $MPS->$fnama = $value;
        $MPS->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => strtoupper($fnama).' MPS berhasil diupdate'
            ),
            200
        );
    }
}
