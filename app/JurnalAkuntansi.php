<?php

namespace App;

use Carbon\Carbon;
use App\AkunAkuntansi;
use App\PeriodeAkuntansi;
use App\TransaksiAkuntansi;
use Illuminate\Database\Eloquent\Model;

class JurnalAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "jurnal";

    public function periode(){
        return $this->belongsTo('App\PeriodeAkuntansi','periode_id');
    }
    public function transaksi(){
        return $this->belongsTo('App\TransaksiAkuntansi','transaksi_id');
    }

    public function akun(){
        return $this->belongsToMany('App\AkunAkuntansi','jurnal_has_akun','jurnal_id','akun_id')->withPivot('no_urut','nominal_debit','nominal_kredit')->orderBy('no_urut', 'asc');
    }

    public static function jenis_saldo($jenis_akun,$no_akun){
        $jenis_saldo = "";
            if($jenis_akun =="aset"){
                if($no_akun == 111){
                    $jenis_saldo = "kredit";
                }
                else{
                    $jenis_saldo = "debet";
                }
            }
            else if($jenis_akun =="pendapatan"){
                $jenis_saldo = "kredit";
            }
            else if($jenis_akun =="ekuitas"){
                if($no_akun == 302){
                    $jenis_saldo = "debet";
                }
                else{
                    $jenis_saldo = "kredit";
                }
            }
            else if($jenis_akun == "biaya"){
                $jenis_saldo = "debet";

            }
            else{
                $jenis_saldo = "kredit";
            }
        return $jenis_saldo;
    }

    function no_ref($no_reff_input){
        $no_reff  = "";
        if($no_reff_input == "umum"){
            $no_reff = 1;
        }
        else if($no_reff_input == "penyesuaian"){
            $no_reff = 2;
        }
        else {
            $no_reff = 3;
        }
        return $no_reff ;
    }

    public function bukubesar($id_periode){
        $buku_besar2 = [];
        $buku_besar = new JurnalAkuntansi();
        $akuns = AkunAkuntansi::where('periode_id',$id_periode)->get();

        $jurnals = JurnalAkuntansi::where('periode_id',$id_periode)->get();
        // $jurnals_detail =  DB::select(DB::raw("SELECT * FROM `jurnal_has_akun`"));
        foreach ($akuns as $akun) {
            $tumpung['saldo_awal_kredit'] = 0;
            $tumpung['saldo_awal_debet'] = 0;
            $jenis_saldo =$buku_besar->jenis_saldo($akun->jenis_akun,$akun->no_akun);
           
            $tumpung['no_akun'] = $akun->no_akun;
            $tumpung['nama_akun'] = $akun->nama;
            $tumpung['jenis_akun'] = $akun->jenis_akun;
            $tumpung['saldo_awal_'.$jenis_saldo] = $akun->saldo_awal;
            $tumpung['list'] = []; 
            $jumlah_sebelum_closing = $akun->saldo_awal;
            $jumlah_setelah_closing = $akun->saldo_awal;
            
            $saldo_jurnal_ekses =$akun->saldo_awal;
            $total_sel = 0;
            $total_sesudah = 0;

            $jurnal_penutup = $akun->saldo_awal;
            $jurnal_penyesuaian = $akun->saldo_awal;
            foreach ($jurnals as $jurnal) {
                // dd($jurnal->jenis);
                $no_reff = $buku_besar->no_ref($jurnal->jenis);
                        
                
                // echo $jurnal.'<br>'.'<br>';
                foreach ($jurnal->akun as $key =>  $jurnalakun) {
                    if($akun->no_akun == $jurnalakun->no_akun){
                         if($no_reff == 3){
                            if($jenis_saldo == "kredit"){
                                if($jurnalakun->pivot->nominal_kredit != 0){
                                    $jurnal_penutup += $jurnalakun->pivot->nominal_kredit ;
                                }
                                else{
                                    $jurnal_penutup  -= $jurnalakun->pivot->nominal_debit;
                                }
                            }
                            else{
                                if($jurnalakun->pivot->nominal_kredit != 0){
                                    $jurnal_penutup -= $jurnalakun->pivot->nominal_kredit ;
                                }
                                else{
                                    $jurnal_penutup  += $jurnalakun->pivot->nominal_debit;
                                }
                            }
                           
                            $selisih = abs($saldo_jurnal_ekses) - abs($jurnal_penutup)  ;
                            $total_sesudah = $saldo_jurnal_ekses;

                            if($selisih == 0 ){
                                $total_sel = abs($jurnal_penutup);
                                $total_sesudah = abs($saldo_jurnal_ekses) - abs($jurnal_penutup) ;
                                
                            }
                            else{
                                $total_sel = abs($jurnal_penutup) - abs($selisih);
                                $total_sesudah = $jurnal_penutup ;
                            }
                            
                            $detail = [
                                'jurnal_id' => $jurnal->id,
                                'tanggal' => $jurnal->tanggal_transaksi,
                                'no_bukti' => $jurnal->no_bukti,
                                'no_ref' => $no_reff,
                                'selisih'=>$jenis_saldo,
                                'keterangan' => $jurnal->transaksi->keterangan,
                                'debit'=> $jurnalakun->pivot->nominal_debit,
                                'kredit'=> $jurnalakun->pivot->nominal_kredit,
                                'saldo_debit' => ( $jenis_saldo == "debet" ) ? abs($selisih) : 0,
                                'saldo_kredit' => ( $jenis_saldo == "kredit" ) ? abs($selisih): 0,
                            ];
     
                        }
                        else{
                            if($jenis_saldo == "kredit"){
                                if($jurnalakun->pivot->nominal_kredit != 0 ){

                                    $saldo_jurnal_ekses +=  $jurnalakun->pivot->nominal_kredit;
                                }
                                else{
                                    
                                    $saldo_jurnal_ekses -=  $jurnalakun->pivot->nominal_debit;
                
                                }
                            }
                            else{
                                if($jurnalakun->pivot->nominal_kredit != 0 ){

                                    $saldo_jurnal_ekses -=  $jurnalakun->pivot->nominal_kredit;
                                }
                                else{
                                    
                                    $saldo_jurnal_ekses +=  $jurnalakun->pivot->nominal_debit;
                
                                }
                            }

                            
                            $total_sel = $saldo_jurnal_ekses;
                            $detail = [
                                'jurnal_id' => $jurnal->id,
                                'tanggal' => $jurnal->tanggal_transaksi,
                                'no_bukti' => $jurnal->no_bukti,
                                'no_ref' => $no_reff,
                                'jenis_saldo' =>$jenis_saldo,
                                'keterangan' => $jurnal->transaksi->keterangan,
                                'debit'=> $jurnalakun->pivot->nominal_debit,
                                'kredit'=> $jurnalakun->pivot->nominal_kredit,
                                'saldo_debit' => ( $jenis_saldo == "debet" ) ? abs($saldo_jurnal_ekses): 0,
                                'saldo_kredit' => ( $jenis_saldo == "kredit" ) ? abs($saldo_jurnal_ekses): 0,
                            ];
                           
                            $total_sesudah = $saldo_jurnal_ekses;
   
                        }

                      
                        array_push($tumpung['list'],$detail);
                        
                            
                    }
                

                }
            
            }
            // jika tidak ada transaksi
            if(count($tumpung['list']) == 0){
                $tumpung['saldo_sebelum_closing'] = abs($akun->saldo_awal);
            
            }
            else{

                $tumpung['saldo_sebelum_closing'] = abs($total_sel); 
            }
            $tumpung['saldo_setelah_closing'] = abs($total_sesudah); 
            
            array_push($buku_besar2,$tumpung);
            unset($tumpung);

        }

        

        return $buku_besar2;
    }
    public function labarugi($id_periode){
        // $buku_besar = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode);
        $laba_rugi['pendapatan'] = [];
        $laba_rugi['biaya'] = [];
        $akuns = AkunAkuntansi::where('periode_id',$id_periode)->get();
        $total_pendapatan = 0;
        $total_biaya = 0;
        foreach ($buku_besar as $value) {
            if($value['jenis_akun']== "pendapatan"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = $value['saldo_sebelum_closing'];
                $total_pendapatan += $saldo;
                $pendapatan = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $laba_rugi['pendapatan'], $pendapatan);
            }
            if($value['jenis_akun']== "biaya"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = $value['saldo_sebelum_closing'];
                $total_biaya += $saldo;
                $biaya = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $laba_rugi['biaya'], $biaya);
            }
        }
        $laba_rugi['total_pendapatan'] = $total_pendapatan;
        $laba_rugi['total_biaya'] = $total_biaya;
        $laba_rugi['laba_rugi'] = $total_pendapatan - $total_biaya;


        return  $laba_rugi;
    }

    public static function perubahanekuitas($id_periode){
        // $perubahan_ekuitas = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode);
        $laba_rugi = $newjurnal->labarugi($id_periode);
        $modal = 0;
        $prive = 0 ;
        $total= 0;
        $perubahan_ekuitas = [];
        $perubahan_ekuitas['list'] = [];

        foreach ($buku_besar as $value) {
            if($value['jenis_akun']== "ekuitas"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = $value['no_akun'] == 302 ? ($value['saldo_sebelum_closing'] * -1) : $value['saldo_sebelum_closing'];
                $total += $saldo;
                $pendapatan = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $perubahan_ekuitas['list'], $pendapatan);
            }
        }
        $pendapatan = [
            'no_akun'=> 000,
            'nama_akun'=> " Laba Rugi",
            'saldo' => $laba_rugi['laba_rugi']
        ];
        array_push( $perubahan_ekuitas['list'], $pendapatan);
        $perubahan_ekuitas['total'] = $total + $laba_rugi['laba_rugi'];
        return $perubahan_ekuitas;
    }


    public static function neraca($id_periode){
        // $perubahan_ekuitas = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode);
        $perubahanekuitas = $newjurnal->perubahanekuitas($id_periode);
        $neraca = [];
        $neraca['aset'] = [];
        $neraca['kewajiban'] = [];
        $neraca['ekuitas'] = [];

        $total_aset = 0;
        $total_kewajiban = 0;
        $total_ekuitas = 0;

        foreach ($buku_besar as $value) {
            if($value['jenis_akun']== "aset"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = ($value['no_akun'] == 111) ? ($value['saldo_sebelum_closing'] * -1) : $value['saldo_sebelum_closing'];
                $total_aset += $saldo;
                $list = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $neraca['aset'], $list);
            }
            if($value['jenis_akun']== "kewajiban"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = ($value['no_akun'] == 111) ? ($value['saldo_sebelum_closing'] * -1) : $value['saldo_sebelum_closing'];
                $total_kewajiban += $saldo;
                $list = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $neraca['kewajiban'], $list);
            }
            if($value['jenis_akun']== "ekuitas" && $value['nama_akun']!= "Prive"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::where('no_akun',$no_akun)->where('periode_id',$id_periode)->first();
                $nama_akun = $akun->nama;
                $saldo = $perubahanekuitas['total'];
                $total_ekuitas += $saldo;
                $list = [
                    'no_akun'=> $no_akun,
                    'nama_akun'=> $nama_akun,
                    'saldo' => $saldo,
                ];
                array_push( $neraca['ekuitas'], $list);
            }
        }

        $neraca['total_aset'] = $total_aset;
        $neraca['total_kewajiban'] = $total_kewajiban;
        $neraca['total_ekuitas'] = $total_ekuitas;
        $neraca['total_pasiva'] = $total_kewajiban + $total_ekuitas;
        
        return $neraca;
    }

    public static function arus_kas($id_periode){
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode);
        $akuns = AkunAkuntansi::where('periode_id',$id_periode)->get();
 
        $penerimaan_dari_pelanggan = 0;
        $pembayaran_ke_pemasok = 0;
        $pembelian_aset_tetap = 0;
        $pembayaran_biaya_biaya = 0;
        $koreksi = 0;

        $saldo_awal_kredit = 0;
        $saldo_awal_debit = 0;

        // dd($buku_besar);


            foreach ($buku_besar as $bukubesar) {

                if($bukubesar['no_akun'] == 101){
                    $saldo_awal_debit += $bukubesar['saldo_awal_debet'];
                    $saldo_awal_kredit += $bukubesar['saldo_awal_kredit'];

                    
                    foreach ($bukubesar['list'] as $list) {
                        $jurnalData = JurnalAkuntansi::find($list['jurnal_id']);
                        if(count($jurnalData->akun) > 2){
                            // echo 'Test '.count($jurnalData->akun).'<br>';
                            foreach ($jurnalData->akun as $akunjur) {

                                if($akunjur->no_akun != 101){
                                    $koreksi = $akunjur->pivot->nominal_debit != 0 ? ( $koreksi + $akunjur->pivot->nominal_debit) : ( $koreksi- $akunjur->pivot->nominal_kredit) ;
    
                                }
                            }
                        }
                        else{
                            foreach ($jurnalData->akun as $akunjur) {
                                # code...
                                if($akunjur->no_akun != 101){
                                    // Where Pendapatan
                                    if($akunjur->jenis_akun == 'pendapatan'){
                                        // echo $jurnalData->id.'<br>';
                                        // echo 'debit '.$akunjur->pivot->nominal_debit.'<br>';
                                        // echo 'kredit '.$akunjur->pivot->nominal_kredit.'<br>';

                                        $penerimaan_dari_pelanggan = $akunjur->pivot->nominal_debit != 0 ? ( $penerimaan_dari_pelanggan + $akunjur->pivot->nominal_debit) : ( $penerimaan_dari_pelanggan - $akunjur->pivot->nominal_kredit) ;
                                    }
                                    if($akunjur->jenis_akun == 'aset' && $akunjur->no_akun != 102 && $akunjur->no_akun != 110 && $akunjur->no_akun != 111){
                                        // echo 'Asset <br>';
                                        
                                        // echo $jurnalData->id.'<br>';
                                        $pembayaran_ke_pemasok = $akunjur->pivot->nominal_debit != 0 ? ( $pembayaran_ke_pemasok + $akunjur->pivot->nominal_debit) : ( $pembayaran_ke_pemasok - $akunjur->pivot->nominal_kredit) ;

                                    }
                                    if($akunjur->jenis_akun =='biaya'){
                                        $pembayaran_biaya_biaya = $akunjur->pivot->nominal_debit != 0 ? (  $pembayaran_biaya_biaya + $akunjur->pivot->nominal_debit) : (  $pembayaran_biaya_biaya - $akunjur->pivot->nominal_kredit) ;

                                    }
                                    if($akunjur->no_akun==110){
                                        $pembelian_aset_tetap = $akunjur->pivot->nominal_debit != 0 ? (  $pembelian_aset_tetap + $akunjur->pivot->nominal_debit) : (  $pembelian_aset_tetap - $akunjur->pivot->nominal_kredit) ;
                                    }
                                    // dd();
                                }
                            }
                        }
                       
                  
                    }
                }
                
                if($bukubesar['no_akun'] == 102){
                    $saldo_awal_debit += $bukubesar['saldo_awal_debet'];
                    $saldo_awal_kredit += $bukubesar['saldo_awal_kredit'];
                    foreach ($bukubesar['list'] as $list) {
                        $jurnalData = JurnalAkuntansi::find($list['jurnal_id']);
                        if(count($jurnalData->akun) > 2){
                            // echo 'Test '..'<br>';
                            foreach ($jurnalData->akun as $akunjur) {

                                if($akunjur->no_akun != 102){
                                    $koreksi = $akunjur->pivot->nominal_debit != 0 ? ( $koreksi + $akunjur->pivot->nominal_debit) : ( $koreksi- $akunjur->pivot->nominal_kredit) ;
    
                                }
                            }
                        }
                        else{
                            foreach ($jurnalData->akun as $akunjur) {
                                # code...
                                if($akunjur->no_akun != 102){
                                    // Where Pendapatan
                                    if($akunjur->jenis_akun == 'pendapatan'){
                                        // echo $jurnalData->id.'<br>';
                                        // echo 'debit '.$akunjur->pivot->nominal_debit.'<br>';
                                        // echo 'kredit '.$akunjur->pivot->nominal_kredit.'<br>';

                                        $penerimaan_dari_pelanggan = $akunjur->pivot->nominal_debit != 0 ? ( $penerimaan_dari_pelanggan + $akunjur->pivot->nominal_debit) : ( $penerimaan_dari_pelanggan - $akunjur->pivot->nominal_kredit) ;
                                    }
                                    if($akunjur->jenis_akun == 'aset' && $akunjur->no_akun != 101 && $akunjur->no_akun != 110 && $akunjur->no_akun != 111){
                                        // echo 'Asset <br>';
                                        
                                        // echo $jurnalData->id.'<br>';
                                        $pembayaran_ke_pemasok = $akunjur->pivot->nominal_debit != 0 ? ( $pembayaran_ke_pemasok + $akunjur->pivot->nominal_debit) : ( $pembayaran_ke_pemasok - $akunjur->pivot->nominal_kredit) ;

                                    }
                                    if($akunjur->jenis_akun =='biaya'){
                                        $pembayaran_biaya_biaya = $akunjur->pivot->nominal_debit != 0 ? (  $pembayaran_biaya_biaya + $akunjur->pivot->nominal_debit) : (  $pembayaran_biaya_biaya - $akunjur->pivot->nominal_kredit) ;

                                    }
                                    if($akunjur->no_akun==110){
                                        $pembelian_aset_tetap = $akunjur->pivot->nominal_debit != 0 ? (  $pembelian_aset_tetap + $akunjur->pivot->nominal_debit) : (  $pembelian_aset_tetap - $akunjur->pivot->nominal_kredit) ;
                                    }
                                    // dd();
                                }
                            }
                        }
                       
                  
                    }
                }
           
             
            }
            
        
        $arus_kas['saldo_awal'] = $saldo_awal_debit != 0 ?  $saldo_awal_debit :  $saldo_awal_kredit;
        $arus_kas['penerimaan_dari_pelanggan'] = abs($penerimaan_dari_pelanggan);
        $arus_kas['pembayaran_ke_pemasok'] = abs($pembayaran_ke_pemasok);
        $arus_kas['pembayaran_biaya_biaya'] = abs($pembayaran_biaya_biaya);

        $arus_kas['pembelian_aset_tetap'] = abs($pembelian_aset_tetap);
        $arus_kas['koreksi'] = abs($koreksi);
        $tampung = $penerimaan_dari_pelanggan + $pembayaran_ke_pemasok + $pembayaran_biaya_biaya +$pembelian_aset_tetap + $koreksi;

        $arus_kas['saldo_akhir'] = $arus_kas['saldo_awal'] - $tampung  ;
        return $arus_kas;

    }

    public static function generate_jurnal_penutupan($id_periode){
        $date_now = Carbon::now()->toDateString();
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode);
        $akuns = AkunAkuntansi::where('periode_id',$id_periode)->get();
        $iktiar = AkunAkuntansi::where('periode_id',$id_periode)->where('no_akun',000)->first();
        $iktiar_id = $iktiar->id;
      
        // Penutupan Step 1 Pendapatan
        $step_1_transaksi = new TransaksiAkuntansi();      
        $step_1_transaksi->keterangan = "Penutupan Step 1 - Pendapatan";
        $step_1_transaksi->save();
        $step_1_id_transaksi = $step_1_transaksi->id;
        $step_1 = new JurnalAkuntansi();
        $step_1->jenis = "penutup";
        $step_1->tanggal_transaksi = $date_now;
        $step_1->no_bukti = "";
        $step_1->transaksi_id =  $step_1_id_transaksi;
        $step_1->periode_id = $id_periode;
        $step_1->save();
        $step_1_iktiar = 0;
        $step_1_urut = 1;
        foreach ($akuns as $akun) {
            foreach($buku_besar as $bukubesar){
                if($akun->no_akun ==$bukubesar['no_akun'] ){
        
                    if($akun->jenis_akun == "pendapatan"){
                        $saldo_sebelum = $bukubesar['saldo_sebelum_closing'];
                        $step_1->akun()->attach($akun->id,['no_urut' =>$step_1_urut ,'nominal_kredit' =>0,'nominal_debit'=>$saldo_sebelum]);
                        $step_1_iktiar += $saldo_sebelum;
                        $step_1_urut += 1;
                    }
                    
                }
              
            }
        }
        // dd($step_1_iktiar);
        $step_1->akun()->attach($iktiar_id ,['no_urut' =>$step_1_urut ,'nominal_kredit' => $step_1_iktiar,'nominal_debit'=>0]);


        // Penutupan Step 2 Biaya
        $step_2_transaksi = new TransaksiAkuntansi();      
        $step_2_transaksi->keterangan = "Penutupan Step 2 - Biaya";
        $step_2_transaksi->save();
        $step_2_id_transaksi = $step_2_transaksi->id;
        $step_2 = new JurnalAkuntansi();
        $step_2->jenis = "penutup";
        $step_2->tanggal_transaksi = $date_now;
        $step_2->no_bukti = "";
        $step_2->transaksi_id =  $step_2_id_transaksi;
        $step_2->periode_id = $id_periode;
        $step_2->save();
        $step_2_iktiar = 0;
        $step_2_urut = 1;
        foreach ($akuns as $akun) {
            foreach($buku_besar as $bukubesar){
                if($akun->no_akun ==$bukubesar['no_akun'] ){
                    if($akun->jenis_akun == "biaya"){
                        $saldo_sebelum = $bukubesar['saldo_sebelum_closing'];
                        $step_2->akun()->attach($akun->id,['no_urut' =>$step_2_urut ,'nominal_kredit' =>$saldo_sebelum,'nominal_debit'=>0]);
                        $step_2_iktiar += $saldo_sebelum;
                        $step_2_urut += 1;
                    }
                    
                }
              
            }
        }
        $step_2->akun()->attach($iktiar_id ,['no_urut' =>$step_2_urut ,'nominal_kredit' => 0,'nominal_debit'=>$step_2_iktiar]);

        // Penutupan Step 3 Modal Rugi
        $step_3_transaksi = new TransaksiAkuntansi();      
        $step_3_transaksi->keterangan = "Penutupan Step 3 - Modal & Laba Rugi";
        $step_3_transaksi->save();
        $step_3_id_transaksi = $step_2_transaksi->id;
        $step_3 = new JurnalAkuntansi();
        $step_3->jenis = "penutup";
        $step_3->tanggal_transaksi = $date_now;
        $step_3->no_bukti = "";
        $step_3->transaksi_id =  $step_3_id_transaksi;
        $step_3->periode_id = $id_periode;
        $step_3->save();
        $step_3_total = $step_1_iktiar - $step_2_iktiar;
        foreach ($akuns as $akun) {
            if($akun->periode_id == $id_periode && $akun->no_akun== 301){

                $step_3->akun()->attach($akun->id,['no_urut' =>2 ,'nominal_kredit' =>$step_3_total,'nominal_debit'=>0]);
            }
            
        }
        $step_3->akun()->attach($iktiar_id ,['no_urut' =>1 ,'nominal_kredit' => 0,'nominal_debit'=>$step_3_total]);


        
        
    }

    public static function penutupan_create_new_akun($id_periode_lama, $id_periode_baru){
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar($id_periode_lama);
        $akuns = AkunAkuntansi::where('periode_id',$id_periode_lama)->get();
        
        foreach ($akuns as $akun) {
            foreach($buku_besar as $bukubesar){
                if($akun->no_akun ==$bukubesar['no_akun'] ){
                    // New Akun
                    $new_akun = new AkunAkuntansi();
                    $new_akun->no_akun = $akun->no_akun;
                    $new_akun->nama = $akun->nama;
                    $new_akun->jenis_akun = $akun->jenis_akun;
                    $new_akun->saldo_awal = $bukubesar['saldo_setelah_closing'];
                    $new_akun->periode_id = $id_periode_baru;
                    $new_akun->save();
                }
              
            }
        }
        
    }

}
