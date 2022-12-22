<?php

namespace App\Http\Controllers;

use App\LPB;
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
        return view('lpb.index', ['data' => $queryBuilder]);
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
        //
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
}
