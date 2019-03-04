<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerapiAnak extends Model
{
	protected $table = "terapi_anak";
	protected $fillable = [
		'status',
		'terapi_id',
		'anak_id',
		'terapis_id',
	];

	public function terapi()
	{
		return $this->belongsTo('App\Terapi');
	}

	public function terapis()
	{
		return $this->belongsTo('App\Terapis');
	}
	public function anak()
	{
		return $this->belongsTo('App\Anak');
	}

	public function hasil_terapi()
	{
		return $this->hasMany('App\HasilTerapi');
	}

	public function hasil_evaluasi()
	{
		return $this->hasMany('App\HasilEvaluasi');
	}
}
