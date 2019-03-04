<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasi extends Model
{
	protected $table = 'hasil_evaluasi';
	protected $fillable = ['hasil', 'terapi_anak_id', 'tanggal'];


	public function terapi_anak()
	{
		return $this->belongsTo('App\TerapiAnak');
	}

	public function hasil_evaluasi_terapi()
	{
		return $this->hasMany('App\HasilEvaluasiTerapi');
	}
}
