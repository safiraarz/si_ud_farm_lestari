<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Customer();
        $data->nama = $request->get('nama');
        $data->alamat = $request->get('alamat');
        $data->no_telepon = $request->get('no_telepon');
        $data->save();

        return redirect()->route('customer.index')->with('status', 'Customer berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        $customer = Customer::find($customer);
        $customer->alamat = $request->get('alamat');
        $customer->no_telepon = $request->get('no_telepon');
        $customer->save();
        return redirect()->route('customer.index')->with('status', 'Customer '.$customer->nama.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customer.index')->with('status', 'Berhasil menghapus customer');
        } catch (\Throwable $th) {
            $msg = "Gagal menghapus customer";
            return redirect()->route('customer.index')->with('status', 'Error ' . $msg);
        }
    }
    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Customer::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('customer.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $Customer = Customer::find($id);
        $Customer->nama = $request->get('nama');
        $Customer->alamat = $request->get('alamat');
        $Customer->no_telepon = $request->get('no_telepon');
        $Customer->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Customer berhasil diupdate'
            ),
            200
        );
    }
    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Customer = Customer::find($id);
            $Customer->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Customer berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Customer tidak bisa dihapus. Customer diperlukan untuk data lain'
            ), 200);
        }
    }
    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');

        $Customer = Customer::find($id);
        $Customer->$fnama = $value;
        $Customer->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Customer berhasil diupdate'
            ),
            200
        );
    }
}
