<?php

namespace App\Http\Controllers;

use App\JurnalAkuntansi;
// use Barryvdh\DomPDF\Facede;
use PDF;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;

class LaporanAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('checkakuntansi');

        $periode  = PeriodeAkuntansi::all();
        return view('laporan_akuntansi.index',compact('periode'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ExportPDF($periode)
    {
        $id =$periode;
        $perid = PeriodeAkuntansi::find($id);
        $nama_periode = date('d/m/Y', strtotime($perid->tanggal_awal)).' - '.date('d/m/Y', strtotime($perid->tanggal_akhir)) ;
        // dd($id);
        $queryBuilder = new JurnalAkuntansi();
        // $buku_besar = $queryBuilder->bukubesar($periode_aktif_id);
        $jurnals = JurnalAkuntansi::where('periode_id',$id)->get();
        
        $laba_rugi = $queryBuilder->labarugi($id);
        $ekuitas = $queryBuilder->perubahanekuitas($id);
        $neraca = $queryBuilder->neraca($id);
        $arus_kas = $queryBuilder->arus_kas($id);
        $pdf = PDF::loadView('laporan_akuntansi.print', compact('id','nama_periode','jurnals','laba_rugi','ekuitas','neraca','arus_kas') );
        // $pdf->download($nama_periode);
        // $a =$pdf->download('laporan-pegawai-pdf');
        
        return $pdf->download($nama_periode.'.pdf');


    }

    public function getdata(Request $request){
        $id = $request->get('id_periode');
        $perid = PeriodeAkuntansi::find($id);
        $nama_periode = date('d/m/Y', strtotime($perid->tanggal_awal)).' - '.date('d/m/Y', strtotime($perid->tanggal_akhir)) ;
        // dd($id);
        $queryBuilder = new JurnalAkuntansi();
        // $buku_besar = $queryBuilder->bukubesar($periode_aktif_id);
        $jurnals = JurnalAkuntansi::where('periode_id',$id)->get();
        
        $laba_rugi = $queryBuilder->labarugi($id);
        $ekuitas = $queryBuilder->perubahanekuitas($id);
        $neraca = $queryBuilder->neraca($id);
        $arus_kas = $queryBuilder->arus_kas($id);
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('laporan_akuntansi.data',compact('id','nama_periode','jurnals','laba_rugi','ekuitas','neraca','arus_kas'))->render()
        ),200);
    }
}
