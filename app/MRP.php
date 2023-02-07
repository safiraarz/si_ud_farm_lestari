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
    public function mrp(){
        return $this->belongsTo('App\Barang','barang_id');
    }

    public function perhitungan($idmps)
    {
        $mps = [];
        // $queryMPS = MPS::find(11202);
        $queryMPS = MPS::find($idmps);
        $bahan_jadi = $queryMPS->barang->nama;
        $mps[] = $bahan_jadi;
        $tgl_mulai_produksi = $queryMPS->tgl_mulai_produksi;
        $tgl_selesai_produksi = $queryMPS->tgl_selesai_produksi;
        $kuantitas_barang_jadi = $queryMPS->kuantitas_barang_jadi;
        // dd($tgl_mulai_produksi,$tgl_selesai_produksi);
        $total_produksi = $kuantitas_barang_jadi;

        $periods = $this->getDatesFromRange($tgl_mulai_produksi,$tgl_selesai_produksi);

        foreach ($periods as $period) {
            if($kuantitas_barang_jadi >= 3200){
                $mps[1][] = [$period , 3200];
                $kuantitas_barang_jadi = $kuantitas_barang_jadi - 3200;
            }else{
                $mps[1][] = [$period, $kuantitas_barang_jadi];
                $kuantitas_barang_jadi = $kuantitas_barang_jadi - $kuantitas_barang_jadi;
            }
        }

        // $mps = [
        //     'Pakan Super' , [
        //         ['21/12', 3120],
        //         ['22/12', 2987],
        //         ['23/12', 3189],
        //         ['24/12', 2998],
        //         ['25/12', 3176],
        //         ['26/12', 3018],
        //         ['27/12', 2886],
        //         ['28/12', 2790],
        //         ['29/12', 3170],
        //         ['30/12', 3195],
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
        
        $jumlah_periode = count($mps[1]);

        $lfl= [];
        $penampung_perhitungan = [];
        foreach ($bom as $bahan ) {         
            $perhitungan = [];//membuat array setiap bahan
            
            $counter = 0;//counter
            foreach ($mps[1] as $qty) {
                $perhitungan['GR'][] = ($qty[1] / $kuantitas_barang_jadi_bom) * $bahan['kuantitas'];
                $perhitungan['SR'][] = 0;

                if ($counter == 0) {
                    $total = $bahan['ohi'] - $perhitungan['GR'][$counter];
                    if($total> 0){
                        $perhitungan['OHI'][] = $total;
                    }else{
                        $perhitungan['OHI'][] = 0;
                    }
                }else{
                    $total = $perhitungan['OHI'][$counter-1] - $perhitungan['GR'][$counter];
                    if($total> 0){
                        $perhitungan['OHI'][] = $total;
                    }else{
                        $perhitungan['OHI'][] = 0;
                    }
                }

                if ($counter == 0) {//ambil dari ohi
                    $total = $perhitungan['GR'][$counter] - $perhitungan['SR'][$counter] - $bahan['ohi'];
                    if($total> 0){
                        $perhitungan['NR'][] = $total;
                    }else{
                        $perhitungan['NR'][] = 0;
                    }
                }else{
                    $total = $perhitungan['GR'][$counter] - $perhitungan['SR'][$counter] - $perhitungan['OHI'][$counter - 1];
                    if($total> 0){
                        $perhitungan['NR'][] = $total;
                    }else{
                        $perhitungan['NR'][] = 0;
                    }
                }

                $perhitungan['POR'][] = $perhitungan['NR'][$counter];
                $counter++;
            }
            $penampung_perhitungan[] = $perhitungan;
            
        }
        // dd($penampung_perhitungan);

        $counter = 0;
        foreach ($bom as $bahan) {
            for ($i=0; $i < $jumlah_periode; $i++) { 
                if(isset($penampung_perhitungan[$counter]['POR'][$i+$bahan['leadtime']] ))
                    $penampung_perhitungan[$counter]['PORel'][] = $penampung_perhitungan[$counter]['POR'][$i+$bahan['leadtime']];
                else
                    $penampung_perhitungan[$counter]['PORel'][] = 0;
            }
            $lfl[] = [
                'nama bahan baku'=>$bahan['nama'],
                'kebutuhan bahan baku per produksi' => $bahan['kuantitas'], 
                'leadtime'=> $bahan['leadtime'],
                'perhitungan' => $penampung_perhitungan[$counter]
            ];
            $perhitungan['PORel'] = [];
            $counter++;
        }

        //membuat array setiap bahan

        // dd($mps,$bom,$lfl);
        return [$lfl, $total_produksi, $bahan_jadi,$periods];
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
