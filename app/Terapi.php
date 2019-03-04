<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terapi extends Model
{
	protected $table = "terapi";
	protected $fillable = [
		'jenis',
	];

}
