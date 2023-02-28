<?php

namespace App\Http\Controllers;

use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeriodeAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = PeriodeAkuntansi::where('status',1)->get();
        return view('periode.index', ['data' => $queryBuilder]);
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
        // Update Saldo Awal Akun
        $newjurnal = new JurnalAkuntansi();
        $perid = PeriodeAkuntansi::where('status', '1')->first();
        $periode_aktif_id = $perid->id;
        $update_akun = $newjurnal->penutupan_update_akun($periode_aktif_id);
        //Nonaktif Periode Aktif Sekarang
        $periode_aktif = PeriodeAkuntansi::where('status',1)->first();
        $periode_aktif->status = 0;
        $periode_aktif->save();
        $date_now = Carbon::now()->toDateString();

    
        // Add New Periode
        $date_now = Carbon::now()->toDateString();
        $date_end = Carbon::now()->addMonth($request->get('periode_durasi_new'))->toDateString();
        
        $new_periode = new PeriodeAkuntansi();
        $new_periode->tanggal_awal = $date_now;
        $new_periode->tanggal_akhir = $date_end;
        $new_periode->status = 1;
        $new_periode->save();


        // dd($update_akun);

        return redirect()->route('periode_akuntansi.index')->with('status', 'Berhasil Ganti Periode');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function show(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function edit(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeriodeAkuntansi  $periodeAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeriodeAkuntansi $periodeAkuntansi)
    {
        //
    }
}
