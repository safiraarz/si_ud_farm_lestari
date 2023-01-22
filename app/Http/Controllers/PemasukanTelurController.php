<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Flok;
use App\PemasukanTelur;
use App\Pengguna;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($queryBuilder);

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
        return view('pemasukantelur.create', ['barang' => $barang, 'user' => $user,'flok' => $flok]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new PemasukanTelur();
        $data->kuantitas = $request->get('kuantitas');
        $data->	tanggal_pencatatan = $request->get('tanggal_pencatatan');;

        $flok = Flok::find($request->get('flok'));
        $barang = Barang::find($request->get('barang'));

        $flok->notapemesanan()->save($data);
        $barang->notapemesanan()->save($data);

        return redirect()->route('notapemesanan.index')->with('status', 'Berhasil menambahkan pencatatan');
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
    public function update(Request $request, PemasukanTelur $pemasukanTelur)
    {
        //
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
        $data = PemasukanTelur::find();
        $barang = Barang::all();
        $flok = Flok::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('pemasukantelur.getEditForm', compact('data', 'flok','barang'))->render()
        ), 200);
    }
}
