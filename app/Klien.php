<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
	protected $table = 'klien';
	protected $fillable = [
		'nama_ayah',
		'hp_ayah',
		'email_ayah',
		'nama_ibu',
		'hp_ibu',
		'email_ibu',
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function anak()
	{
		return $this->hasMany('App\Anak');
	}
}
