<?php

namespace App\Http\Controllers;

use App\HasilEvaluasi;
use App\HasilEvaluasiTerapi;
use App\TerapiAnak;
use Illuminate\Http\Request;
use PDF;
class HasilEvaluasiController extends Controller
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
            $hasil_evaluasi = HasilEvaluasi::where('terapi_anak_id', $terapi_anak_id)->get();

        } else 
        {
            $hasil_evaluasi = HasilEvaluasi::latest()->get();
        }
        return view("hasil_evaluasi.index", compact('hasil_evaluasi'));

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



        $terpakai_hasil_terapi_ids = []; 
        $terapi_anak->hasil_evaluasi->each(function($evaluasi) use (&$terpakai_hasil_terapi_ids){
            $hasil_terapi_ids = $evaluasi->hasil_evaluasi_terapi->pluck('hasil_terapi_id')->toArray();
            $terpakai_hasil_terapi_ids = array_unique(array_merge($terpakai_hasil_terapi_ids, $hasil_terapi_ids));            
        });


        $data_hasil_terapi = $terapi_anak->hasil_terapi->whereNotIn('id', $terpakai_hasil_terapi_ids);
        return view('hasil_evaluasi.create', compact('terapi_anak', 'data_hasil_terapi'));
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
            'hasil_terapi_ids' => 'required',
            'tanggal' => 'required',
            'hasil' => 'required',
        ],
        []);

        $input = $request->except('hasil_terapi_ids');

        $hasil_evaluasi = HasilEvaluasi::create($input);

        if ($hasil_evaluasi) {

            $ids = $request->get('hasil_terapi_ids');
            foreach ($ids as $id) {
                $array_input = [
                    'hasil_evaluasi_id' => $hasil_evaluasi->id,
                    'hasil_terapi_id' => $id,
                ];

                
                $hasil_evaluasi_terapi = HasilEvaluasiTerapi::create($array_input);
            }


        }
        return redirect(route('hasil_evaluasi.index', ['terapi_anak_id' => $hasil_evaluasi->terapi_anak_id]))->with(['success' => true, 'msg' => 'Berhasil Menambah Hasil Evaluasi']);

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

        $hasil_evaluasi = HasilEvaluasi::findOrFail($id);
        $terapi_anak = $hasil_evaluasi->terapi_anak;

        $terpakai_evaluasi_semua = []; 

        $terapi_anak->hasil_evaluasi->where('id', '!=' , $hasil_evaluasi->id)->each(function($evaluasi) use (&$terpakai_evaluasi_semua){
            $hasil_terapi_semua = $evaluasi->hasil_evaluasi_terapi->pluck('hasil_terapi_id')->toArray();
            $terpakai_evaluasi_semua = array_unique(array_merge($terpakai_evaluasi_semua, $hasil_terapi_semua));            
        });

        $data_hasil_terapi = $terapi_anak->hasil_terapi->whereNotIn('id', $terpakai_evaluasi_semua);

        




        return view('hasil_evaluasi.edit', compact('hasil_evaluasi', 'terapi_anak', 'data_hasil_terapi'));
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
            'hasil_terapi_ids' => 'required',
            'tanggal' => 'required',
            'hasil' => 'required',
        ],
        []);

        $hasil_evaluasi = HasilEvaluasi::findOrFail($id);
        $input = $request->except('hasil_terapi_ids');
        $hasil_evaluasi->update($input);

        if ($hasil_evaluasi) {


            $hasil_terapi_baru_ids = $request->get('hasil_terapi_ids');


            $hasil_terapi_lama_ids = $hasil_evaluasi->hasil_evaluasi_terapi->pluck('hasil_terapi_id')->all();
            $arr_hapus = array_diff($hasil_terapi_lama_ids, $hasil_terapi_baru_ids);
            $arr_tambah = array_diff($hasil_terapi_baru_ids, $hasil_terapi_lama_ids);

            foreach ($arr_hapus as $hasil_terapi_hapus_id) {
                $condition_terapi_hapus = [
                    'hasil_terapi_id' =>  $hasil_terapi_hapus_id,
                    'hasil_evaluasi_id' => $hasil_evaluasi->id,
                ];
                $hasil_evaluasi_terapi_hapus = HasilEvaluasiTerapi::where($condition_terapi_hapus)->delete();
            }

            foreach ($hasil_terapi_baru_ids as $key => $hasil_baru_id) {
                $condition_terapi_tambah = [
                    'hasil_terapi_id' =>  $hasil_baru_id,
                    'hasil_evaluasi_id' => $hasil_evaluasi->id,
                ];
                $hasil_evaluasi_terapi_tambah = HasilEvaluasiTerapi::firstOrCreate($condition_terapi_tambah);
            }
        // foreach ($arr_tambah as $hasil_terapi_tambah_id) {
        //     $condition_terapi_tambah = [
        //         'hasil_terapi_id' =>  $hasil_terapi_tambah_id,
        //         'hasil_evaluasi_id' => $hasil_evaluasi->id,
        //     ];
        //     $hasil_evaluasi_terapi_tambah = HasilEvaluasiTerapi::create($condition_terapi_tambah);
        // }


        }
        return redirect(route('hasil_evaluasi.index'))->with(['success' => true, 'msg' => 'Berhasil Merubah Hasil Evaluasi']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasil_evaluasi = HasilEvaluasi::findOrFail($id);
        $hasil_evaluasi->hasil_evaluasi_terapi->each(function($evaluasi_terapi) {
            $evaluasi_terapi->delete();
        });
        $hasil_evaluasi->delete();

        return response()->json(['success' => true, 'msg' => 'Berhasil menghapus data Hasil Evaluasi']);

    }

      /**
     * url('hasil_evaluasi/{id}/cetak') 
     * route('hasil_evaluasi.cetak', {id})
     */
      public function cetak($id) 
      {
        $hasil_evaluasi = HasilEvaluasi::findOrFail($id);
        $periode_awal = $hasil_evaluasi->hasil_evaluasi_terapi->min('hasil_terapi.tanggal');
        $periode_akhir = $hasil_evaluasi->hasil_evaluasi_terapi->max('hasil_terapi.tanggal');
        $periode = '';
        if (indonesian_date($periode_awal, 'F Y') == indonesian_date($periode_akhir, 'F Y')) {
            $periode = indonesian_date($periode_akhir, 'F Y');
        }
        else if (indonesian_date($periode_awal, 'Y') == indonesian_date($periode_akhir, 'Y') ) {
            $periode = indonesian_date($periode_awal, 'F') . ' - ' . indonesian_date($periode_akhir, 'F Y');
        } else {
            $periode = indonesian_date($periode_awal, 'F Y') . ' - ' . indonesian_date($periode_akhir, 'F Y');
        }
        

        // return view('hasil_evaluasi.cetak', compact('hasil_evaluasi'));
        $pdf = PDF::setPaper('A4','portrait')->loadView('hasil_evaluasi.cetak', compact('periode', 'hasil_evaluasi'));
        return $pdf->stream();
    }
}
