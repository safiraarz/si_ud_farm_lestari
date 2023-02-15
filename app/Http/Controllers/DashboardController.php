<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Flok;
use App\NotaPembelian;
use App\NotaPenjualan;
use App\PeriodeAkuntansi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $totalPopulasiAyam = Flok::all()->sum('populasi');
        $bulan_ini = date('m', strtotime('now'));
        $totalNotaPenjualan = NotaPenjualan::whereMonth('tgl_pembuatan_nota',$bulan_ini)->count();
        $totalNotaPembelian = NotaPembelian::whereMonth('tgl_pembuatan_nota',$bulan_ini)->count();
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);
        $periodeAkuntansi = PeriodeAkuntansi::whereBetween('tanggal_akhir', [$startDate, $endDate])->where('status',1)->get();
        return view('dashboard', compact('totalPopulasiAyam','totalNotaPenjualan','totalNotaPembelian','periodeAkuntansi'));
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
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
