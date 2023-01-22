<?php

namespace App\Http\Controllers;

use App\Barang;
use App\LPB;
use App\User;
use Illuminate\Http\Request;

class LPBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = LPB::all();
        $barang = Barang::all();
        $user = User::all();
        return view('lpb.index', ['data' => $queryBuilder, 'barang' => $barang,'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function show(LPB $lPB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function edit(LPB $lPB)
    {
        return view('lpb.edit', ['lpb' => LPB::find($lPB), 'barang' => Barang::All()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LPB $lPB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LPB  $lPB
     * @return \Illuminate\Http\Response
     */
    public function destroy(LPB $lPB)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = LPB::find($id);
        $barang = Barang::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('lpb.getEditForm', compact('data','barang'))->render()
        ), 200);
    }
}
