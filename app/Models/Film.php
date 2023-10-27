<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
	use HasFactory;
	protected $table = 'films';

	public function film_cast()
	{
		return $this->hasMany(FilmCast::class, 'film_id', 'id');
	}

	public function film_detail()
	{
		return $this->hasMany(FilmDetail::class, 'film_id', 'id');
	}

	public function film_revenue()
	{
		return $this->hasMany(FilmRevenue::class, 'film_id', 'id');
	}
}
