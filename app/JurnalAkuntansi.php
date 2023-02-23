<?php

namespace App;

use App\AkunAkuntansi;
use App\JurnalAkuntansi;
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
        return $this->belongsToMany('App\AkunAkuntansi','jurnal_has_akun','jurnal_id','akun_no_akun')->withPivot('no_urut','nominal_debit','nominal_kredit')->orderBy('no_urut', 'asc');;
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

    public function bukubesar(){
        $buku_besar2 = [];
        $buku_besar = new JurnalAkuntansi();
        $akuns = AkunAkuntansi::all();
        $jurnals = JurnalAkuntansi::all();
        // $jurnals_detail =  DB::select(DB::raw("SELECT * FROM `jurnal_has_akun`"));
        foreach ($akuns as $akun) {
            $tumpung['saldo_awal_kredit'] = 0;
            $tumpung['saldo_awal_debet'] = 0;
           
        // $buku_besar->jenis_saldo("");
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
                                'tanggal' => $jurnal->tanggal_transaksi,
                                'no_bukti' => $jurnal->no_bukti,
                                'no_ref' => $no_reff,
                                'selisih'=>$jenis_saldo,
                                'keterangan' => $jurnal->transaksi->keterangan,
                                'debit'=> $jurnalakun->pivot->nominal_debit,
                                'kredit'=> $jurnalakun->pivot->nominal_kredit,
                                'saldo_debit' => ( $jenis_saldo == "debet" ) ? abs($jurnal_penutup) : 0,
                                'saldo_kredit' => ( $jenis_saldo == "kredit" ) ? abs($jurnal_penutup): 0,
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
    public function labarugi(){
        // $buku_besar = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar();
        $laba_rugi['pendapatan'] = [];
        $laba_rugi['biaya'] = [];
        $akuns = AkunAkuntansi::all();
        $total_pendapatan = 0;
        $total_biaya = 0;
        foreach ($buku_besar as $value) {
            if($value['jenis_akun']== "pendapatan"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::find($no_akun);
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
                $akun = AkunAkuntansi::find($no_akun);
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

    public static function perubahanekuitas(){
        // $perubahan_ekuitas = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar();
        $laba_rugi = $newjurnal->labarugi();
        $modal = 0;
        $prive = 0 ;
        $total= 0;
        $perubahan_ekuitas = [];
        $perubahan_ekuitas['list'] = [];

        foreach ($buku_besar as $value) {
            if($value['jenis_akun']== "ekuitas"){
                $no_akun = $value['no_akun'];
                $akun = AkunAkuntansi::find($no_akun);
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
            'nama_akun'=> "Ikhtiar Laba Rugi",
            'saldo' => $laba_rugi['laba_rugi']
        ];
        array_push( $perubahan_ekuitas['list'], $pendapatan);
        $perubahan_ekuitas['total'] = $total + $laba_rugi['laba_rugi'];
        return $perubahan_ekuitas;
    }


    public static function neraca(){
        // $perubahan_ekuitas = [];
        $newjurnal = new JurnalAkuntansi();
        $buku_besar = $newjurnal->bukubesar();
        $perubahanekuitas = $newjurnal->perubahanekuitas();
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
                $akun = AkunAkuntansi::find($no_akun);
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
                $akun = AkunAkuntansi::find($no_akun);
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
                $akun = AkunAkuntansi::find($no_akun);
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

}
