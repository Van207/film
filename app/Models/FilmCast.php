<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCast extends Model
{
	use HasFactory;
	protected $table = 'film_cast';
	public function film()
	{
		return $this->belongsTo(Film::class, 'id', 'film_id');
	}
}
