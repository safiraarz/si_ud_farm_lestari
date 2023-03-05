<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\SPK;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SPKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('check_spk_lpb');

        $queryBuilder = SPK::all();
        $user = User::all();
        $barang = Barang::all();
        $flok = Flok::all();
        return view('spk.index', ['data' => $queryBuilder, 'barang' => $barang, 'flok' => $flok, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $barang = Barang::all();
        $flok = Flok::all();
        $date_now = str_replace('-', '', Carbon::now()->toDateString());
        $sqlmaxsurat = DB::connection('inventory')->select(DB::raw(" SELECT MAX(SUBSTRING(no_surat, -3))+1 AS SPKMaxTanggal FROM `surat_perintah_kerja` WHERE `no_surat` LIKE '" . $date_now . "%';"));
        $noSuratMax = 0;
        if ($sqlmaxsurat[0]->SPKMaxTanggal == null) {
            $noSuratMax = 1;
        } else {
            $noSuratMax = $sqlmaxsurat[0]->SPKMaxTanggal;
        }
        $no_surat_generator = $date_now . '-' . '02' . '-' . '01' . '-' . str_pad($noSuratMax, 3, "0", STR_PAD_LEFT);
        return view('spk.create', ['date_now' => Carbon::now()->toDateString(), 'no_surat_generator' => $no_surat_generator, 'user' => $user, 'barang' => $barang,'flok' => $flok]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($request->get("barang"));
        if($request->get("barang") != null) {
            $data = new SPK();
            $data->no_surat = $request->get('no_surat');
            $data->tgl_pembuatan_surat = $request->get('tgl_pembuatan_surat');
            $data->keterangan = $request->get('keterangan_input');
            $data->pengguna_id = $user->id;
    
            // dd($request->get('barang'));
            // $barang = Barang::find($request->get('barang'));
            $data->save();
            foreach ($request->get("barang") as $details) {
                $data->daftar_barang()->attach($details['id_barang'], [
                    'tgl_mulai_produksi' => $details['tanggal_mulai'],
                    'tgl_selesai_produksi' => $details['tanggal_akhir'],
                    'kuantitas' => $details['kuantitas']
                ]);
            }
            return redirect()->route('spk.index')->with('status', 'Berhasil menambahkan surat ' . $request->get('no_surat'));
        }
        else{
            return redirect()->route('spk.create')->with('error', 'Gagal menambahkan surat');

        }
       
        // $barang->spk()->save($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function show(SPK $sPK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function edit(SPK $sPK)
    {
        return view('spk.edit', ['spk' => SPK::find($sPK), 'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SPK $sPK)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SPK  $sPK
     * @return \Illuminate\Http\Response
     */
    public function destroy(SPK $sPK)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = SPK::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('spk.getEditForm', compact('data', 'barang'))->render()
        ), 200);
    }
}
