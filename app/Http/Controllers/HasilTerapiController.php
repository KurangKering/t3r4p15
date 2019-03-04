<?php

namespace App\Http\Controllers;

use App\HasilTerapi;
use App\TerapiAnak;
use PDF;
use Illuminate\Http\Request;

class HasilTerapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $terapi_anak_id = $request->query('terapi_anak_id');
        if ($terapi_anak_id) {
            $hasil_terapi = HasilTerapi::where('terapi_anak_id', $terapi_anak_id)->get();

        } else 
        {
            $hasil_terapi = HasilTerapi::latest()->get();
        }
        return view("hasil_terapi.index", compact('hasil_terapi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   

        $terapi_anak_id = $request->query('terapi_anak_id');
        $terapi_anak = TerapiAnak::findOrFail($terapi_anak_id);

        return view('hasil_terapi.create', compact('terapi_anak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'terapi_anak_id' => 'required',
            'pertemuan_ke' => 'required',
            'tanggal' => 'required',
            'hasil' => 'required',
        ],
        []);

        $input = $request->all();
        $hasil_terapi = HasilTerapi::create($input);
        return redirect(route('hasil_terapi.index', ['terapi_anak_id' => $hasil_terapi->terapi_anak->id]))->with(['success' => true, 'msg' => 'Berhasil Menambah Hasil Terapi']);

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
        $hasil_terapi = HasilTerapi::findOrFail($id);
        $terapi_anak = $hasil_terapi->terapi_anak;
        return view('hasil_terapi.edit', compact('hasil_terapi', 'terapi_anak'));

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


        $request->validate([
            'pertemuan_ke' => 'required',
            'tanggal' => 'required',
            'hasil' => 'required',
        ],
        []);

        $input = $request->all();
        $hasil_terapi = HasilTerapi::findOrFail($id);
        $hasil_terapi = $hasil_terapi->update($input);
        return redirect(route('hasil_terapi.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Hasil Terapi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasil_terapi = HasilTerapi::findOrFail($id);
        $hasil_terapi->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Terapi']);
        
    }

    /**
     * url('hasil_terapi/{id}/cetak') 
     * route('hasil_terapi.cetak', {id})
     */
    public function cetak($id) 
    {
        $hasil_terapi = HasilTerapi::findOrFail($id);
        
        // return view('hasil_terapi.cetak', compact('hasil_terapi'));
        $pdf = PDF::setPaper('A4','portrait')->loadView('hasil_terapi.cetak', compact('hasil_terapi'));
         return $pdf->stream();
    }
}
