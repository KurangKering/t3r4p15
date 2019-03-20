<?php

namespace App\Http\Controllers;

use App\Anak;
use App\HasilEvaluasi;
use App\HasilTerapi;
use App\Klien;
use App\Terapi;
use App\TerapiAnak;
use App\Terapis;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    /**
     * Menampilkan hasil terapi anak
     * route('pimpinan.daftar_hasil_evaluasi')
     * ('pimpinan/daftar_hasil_evaluasi')
     * @return [type] [description]
     */
    public function daftar_hasil_evaluasi(Request $request)
    {

        $view = 'pimpinan.daftar_hasil_evaluasi';

        $terapi_anak_id = $request->query('terapi_anak_id');
        if ($terapi_anak_id) {
            $terapi_anak = TerapiAnak::findOrFail($terapi_anak_id);
          

            $hasil_evaluasi = HasilEvaluasi::where('terapi_anak_id', $terapi_anak_id)->get();

        } else {
            $hasil_evaluasi = HasilEvaluasi::get();
        }

        return view($view, compact('hasil_evaluasi'));

    }

    /**
     * Menampilkan hasil terapi anak
     * route('pimpinan.daftar_hasil_terapi')
     * ('pimpinan/daftar_hasil_terapi')
     * @return [type] [description]
     */
    public function daftar_hasil_terapi(Request $request)
    {
        $view           = 'pimpinan.daftar_hasil_terapi';
        $terapi_anak_id = $request->query('terapi_anak_id');
        if ($terapi_anak_id) {
            $terapi_anak  = TerapiAnak::findOrFail($terapi_anak_id);
            $hasil_terapi = HasilTerapi::where('terapi_anak_id', $terapi_anak_id)->get();

        } else {
            $hasil_terapi = HasilTerapi::get();
        }

        return view($view, compact('hasil_terapi'));
    }
    /**
     * Menampilkan daftar terapi anak
     * route('pimpinan.daftar_terapi_anak')
     * ('pimpinan/daftar_terapi_anak')
     * @return [type] [description]
     */
    public function daftar_terapi_anak()
    {
        $data_terapi_anak = TerapiAnak::get();
        return view('pimpinan.daftar_terapi_anak', compact('data_terapi_anak'));
    }

    /**
     * Menampilkan daftar terapis
     * route('pimpinan.daftar_terapis')
     * ('pimpinan/daftar_terapis')
     * @return [type] [description]
     */
    public function daftar_terapis()
    {
        $data_terapis = Terapis::get();
        return view('pimpinan.daftar_terapis', compact('data_terapis'));
    }

    /**
     * Menampilkan daftar terapi
     * route('pimpinan.daftar_terapi')
     * ('pimpinan/daftar_terapi')
     * @return [type] [description]
     */
    public function daftar_terapi()
    {
        $data_terapi = Terapi::get();
        return view('pimpinan.daftar_terapi', compact('data_terapi'));
    }

    /**
     * Menampilkan daftar anak
     * route('pimpinan.daftar_anak')
     * ('pimpinan/daftar_anak')
     * @return [type] [description]
     */
    public function daftar_anak()
    {
        $data_anak = Anak::get();
        return view('pimpinan.daftar_anak', compact('data_anak'));
    }

    /**
     * Menampilkan daftar klien
     * route('pimpinan.daftar_klien')
     * ('pimpinan/daftar_klien')
     * @return [type] [description]
     */
    public function daftar_klien()
    {
        $data_klien = Klien::get();
        return view('pimpinan.daftar_klien', compact('data_klien'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
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
