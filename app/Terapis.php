<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terapis extends Model
{
	protected $table = "terapis";
	protected $fillable = [
		'tempat_lahir',
		'tanggal_lahir',
		'alamat',
		'no_hp',
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function terapi_anak()
	{
		return $this->hasMany('App\TerapiAnak');
	}
	
}
