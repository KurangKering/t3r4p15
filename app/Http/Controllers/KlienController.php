<?php

namespace App\Http\Controllers;

use App\Anak;
use App\Klien;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KlienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_klien = Klien::latest()->get();
        return view('klien.index', compact('data_klien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klien.create');
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
            'nama_pengguna'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|same:confirm-password',
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke'       => 'required',

        ]);

        $input_user = [
            'name'     => $request->get('nama_pengguna'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role'     => 'klien',

        ];
        $user = User::create($input_user);

        if ($user) {
            $input_klien = [
                'nama_ayah'  => $request->get('nama_ayah'),
                'hp_ayah'    => $request->get('hp_ayah'),
                'email_ayah' => $request->get('email_ayah'),
                'nama_ibu'   => $request->get('nama_ibu'),
                'hp_ibu'     => $request->get('hp_ibu'),
                'email_ibu'  => $request->get('email_ibu'),
                'user_id'    => $user->id,
            ];

            $klien = Klien::create($input_klien);
            if ($klien) {
                $input_anak = [
                    'nama'          => $request->get('nama'),
                    'tempat_lahir'  => $request->get('tempat_lahir'),
                    'tanggal_lahir' => $request->get('tanggal_lahir'),
                    'anak_ke'       => $request->get('anak_ke'),
                    'klien_id'      => $klien->id,
                ];

                $anak = Anak::create($input_anak);

                if (!$anak) {
                    $klien->delete();
                    $user->delete();
                }
            } else {
                $user->delete();
            }

        }

        return redirect(route('klien.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Klien']);
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
        $klien = Klien::findOrFail($id);
        return view('klien.edit', compact('klien'));

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

        $klien = Klien::findOrFail($id);

        $this->validate($request, [
            'nama_pengguna'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $klien->user->id,
            'password'      => 'same:confirm-password',

        ]);

        $input_user = [
            'name'     => $request->get('nama_pengguna'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),

        ];
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

        return redirect(route('klien.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Klien']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klien = Klien::findOrFail($id);
        $klien->user->delete();

        $klien->anak->each(function($anak) {
            $anak->delete();
        });
        
        $klien->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Klien']);
    }
}
