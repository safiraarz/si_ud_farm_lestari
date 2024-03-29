<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('checkjabatanpengguna');
        $data = User::all();
        $jabatans = Jabatan::all();
        return view('user.index', compact('data','jabatans'));
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
        $this->validator($request->all())->validate();
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan_id'=> $request->jabatan_id,
        ]);

        return redirect()->back()->with('status','Pengguna '. $request->nama.' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    private function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $Pengguna = User::find($id);
            $Pengguna->delete();
            return response()->json(array(
                'status' => 'ok',
                'msg' => 'Pengguna berhasil dihapus'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status ' => ' error',
                'msg' => 'Pengguna tidak bisa dihapus. Pengguna diperlukan untuk data lain'
            ), 200);
        }
    }
}
