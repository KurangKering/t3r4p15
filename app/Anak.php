<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
	protected $table = "anak";
	protected $fillable = [
		'nama',
		'tempat_lahir',
		'tanggal_lahir',
		'klien_id',
		'anak_ke',
	];

	public function klien()
	{
		return $this->belongsTo('App\Klien');
	}
}
