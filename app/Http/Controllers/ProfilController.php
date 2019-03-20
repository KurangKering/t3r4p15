<?php

namespace App\Http\Controllers;

use App\Klien;
use App\Terapis;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $role = $user->role;
        return view('profil.'.$role, compact('user'));

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
        //
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
        $user = \Auth::user();
        $role = $user->role;
        switch ($role) {
            case 'klien':
            return $this->update_klien($request, $id);
            break;
            case 'terapis':
            return $this->update_terapis($request, $id);
            break;
            case 'pimpinan':
            return $this->update_pimpinan($request, $id);
            break;
            default:
            break;
        }
        
    }
    public function update_pimpinan(Request $request, $id)
    {   

        $user = User::findOrFail($id);

        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'same:confirm-password',

        ]);

        $input_user = [
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),


        ];
        $password = $request->get('password');
        if(!empty($password)){ 
            $input_user['password'] = Hash::make($password);
        }

        $user = $user->update($input_user);

      
        return redirect(route('profil.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Profil']);

    }
    private function update_klien(Request $request, $id) 
    {
        $klien = Klien::findOrFail($id);

        $this->validate($request, [
            'nama_pengguna'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $klien->user->id,
            'password'      => 'same:confirm-password',

        ]);

        $input_user = [
            'name'     => $request->get('nama_pengguna'),
            'email'    => $request->get('email'),


        ];
        $password = $request->get('password');
        if(!empty($password)){ 
            $input_user['password'] = Hash::make($password);
        }

        $user = User::findOrFail($klien->user->id);
        $user = $user->update($input_user);

        if ($user) {
            $input_klien = [
                'nama_ayah'  => $request->get('nama_ayah'),
                'hp_ayah'    => $request->get('hp_ayah'),
                'email_ayah' => $request->get('email_ayah'),
                'nama_ibu'   => $request->get('nama_ibu'),
                'hp_ibu'     => $request->get('hp_ibu'),
                'email_ibu'  => $request->get('email_ibu'),
            ];

            $klien = $klien->update($input_klien);


        }

        return redirect(route('profil.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Profil']);
    }

    private function update_terapis(Request $request, $id) 
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

        return redirect(route('profil.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Profil']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
