<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRP extends Model
{
    protected $table = "mrp";
    public function mrp(){
        return $this->belongsTo('App\Barang','barang_id');
    }

    public function perhitungan()
    {
        // ambil barang di detail bom
        $bom = [
            ['nama'=>'K 36 SPR','kuantitas'=> 150,'satuan'=> 'KG','ohi'=>2300,'leadtime'=>2],
            ['nama'=>'Jagung A','kuantitas'=>214,'satuan'=> 'KG','ohi'=>5000,'leadtime'=>2],
            ['nama'=>'Katul','kuantitas'=>64,'satuan'=> 'KG','ohi'=>3000,'leadtime'=>2],
            ['nama'=>'Premix(Metabolizer)','kuantitas'=>0.8,'satuan'=> 'KG','ohi'=>10,'leadtime'=>2],
            ['nama'=>'Ciromecyne10%','kuantitas'=>0.022,'satuan'=> 'KG','ohi'=>10,'leadtime'=>2],
        ];
        // $ohi = [2300,5000,3000,10,10];
        $mps = [
            'Pakan Super' , [
                ['21', 3120],
                ['22', 2987],
                ['23', 3189],
                ['24', 2998],
                ['25', 3176],
                ['26', 3018],
                ['27', 2886],
                ['28', 2790],
                ['29', 3170],
                ['30', 3195],
            ]
            ];
        $jumlah_periode = count($mps[1]);

        $lfl= [];

        foreach ($bom as $bahan ) {
            $lfl[$bahan['nama']] = [];//membuat array setiap bahan
            
            $counter = 0;//counter
            foreach ($mps[1] as $qty) {
                $lfl[$bahan['nama']]['GR'][] = (int)round($qty[1] * $bahan['kuantitas'],0);
                $lfl[$bahan['nama']]['SR'][] = 0;
                $lfl[$bahan['nama']]['OHI'][] = 0;

                if ($counter == 0) {//ambil dari ohi
                    $lfl[$bahan['nama']]['NR'][] = $lfl[$bahan['nama']]['GR'][$counter] - $lfl[$bahan['nama']]['SR'][$counter] - $bahan['ohi'];
                }else{
                    $lfl[$bahan['nama']]['NR'][] = $lfl[$bahan['nama']]['GR'][$counter] - $lfl[$bahan['nama']]['SR'][$counter] - $lfl[$bahan['nama']]['OHI'][$counter - 1];
                }

                $lfl[$bahan['nama']]['POR'][] = $lfl[$bahan['nama']]['NR'][$counter];

                $counter++;
            }
        }

        foreach ($bom as $bahan) {
            for ($i=0; $i < $jumlah_periode; $i++) { 
                if(isset($lfl[$bahan['nama']]['POR'][$i+$bahan['leadtime']] ))
                    $lfl[$bahan['nama']]['PORel'][] = $lfl[$bahan['nama']]['POR'][$i+$bahan['leadtime']];
                else
                    $lfl[$bahan['nama']]['PORel'][] = 0;
            }
        }
        dd($lfl);
        return $lfl;
    }
}
