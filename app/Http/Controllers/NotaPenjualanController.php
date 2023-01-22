<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Customer;
use App\NotaPenjualan;
use App\Pengguna;
use App\User;
use Illuminate\Http\Request;

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
        return view('notapenjualan.create', ['customer' => $customer,'user' => $user,'barang' => $barang]);
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
