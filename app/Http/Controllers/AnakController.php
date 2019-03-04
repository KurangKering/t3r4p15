<?php

namespace App\Http\Controllers;

use App\Anak;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_anak = Anak::latest()->get();
        return view('anak.index', compact('data_anak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',

        ]);


        $input_user = [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
            'role'      => 'anak',

        ];
        $user = User::create($input_user);

        if ($user) {
            $input_anak = [
                'tempat_lahir'  => $request->get('tempat_lahir'),
                'tanggal_lahir' => $request->get('tanggal_lahir'),
                'alamat'        => $request->get('alamat'),
                'no_hp'         => $request->get('no_hp'),
                'user_id'       => $user->id,
            ];

            $anak = Anak::create($input_anak);
        }



        return redirect(route('anak.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Anak']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anak = Anak::findOrFail($id);
        return view('anak.edit', compact('anak'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke'       => 'required',

        ]);

        $input_anak = [
            'nama'  => $request->get('nama'),
            'tempat_lahir'  => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'anak_ke'        => $request->get('anak_ke'),
        ];
        $anak = Anak::findOrFail($id);
        $anak->update($input_anak);

        return redirect(route('anak.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Anak']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anak = Anak::findOrFail($id);
        $anak->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Anak']);
    }
}
