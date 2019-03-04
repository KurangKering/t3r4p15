<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasiTerapi extends Model
{
	protected $table  = 'hasil_evaluasi_terapi';
	protected $fillable  = ['hasil_evaluasi_id', 'hasil_terapi_id'];

	public function hasil_evaluasi()
	{
		return $this->belongsTo('App\HasilEvaluasi');
	}

	public function hasil_terapi()
	{
		return $this->belongsTo('App\HasilTerapi');
	}
}
