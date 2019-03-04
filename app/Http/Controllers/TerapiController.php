<?php

namespace App\Http\Controllers;

use App\Terapi;
use Illuminate\Http\Request;

class TerapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_terapi = Terapi::latest()->get();
        return view('terapi.index', compact('data_terapi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('terapi.create');
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
            'jenis' => 'required|unique:terapi,jenis',

        ]);

        $terapi = new Terapi();
        $terapi->jenis = $request->get('jenis');
        $terapi->save();

        return redirect(route('terapi.index'))->with(['success' => true, 'msg' => 'Berhasil Menambah Data Terapi']);
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
        $terapi = Terapi::findOrFail($id);
        return view('terapi.edit', compact('terapi'));
        
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
            'jenis' => 'required|unique:terapi,jenis,'. $id,

        ]);

        $terapi = Terapi::findOrFail($id);
        $terapi->jenis = $request->get('jenis');
        $terapi->save();

        return redirect(route('terapi.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Data Terapi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terapi = Terapi::findOrFail($id);
        $terapi->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Terapi']);
    }
}
