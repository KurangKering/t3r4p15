<?php

namespace App\Http\Controllers;

use App\Terapis;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TerapisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_terapis = Terapis::latest()->get();
        return view('terapis.index', compact('data_terapis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('terapis.create');
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
            'role'      => 'terapis',

        ];
        $user = User::create($input_user);

        if ($user) {
            $input_terapis = [
                'tempat_lahir'  => $request->get('tempat_lahir'),
                'tanggal_lahir' => $request->get('tanggal_lahir'),
                'alamat'        => $request->get('alamat'),
                'no_hp'         => $request->get('no_hp'),
                'user_id'       => $user->id,
            ];

            $terapis = Terapis::create($input_terapis);
        }



        return redirect(route('terapis.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Terapis']);
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
        $terapis = Terapis::findOrFail($id);
        return view('terapis.edit', compact('terapis'));
        
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
        $terapis = Terapis::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $terapis->user->id,
            'password' => 'same:confirm-password',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',

        ]);

        $input_user = [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),

        ];

        if(!empty($request->get('password'))){ 
            $input_user['password'] = Hash::make($request->get('password'));
        }

        $user = User::findOrFail($terapis->user->id);
        $user_updated = $user->update($input_user);

        if ($user_updated) {
            $input_terapis = [
                'tempat_lahir'  => $request->get('tempat_lahir'),
                'tanggal_lahir' => $request->get('tanggal_lahir'),
                'alamat'        => $request->get('alamat'),
                'no_hp'         => $request->get('no_hp'),
            ];

            $terapis->update($input_terapis);
        }

        return redirect(route('terapis.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Terapis']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terapis = Terapis::findOrFail($id);
        $terapis->user->delete();
        $terapis->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Terapis']);
    }
}
