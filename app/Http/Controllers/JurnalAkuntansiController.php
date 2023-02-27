<?php

namespace App\Http\Controllers;

use App\AkunAkuntansi;
use App\JurnalAkuntansi;
use App\PeriodeAkuntansi;
use App\TransaksiAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = PeriodeAkuntansi::all();
        // $queryBuilder = JurnalAkuntansi::all();
         // Get Periode Aktif
         $perid = PeriodeAkuntansi::where('status', '1')->first();
         $periode_aktif_id = $perid->id;
         $jurnals = JurnalAkuntansi::where('periode_id',$periode_aktif_id)->get();
        // dd($queryBuilder);
        return view('jurnal.index', ['data' => $jurnals,'periode'=>$periode]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $periode = PeriodeAkuntansi::where('status', '1')->get();
        $akun = AkunAkuntansi::all();
        // Generate No Bukti
        $new_count = DB::connection('akuntansi')->select(DB::raw("SELECT MAX(SUBSTRING(no_bukti,-2)) + 1 as NewCount FROM jurnal WHERE SUBSTRING(no_bukti,1,1) = 'K'; "));
        $no_bukti_generator = 'K'.str_pad($new_count[0]->NewCount, 3, "0", STR_PAD_LEFT);
        return view('jurnal.create',compact('periode', 'akun','no_bukti_generator'));
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
        // dd($request->get("jurnal") );
        if( $request->get('jurnal') != null && $request->get('jenis_jurnal') != null ){
             // Get Periode Aktif
             $perid = PeriodeAkuntansi::where('status', '1')->first();
             $periode_aktif_id = $perid->id;
             // Add Transaksi
             $new_transaksi = new TransaksiAkuntansi();
             $new_transaksi->keterangan = $request->get('keterangan_input');
             $new_transaksi->save();
             $id_transaksi = $new_transaksi->id;
 
             // Jurnal Create
             $jurnal = new JurnalAkuntansi();
             $jurnal->jenis =$request->get('jenis_jurnal');
             $jurnal->tanggal_transaksi =$request->get('tgl_pencatatan');
             $jurnal->no_bukti =$request->get('no_bukti');
             $jurnal->transaksi_id = $id_transaksi ;
             $jurnal->periode_id = $periode_aktif_id;
             $jurnal->save();
            foreach($request->get("jurnal") as $details) 
            {
                // dd($details);
                $jurnal->akun()->attach(
                    $details['no_akun'],
                    [
                        'no_urut' =>$details['no_urut'],
                        'nominal_kredit' =>$details['nominal_kredit'],
                        'nominal_debit'=>$details['nominal_debit']
                    ]);
            }
         
            return redirect()->route('jurnal_akuntansi.index')->with('status', 'Berhasil Menambahkan Jurnal ' . $request->get('jenis_jurnal'));

        }
        else{
            return redirect()->route('jurnal_akuntansi.index')->with('error', 'Gagal Menambahkan Jurnal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JurnalAkuntansi  $jurnalAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalAkuntansi $jurnalAkuntansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JurnalAkuntansi  $jurnalAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalAkuntansi $jurnalAkuntansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JurnalAkuntansi  $jurnalAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JurnalAkuntansi $jurnalAkuntansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalAkuntansi  $jurnalAkuntansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalAkuntansi $jurnalAkuntansi)
    {
        //
    }
}
