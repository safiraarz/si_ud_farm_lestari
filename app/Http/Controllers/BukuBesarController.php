<?php

namespace App\Http\Controllers;

use App\AkunAkuntansi;
use App\JurnalAkuntansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuBesarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = JurnalAkuntansi::all();
        // $buku_besar = [];
        $akuns = AkunAkuntansi::all();
        $jurnals = JurnalAkuntansi::all();
        // $jurnals_detail =  DB::select(DB::raw("SELECT * FROM `jurnal_has_akun`"));
        // foreach ($akuns as $akun) {
        //     $tumpung['saldo_awal_kredit'] = [];
        //     $tumpung['saldo_awal_debet'] = [];
        //     $jenis_saldo = "";
        //     if($akun->jenis_akun =="aset"){
        //         // dd($akun->jenis_akun );
        //         if($akun->no_akun == 111){
        //             $jenis_saldo = "kredit";
        //         }
        //         else{
        //             $jenis_saldo = "debet";
        //         }
        //     }
        //     else if($akun->jenis_akun =="pendapatan"){
        //         $jenis_saldo = "kredit";
        //     }
        //     else if($akun->jenis_akun =="ekuitas"){
        //         if($akun->nama == "Prive"){
        //             $jenis_saldo = "debet";
        //         }
        //         else{
        //             $jenis_saldo = "kredit";
        //         }
        //     }
        //     else if($akun->jenis_akun == "biaya"){
        //         $jenis_saldo = "debet";

        //     }
        //     else{
        //         $jenis_saldo = "kredit";
        //     }
           
        //     $tumpung['no_akun'] = $akun->no_akun;
        //     $tumpung['saldo_awal_'.$jenis_saldo] = $akun->saldo_awal;
        //     $tumpung['list'] = []; 
        //     // $tumpung['total'] = []; 
        //     $jumlah_sebelum_closing = $akun->saldo_awal;
        //     $jumlah_setelah_closing = $akun->saldo_awal;
            
        //     $saldo_jurnal_ekses = $akun->saldo_awal;
        //     $total_sel = 0;
        //     $total_sesudah = 0;

        //     $jurnal_penutup = $akun->saldo_awal;
        //     foreach ($jurnals as $jurnal) {
        //         $no_reff = 1;
        //                 if($jurnal->jenis == "umum"){
        //                     $no_reff = 1;
        //                 }
        //                 else if($jurnal->jenis == "penyesuaian"){
        //                     $no_reff = 2;
        //                 }
        //                 else {
        //                     $no_reff = 3;
        //                 }
                        
        //         foreach ($jurnal->akun as $key =>  $jurnalakun) {
        //             if($akun->no_akun == $jurnalakun->no_akun){
        //                  if($no_reff == 3){
        //                     if($jurnalakun->pivot->nominal_kredit != 0){
        //                         $jurnal_penutup += $jurnalakun->pivot->nominal_kredit ;
        //                     }
        //                     else{
        //                         $jurnal_penutup  -= $jurnalakun->pivot->nominal_debit;
        //                     }
        //                     $selisih = abs($saldo_jurnal_ekses) - abs($jurnal_penutup)  ;
        //                     $total_sesudah = $saldo_jurnal_ekses;
                       

        //                     if($selisih == 0 ){
        //                         $total_sel = abs($jurnal_penutup);
        //                         $total_sesudah = abs($saldo_jurnal_ekses) - abs($jurnal_penutup) ;
        //                         // if($akun->saldo_awal == 0 && $akun->no_akun != 302 && $jenis_saldo !="biaya"){
        //                         // $total_sesudah = abs($jurnal_penutup) ;

        //                         // }
                                
        //                     }
        //                     else{
        //                         $total_sel = abs($saldo_jurnal_ekses) - abs($jurnal_penutup);
        //                         $total_sesudah = $jurnal_penutup ;
        //                     }

        //                     // echo $akun->no_akun.' 1 '.$jurnal_penutup.'<br>';
        //                     // echo $akun->no_akun.' 2 '.$selisih.'<br>';
        //                     // echo $akun->no_akun.' 3 '. $total_sel.'<br>';
        //                     // echo $akun->no_akun.' 4 '.$total_sesudah.'<br>';

        //                     // $saldo_jurnal_ekses = ($jurnalakun->pivot->nominal_kredit != 0) ?  ($saldo_jurnal_ekses - $jurnalakun->pivot->nominal_nominal_kredit ) : ($saldo_jurnal_ekses + $jurnalakun->pivot->nominal_debit );
                            
                           
        //                     // if(abs($saldo_jurnal_ekses) == 0){
        //                     //     $total_sel = ($jurnalakun->pivot->nominal_debit != 0) ?   $jurnalakun->pivot->nominal_debit  : $jurnalakun->pivot->nominal_kredit ;
        //                     // }

        //                     // $saldo_jurnal_ekses = $akun->saldo_awal;
        //                     // $jumlah_setelah_closing  = ($jurnalakun->pivot->nominal_debit != 0) ?  ($jumlah_setelah_closing - $jurnalakun->pivot->nominal_debit ) : ($jumlah_setelah_closing + $jurnalakun->pivot->nominal_kredit );
                            
        //                     // $selisih_jurnal_penutup = $jumlah_setelah_closing - $jumlah_sebelum_closing;
        //                     // $jumlah_sebelum_closing =  ;
        //                     // if($jurnal_penutup < 0 ){
        //                     //     $jurnal_penutup = 0;
        //                     // }
        //                     // dd($jurnal_penutup);
        //                     // $jumlah_setelah_closing = ( abs($jurnal_penutup));
        //                     // $jumlah_sebelum_closing =  abs($jurnal_penutup);
        //                     $detail = [
        //                         'tanggal' => $jurnal->tanggal_transaksi,
        //                         'no_bukti' => $jurnal->no_bukti,
        //                         'no_ref' => $no_reff,
        //                         'selisih'=>$jenis_saldo,
        //                         'keterangan' => $jurnal->transaksi->keterangan,
        //                         'debit'=> $jurnalakun->pivot->nominal_debit,
        //                         'kredit'=> $jurnalakun->pivot->nominal_kredit,
        //                         'saldo_debit' => ( $jenis_saldo == "debet" ) ? abs($jurnal_penutup) : 0,
        //                         'saldo_kredit' => ( $jenis_saldo == "kredit" ) ? abs($jurnal_penutup): 0,
        //                     ];
     
        //                 }
        //                 else{
        //                     // echo $akun->no_akun.' '.$jenis_saldo.' '.$saldo_jurnal_ekses.'<br>';
        //                     if($jurnalakun->pivot->nominal_kredit != 0){

        //                         $saldo_jurnal_ekses = ($jurnalakun->pivot->nominal_kredit != 0) ?  ($saldo_jurnal_ekses - $jurnalakun->pivot->nominal_kredit ) : 0;
        //                         // echo $akun->no_akun.' '.$jenis_saldo.' KREDIT '.$saldo_jurnal_ekses.'<br>';
        //                     }
        //                     else{

        //                         $saldo_jurnal_ekses = ($jurnalakun->pivot->nominal_debit != 0) ?  ($saldo_jurnal_ekses + $jurnalakun->pivot->nominal_debit ) : 0;
        //                         // echo $akun->no_akun.' '.$jenis_saldo.' '.$saldo_jurnal_ekses.'<br>';
        //                     }
        //                     $total_sel = $saldo_jurnal_ekses;
        //                     $detail = [
        //                         'tanggal' => $jurnal->tanggal_transaksi,
        //                         'no_bukti' => $jurnal->no_bukti,
        //                         'no_ref' => $no_reff,
        //                         'jenis_saldo' =>$jenis_saldo,
        //                         'keterangan' => $jurnal->transaksi->keterangan,
        //                         'debit'=> $jurnalakun->pivot->nominal_debit,
        //                         'kredit'=> $jurnalakun->pivot->nominal_kredit,
        //                         'saldo_debit' => ( $jenis_saldo == "debet" ) ? $saldo_jurnal_ekses: 0,
        //                         'saldo_kredit' => ( $jenis_saldo == "kredit" ) ? $saldo_jurnal_ekses: 0,
        //                     ];
        //                     // if($jenis_saldo == "kredit"){
    
        //                     // }
        //                     // else{
        //                     //     $saldo_jurnal_ekses = ($jurnalakun->pivot->nominal_debit != 0) ?  ($saldo_jurnal_ekses +$jurnalakun->pivot->nominal_debit ) : ($saldo_jurnal_ekses - $jurnalakun->pivot->nominal_kredit );
    
        //                     // }
        //                     // if($no_reff != 3)
        //                     $total_sesudah = $saldo_jurnal_ekses;
                            
        //                     // $total_sesudah = $saldo_jurnal_ekses;
        //                     // $total_sel = abs($saldo_jurnal_ekses);
        //                     // $jumlah_setelah_closing = $saldo_jurnal_ekses ;
                           
                            
        //                 }
                        

                       
                        
        //                 array_push($tumpung['list'],$detail);
                            
        //             }
                

        //         }
               
               
               
                
        //     }
        //     $test = [];


        //     $tumpung['saldo_sebelum_closing'] = abs($total_sel); 
        //     $tumpung['saldo_setelah_closing'] = abs($total_sesudah); 
        //     // foreach( $tumpung['list'] as $value){
        //     //     array_push($tumpung['total'],$value);
        //     // }
            
        //     array_push($buku_besar,$tumpung);
        //     unset($tumpung);
        //     // dd($test);
            
        
        // }

   
        // // array_push($buku_besar,$total);
        // dd($buku_besar);

        $buku_besar = new JurnalAkuntansi();
        // JurnalAkuntansi::bukubesar();
        // $buku_besar->jenis_saldo("");
        $buku_besar = $buku_besar->bukubesar();
        // dd($buku_besar);
        return view('bukubesar.index', ['data' => $buku_besar]);

        // $total = [];
        // $totals = 0 ;
        // $totals_ = 0 ;
        // $totals_2 = 0 ;

        // foreach ($buku_besar as $value) {
        //     # code...
        //     // dd($value);
        //     $saldo_awal_kredet =  $value['saldo_awal_kredit']  ? $value['saldo_awal_kredit'] : 0;
        //     $saldo_awal_debet =  $value['saldo_awal_debet']? $value['saldo_awal_debet'] : 0;
        //     // dd($saldo_awal_debet);
        //     // $totals = $saldo_awal_debet;
          
        //     foreach ($value['list'] as $keys => $values) {
        //         $total[$value['no_akun']] = [];
                
        //         # code...
        //         // dd($value['saldo_awal_debit']);
        //         // $saldo_awal_debet -= $values['saldo_debit'];
               
        //         // array_push($total[$value['no_akun']],$values['saldo_debit']);
        //         // array_push($total[$value['no_akun']],$values['saldo_kredit']);
        //         $a = $values['saldo_debit'];
        //         $b = $values['saldo_kredit'];
        //         if($values['no_ref'] == 3){
        //             $selisih =  $values['kredit'] + $values['debit'];
        //             // $totals =   $selisih - $saldo_awal_debet;
        //             $totals_ = $values['saldo_debit'];
        //             $totals_2 = $values['saldo_kredit'];
        //             $awal  =  ( $saldo_awal_kredet + $saldo_awal_debet ) + $selisih; 
        //             $a = $awal ;
        //             $b = $totals_2 + $totals_;
        //             // array_push($total[$value['no_akun']],$totals_);
        //             // array_push($total[$value['no_akun']],$totals_2);
        //             // array_push($total[$value['no_akun']],$selisih);
        //             // array_push($total[$value['no_akun']],$awal);
        //             // array_push($total[$value['no_akun']],$totals);



        //         }
        //         $detail = [
        //             'before'=> $a,
        //             'after' => $b
        //         ];
        //         array_push($total[$value['no_akun']],$detail);
        //         // dd($values);
        //         // array_push($total[$value['no_akun']],$values['no_ref']);
                
              
               




        //     }
        //     // array_push($total[$value['no_akun']],$saldo_awal_debet);


        // }
        
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
}
