<?php

namespace App\Http\Controllers;

use App\Anak;
use App\Terapi;
use App\TerapiAnak;
use App\Terapis;
use Illuminate\Http\Request;

class TerapiAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_terapi_anak = TerapiAnak::latest()->get();
        return view('terapi_anak.index', compact('data_terapi_anak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_anak    = Anak::pluck('nama', 'id')->all();
        $jenis_terapi = Terapi::pluck('jenis', 'id')->all();
        $terapis = Terapis::latest()->get();
        $terapis = $terapis->pluck('user.name', 'id')->all();
        return view('terapi_anak.create', compact('jenis_terapi', 'data_anak', 'terapis'));
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
            'anak_id'   => 'required',
            'terapi_id' => 'required',
            'terapis_id' => 'required',

        ]);

        $input_terapi_anak = [
            'anak_id'   => $request->get('anak_id'),
            'terapi_id' => $request->get('terapi_id'),
            'terapis_id' => $request->get('terapis_id'),
            'status'    => 'N',

        ];



        $terapi_anak        = TerapiAnak::create($input_terapi_anak);

        return redirect(route('terapi_anak.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data TerapiAnak']);
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
        $data_anak    = Anak::pluck('nama', 'id')->all();
        $jenis_terapi = Terapi::pluck('jenis', 'id')->all();
        $terapis = Terapis::latest()->get();
        $terapis = $terapis->pluck('user.name', 'id')->all();
        $terapi_anak = TerapiAnak::findOrFail($id);
        return view('terapi_anak.edit', compact('terapi_anak', 'jenis_terapi', 'data_anak', 'terapis'));

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
            'anak_id'   => 'required',
            'terapi_id' => 'required',
            'terapis_id' => 'required',

        ]);

        $input_terapi_anak = [
            'anak_id'   => $request->get('anak_id'),
            'terapi_id' => $request->get('terapi_id'),
            'terapis_id' => $request->get('terapis_id'),
            'status'    => $request->get('status'),

        ];


        $terapi_anak        = TerapiAnak::findOrFail($id);
        $terapi_anak->update($input_terapi_anak);

        return redirect(route('terapi_anak.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data TerapiAnak']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terapi_anak = TerapiAnak::findOrFail($id);
        $terapi_anak->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data TerapiAnak']);
    }
}
