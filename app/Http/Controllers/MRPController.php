<?php

namespace App\Http\Controllers;

use App\d_MRP;
use App\MPS;
use App\MRP;
use Illuminate\Http\Request;

class MRPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mps = MPS::where('status','belum diproses')->get();
        return view('mrp.index',compact('mps'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MRP  $mRP
     * @return \Illuminate\Http\Response
     */
    public function show(MRP $mRP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MRP  $mRP
     * @return \Illuminate\Http\Response
     */
    public function edit(MRP $mRP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MRP  $mRP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MRP $mRP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MRP  $mRP
     * @return \Illuminate\Http\Response
     */
    public function destroy(MRP $mRP)
    {
        //
    }
    public function getPerhitungMRP(Request $request)
    {
        $idmps = $request->idmps;
        $mrp = new MRP();
        $mrp = $mrp->perhitungan($idmps);
        // dd($mrp);
        $lfl = $mrp[0];
        $total_produksi = $mrp[1];
        $nama_bahan = $mrp[2];
        $satuan_bahan_jadi = $mrp[3];
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('mrp.getPerhitunganMRP',compact('lfl','total_produksi','nama_bahan','satuan_bahan_jadi'))->render()
        ), 200);
    }

    public function laporanKebutuhan()
    {
        $mps = MPS::where('status','proses produksi')->get();
        return view('mrp.laporan',compact('mps'));
    }
    public function getLaporanKebutuhn(Request $request)
    {
        $idmps = $request->idmps;
        $mrp = MRP::where('MPS_id', $idmps)->first();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('mrp.getLaporanKebutuhan',compact('mrp'))->render()
        ), 200);
    }
}
