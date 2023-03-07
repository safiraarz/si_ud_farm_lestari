<?php

namespace App\Http\Controllers;

use App\Flok;
use App\Dashboard;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\HasilProduksi;
use App\NotaPembelian;
use App\NotaPenjualan;
use App\PeriodeAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $totalNotaPenjualan = NotaPenjualan::whereMonth('tgl_pembuatan_nota',$bulan_ini)->count();
        // $totalNotaPembelian = NotaPembelian::whereMonth('tgl_pembuatan_nota',$bulan_ini)->count();
        // $totalHargaPembelian = NotaPembelian::all()->sum('total_harga');
        $totalNotaPenjualan = NotaPenjualan::whereMonth('tgl_pembuatan_nota',$bulan_ini)->sum('total_harga');
        // $totalHargaPenjualan = NotaPenjualan::all()->sum('total_harga');
        $totalNotaPembelian = NotaPembelian::whereMonth('tgl_pembuatan_nota',$bulan_ini)->sum('total_harga');
        // dd($totalNotaPembelian);
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);
        $periodeAkuntansi = PeriodeAkuntansi::whereBetween('tanggal_akhir', [$startDate, $endDate])->where('status',1)->get();
        $hasil_produksi_bulan_ini = HasilProduksi::whereMonth('tgl_pencatatan',$bulan_ini)->get();
        $hasil_produksi_perminggu = HasilProduksi::selectRaw('tgl_pencatatan as tanggal, count(*) as total')->whereBetween('tgl_pencatatan', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->groupBy('tgl_pencatatan')->get();
        // dd($hasil_produksi_perminggu);
        $startDate = Carbon::createFromFormat('Y-m-d', Carbon::now()->startOfWeek()->format('Y-m-d'));
        $endDate = Carbon::createFromFormat('Y-m-d', Carbon::now()->endOfWeek()->format('Y-m-d'));
        $dateRange = CarbonPeriod::create($startDate, $endDate);

        $hasil_produksi = [];
        foreach ($dateRange->toArray() as $key => $value) {
            # code...
            $tamps[$value->toDateString()] = [];
            $tamps[$value->toDateString()] = 0;
            foreach ($hasil_produksi_perminggu as $value2) {
                // dd($value2->tanggal);
                
                if($value->toDateString() == $value2->tanggal){
                    // $tamps = [ $value2->tanggal => $value2->total];
                    $tamps[$value->toDateString()]= $value2->total;
                    // array_push($tamps[$value->toDateString()],$value2->total);
                }
                // else{
                //     // $tamps = [ $value->toDateString() => 0];
                //     array_push($tamps[$value->toDateString()],0);
                //     // array_push($tamps,0);

                // }
                
            }
            array_push($hasil_produksi,$tamps);
            unset( $tamps[$value->toDateString()]);
        }

   

        // dd($hasil_produksi);
        return view('dashboard', compact('hasil_produksi','totalPopulasiAyam','totalNotaPenjualan','totalNotaPembelian','periodeAkuntansi','hasil_produksi_perminggu'));
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
