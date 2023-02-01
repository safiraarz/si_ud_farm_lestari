<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\PemasukanTelur;
use App\Pengguna;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemasukanTelurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = PemasukanTelur::all();
        $barang = Barang::all();
        $flok = Flok::all();
        $user = User::all();
        // foreach ($queryBuilder as $data){
        //     dd($data->barang);

        // }

        return view('pemasukantelur.index', ['data' => $queryBuilder,'barang'=>$barang,'flok'=>$flok, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $user = User::all();
        $flok = Flok::all();
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        return view('pemasukantelur.create', ['date_now'=>Carbon::now()->toDateString(),'barang' => $barang, 'user' => $user,'flok' => $flok]);
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
        // dd($user->id);
        // dd($request->get('total_kuantitas'));
        $data = new PemasukanTelur();
        $data->karantina = $request->get('karantina');
        $data->afkir = $request->get('afkir');
        $data->kematian = $request->get('kematian');
        $data->keterangan = $request->get('keterangan');
        $data->pengguna_id= $user->id;
        $data->flok_id= $request->get('flok');
        $data->tgl_pencatatan = Carbon::now()->toDateString();
        // dd($request->get('tanggal_pencatatan'));
        // dd($request->get('telur'));
        $data->save();

        // $barang = Barang::find($request->get('barang'));
        foreach($request->get("telur") as $details) 
        {
            $data->daftar_barang()->attach($details['id_telur'],[
                'kuantitas_bersih' =>$details['kuantitas_bersih'],
                'kuantitas_reject' =>$details['kuantitas_reject'],
                'total_kuantitas' =>$details['kuantitas_total']
            ]);
        }
        // $barang->pemasukantelur()->save($data);
        return redirect()->route('pemasukantelur.index')->with('status', 'Berhasil menambah pencatatan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanTelur $pemasukanTelur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function edit(PemasukanTelur $pemasukanTelur)
    {
        return view('pemasukantelur.edit', ['pemasukantelur' => PemasukanTelur::find($pemasukanTelur),'barang' => Barang::All(), 'flok' => Flok::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $pemasukanTelur)
    {
        //
        DB::table('pemasukan_telur')
            ->where('created_at', $pemasukanTelur)
            ->update([
                'barang_id' => $request->get('barang_id'),
                'flok_id' =>$request->get('flok_id'),
                'kuantitas_bersih' => $request->get('kuantitas_bersih'),
                'kuantitas_reject' => $request->get('kuantitas_reject'),
                'total_kuantitas' => $request->get('total_kuantitas'),
                'tgl_pencatatan' => $request->get('tanggal_pencatatan'),
                'keterangan' => $request->get('keterangan')
            ]);

        return redirect()->route('pemasukantelur.index')->with('status', 'Berhasil mengubah pencatatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemasukanTelur  $pemasukanTelur
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemasukanTelur $pemasukanTelur)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        // $data = PemasukanTelur::where('created_at',$request->get('id'))->first();
        // // dd($data);

        // $barang = Barang::all();
        // $flok = Flok::all();
        // return response()->json(array(
        //     'status' => 'oke',
        //     'msg' => view('pemasukantelur.getEditForm', compact('data', 'flok','barang'))->render()
        // ), 200);

        $id = $request->get('id');
        $data = PemasukanTelur::find($id);
        $barang = Barang::all();
        $flok = Flok::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('pemasukantelur.getEditForm', compact('data', 'barang'))->render()
        ), 200);
    }
}
