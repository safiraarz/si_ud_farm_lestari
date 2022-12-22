<?php

namespace App\Http\Controllers;

use App\Customer;
use App\NotaPenjualan;
use App\Pengguna;

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
        return view('notapenjualan.index', ['data' => $queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::all();
        $pengguna = Pengguna::all();
        return view('notapenjualan.create', ['customer' => $customer],['pengguna' => $pengguna]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
}
