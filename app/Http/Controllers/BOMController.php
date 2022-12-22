<?php

namespace App\Http\Controllers;

use App\BOM;
use Illuminate\Http\Request;

class BOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = BOM::all();
        return view('bom.index', ['data' => $queryBuilder]);
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
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function show(BOM $bOM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function edit(BOM $bOM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BOM $bOM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BOM  $bOM
     * @return \Illuminate\Http\Response
     */
    public function destroy(BOM $bOM)
    {
        //
    }
}
