<?php

namespace App;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class MRP extends Model
{
    protected $connection = 'inventory';

    protected $table = "mrp";
    public $timestamps = false;
    public function dmrp(){
        return $this->hasMany('App\d_MRP','MRP_id','id');
    }

    public function mps()
    {
        return $this->belongsTo('App\MPS','MPS_id','id');
    }

    public function bom()
    {
        return $this->belongsTo('App\BOM','BOM_id','id');
    }

    public function perhitungan($idmps)
    {
        $mps = [];
        // $queryMPS = MPS::find(11202);
        $queryMPS = MPS::find($idmps);
        $bahan_jadi = $queryMPS->barang->nama;
        $satuan_bahan_jadi = $queryMPS->barang->satuan;
        $mps[] = $bahan_jadi;
        $tgl_mulai_produksi = $queryMPS->tgl_mulai_produksi->format('Y-m-d');
        $tgl_selesai_produksi = $queryMPS->tgl_selesai_produksi->format('Y-m-d');
        $kuantitas_barang_jadi = $queryMPS->kuantitas_barang_jadi;
        $total_produksi = $kuantitas_barang_jadi;
        // dd($queryMPS);
        
        // dd($tgl_mulai_produksi);
        $periods = $this->getDatesFromRange($tgl_mulai_produksi,$tgl_selesai_produksi);
        
        //Menghitung maksimal produksi dalam sehari
        foreach ($periods as $period) {
            if($kuantitas_barang_jadi >= 3200){ //jika kuanti barang di atas 3.200
                $mps[1][] = 3200;
                $kuantitas_barang_jadi = $kuantitas_barang_jadi - 3200; //barang akan dikurangi 3.200 yg sisanya dihitung pada kemudian hari
            }else{ //jika kuanti barang di bawah 3.200
                $mps[1][] = $kuantitas_barang_jadi;
                $kuantitas_barang_jadi = $kuantitas_barang_jadi - $kuantitas_barang_jadi; //dikurangi kuantitas barang itu sendiri agar tersisa 0
            }
        }

        // dd($mps);
        // $mps = [
        //     'Pakan Super' , [
        //         3120,
        //         2987,
        //         3189,
        //         2998,
        //         3176,
        //         3018,
        //         2886,
        //         2790,
        //         3170,
        //         3195,
        //     ]
        //     ];

        // dd($mps);
        // ambil barang di detail bom
        $bom = [];
        $barang_id = $queryMPS->barang_id;
        $queryDBOM = d_BOM::where('barang_id',$barang_id)->first();
        $bom_id = $queryDBOM->BOM_id;
        $queryBOM = BOM::find($bom_id);
        $kuantitas_barang_jadi_bom = $queryBOM->kuantitas_barang_jadi;
        // dd($kuantitas_barang_jadi_bom);
        // dd($queryBOM->barang);
        foreach ($queryBOM->barang as $item) {
            if ($item->jenis != "Barang Jadi") {
                $bom[] = [
                    'id'=>$item->id,
                    'nama'=>$item->nama,
                    'kuantitas'=>$item->pivot->kuantitas_bahan_baku,
                    'satuan'=>$item->satuan,
                    'ohi'=>$item->kuantitas_stok_ready,
                    'leadtime'=>$item->lead_time
                ];
            }
        }

        // dd($mps);
        // $bom = [
        //     ['nama'=>'K 36 SPR','kuantitas'=> 150,'satuan'=> 'KG','ohi'=>2300,'leadtime'=>2],
        //     ['nama'=>'Jagung A','kuantitas'=>214,'satuan'=> 'KG','ohi'=>5000,'leadtime'=>2],
        //     ['nama'=>'Katul','kuantitas'=>64,'satuan'=> 'KG','ohi'=>3000,'leadtime'=>2],
        //     ['nama'=>'Premix(Metabolizer)','kuantitas'=>0.8,'satuan'=> 'KG','ohi'=>10,'leadtime'=>2],
        //     ['nama'=>'Ciromecyne10%','kuantitas'=>0.022,'satuan'=> 'KG','ohi'=>10,'leadtime'=>2],
        // ];
        
        // $jumlah_periode = count($mps[1]);
        $mrp = new MRP();
        $mrp->MPS_ID = $idmps;
        $mrp->BOM_ID = $bom_id;
        $mrp->save();
        $idmrp = $mrp->id;
        $lfl= [];
        $penampung_perhitungan = [];
        foreach ($bom as $bahan) {
            // mencari tgl leadtime
            $leadtime = $bahan['leadtime'];
            $timestamp_mulai_produksi = strtotime($tgl_mulai_produksi);
            $lead_day_produksi = date('Y-m-d', strtotime("-$leadtime day", $timestamp_mulai_produksi));
            $range_produksi = $this->getDatesFromRange($lead_day_produksi,$tgl_selesai_produksi,'Y-m-d');
            // dd($range_produksi);
            $perhitungan = [];
            $counter = 0;
            foreach ($range_produksi as $tanggal) {
                if ($tanggal < $tgl_mulai_produksi) {
                    $perhitungan['GR'][] = 0;
                    $perhitungan['SR'][] = 0;
                    $perhitungan['OHI'][] = 0;
                    $perhitungan['NR'][] = 0;
                    $perhitungan['POR'][] = 0;
                }else{
                    // menghitung Gr
                    $kuantitas_produksi = $mps[1][$counter];
                    $kuantitas_bahan_baku = $bahan['kuantitas'];
                    $gr = ($kuantitas_produksi / $kuantitas_barang_jadi_bom) * $kuantitas_bahan_baku;
                    $perhitungan['GR'][] = $gr;
                    
                    // menghitung sr
                    $perhitungan['SR'][] = 0;

                    // menghitung OHI
                    if ($counter == 0) {
                        $total = $bahan['ohi'] - $perhitungan['GR'][$counter + $leadtime];
                        if($total> 0){
                            $perhitungan['OHI'][] = $total;
                        }else{
                            $total = 0;
                            $perhitungan['OHI'][] = $total;
                        }
                    }else{
                        $total = $perhitungan['OHI'][$counter + $leadtime -1] - $perhitungan['GR'][$counter + $leadtime];
                        if($total> 0){
                            $perhitungan['OHI'][] = $total;
                        }else{
                            $total = 0;
                            $perhitungan['OHI'][] = $total;
                        }
                    }
                    // $barang = Barang::find($bahan['id']);
                    // $barang->kuantitas_stok_ready = $total;
                    // $barang->save();
                    // $barang = new Barang();
                    // $barang->updateTotalStok($bahan['id']);

                    // menghitung nr
                    if ($counter == 0) {//ambil dari ohi
                        $total = $perhitungan['GR'][$counter + $leadtime] - $perhitungan['SR'][$counter + $leadtime] - $bahan['ohi'];
                        if($total> 0){
                            $perhitungan['NR'][] = $total;
                        }else{
                            $perhitungan['NR'][] = 0;
                        }
                    }else{
                        $total = $perhitungan['GR'][$counter + $leadtime] - $perhitungan['SR'][$counter + $leadtime] - $perhitungan['OHI'][$counter + $leadtime - 1];
                        if($total> 0){
                            $perhitungan['NR'][] = $total;
                        }else{
                            $perhitungan['NR'][] = 0;
                        }
                    }

                    // menghitung por
                    $perhitungan['POR'][] = $perhitungan['NR'][$counter + $leadtime];

                    $counter++;
                }
            }
            // dd($perhitungan);
            $penampung_perhitungan[] = $perhitungan;
        }

        $counter = 0;
        foreach ($bom as $bahan) {
            $leadtime = $bahan['leadtime'];
            $timestamp_mulai_produksi = strtotime($tgl_mulai_produksi);
            $lead_day_produksi = date('Y-m-d', strtotime("-$leadtime day", $timestamp_mulai_produksi));
            $range_produksi = $this->getDatesFromRange($lead_day_produksi,$tgl_selesai_produksi,'Y-m-d');

            $i = 0;
            foreach ($range_produksi as $tanggal) {
                if(isset($penampung_perhitungan[$counter]['POR'][$i+$leadtime] ))
                    $penampung_perhitungan[$counter]['PORel'][] = $penampung_perhitungan[$counter]['POR'][$i+$bahan['leadtime']];
                else
                    $penampung_perhitungan[$counter]['PORel'][] = 0;
                $i++;
            }
            $lfl[] = [
                'id_bahan_baku' =>$bahan['id'],
                'nama bahan baku'=>$bahan['nama'],
                'kebutuhan bahan baku per produksi' => $bahan['kuantitas'], 
                'satuan' => $bahan['satuan'],
                'leadtime'=> $bahan['leadtime'],
                'range_produksi' => $range_produksi,
                'perhitungan' => $penampung_perhitungan[$counter]
            ];
            $counter++;
        }
        // dd($penampung_perhitungan);
        // dd($mps,$bom,$lfl);
        // dd($idmps, $bom_id);
        // dd($lfl);
        foreach ($lfl as $bahan) {
            for ($i=0; $i < count($bahan['range_produksi']); $i++) { 
                $dMRP = new d_MRP();
                $dMRP->periode = $bahan['range_produksi'][$i];
                $dMRP->GR = $bahan['perhitungan']['GR'][$i];
                $dMRP->SR = $bahan['perhitungan']['SR'][$i];
                $dMRP->OHI = $bahan['perhitungan']['OHI'][$i];
                $dMRP->NR = $bahan['perhitungan']['NR'][$i];
                $dMRP->POR = $bahan['perhitungan']['POR'][$i];
                $dMRP->PORel = $bahan['perhitungan']['PORel'][$i];
                $dMRP->barang_id = $bahan['id_bahan_baku'];
                $dMRP->MRP_id = $idmrp;
                $dMRP->save();
            }
        }
        $queryMPS->status = 'proses produksi';
        $queryMPS->save();
        return [$lfl, $total_produksi, $bahan_jadi, $satuan_bahan_jadi];
    }

    private function getDatesFromRange($start, $end, $format = 'd/m') {
        // Declare an empty array
        $array = [];

        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        // Use loop to store date into array
        foreach($period as $date) {                 
            $array[] = $date->format($format); 
        }

        // Return the array element
        return $array;
    }
}
