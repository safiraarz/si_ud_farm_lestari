<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Customer;
use App\NotaPenjualan;
use App\Pengguna;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = NotaPenjualan::all();
        $user = User::all();
        $customer = Customer::all();
        $barang = Barang::all();
        return view('notapenjualan.index', ['data' => $queryBuilder,'user' => $user,'barang' => $barang,'customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $customer = Customer::all();
        $barang = Barang::all();
        $date_now = str_replace('-', '',Carbon::now()->toDateString());
        $sqlmaxnota = DB::select(DB::raw(" SELECT MAX(SUBSTRING(no_nota, -3))+1 AS PenjualanMaxTanggal FROM `nota_penjualan` WHERE `no_nota` LIKE '". $date_now ."%';"));
        $jualMax= 0;
        if($sqlmaxnota[0]->PenjualanMaxTanggal == null){
            $jualMax=1;
        }
        else{
            $jualMax = $sqlmaxnota[0]->PenjualanMaxTanggal;
        }
        $no_nota_generator = $date_now.'-'.'01'.'-'.'03'.'-'.str_pad($jualMax, 3, "0", STR_PAD_LEFT);
        return view('notapenjualan.create', ['date_now'=>Carbon::now()->toDateString(),'no_nota_generator'=>$no_nota_generator,'customer' => $customer,'user' => $user,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new NotaPenjualan();
        $data->no_nota = $request->get('no_nota');
        $data->	tanggal_pembuatan_nota = $request->get('tanggal_pembuatan_nota');
        $data->total_harga = $request->get('total_harga');
        $data->	status = $request->get('status');

        $customer = Customer::find($request->get('cus$customer'));
        $barang = Barang::find($request->get('barang'));

        $customer->notapenjualan()->save($data);
        $barang->notapenjualan()->save($data);
        foreach($request->get("barang") as $details) 
        {   
            $data->barang()->attach($details['id_barang'],['kuantitas' =>$details['kuantitas'],'harga' =>$details['harga_barang']]);
        }
        return redirect()->route('notapenjualan.index')->with('status', 'Berhasil menambahkan nota' . $request->get('no_nota'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPenjualan $notaPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPenjualan $notaPenjualan)
    {
        return view('notapenjualan.edit', ['notapenjualan' => NotaPenjualan::find($notaPenjualan), 'customer' => Customer::All(),'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPenjualan $notaPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPenjualan  $notaPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPenjualan $notaPenjualan)
    {
        //
    }
    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = NotaPenjualan::find($id);
        $customer = Customer::all();
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('notapenjualan.getEditForm', compact('data', 'customer','barang'))->render()
        ), 200);
    }
}
