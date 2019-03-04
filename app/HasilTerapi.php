<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilTerapi extends Model
{
	protected $table = "hasil_terapi";
	protected $fillable = [
		'pertemuan_ke',
		'hasil',
		'tanggal',
		'terapi_anak_id',
	];

	public function terapi_anak()
	{
		return $this->belongsTo('App\TerapiAnak');
	}

	public function hasil_evaluasi_terapi()
	{
		return $this->hasMany('App\HasilEvaluasiTerapi');
	}
}
