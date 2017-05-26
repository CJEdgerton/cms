<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['name', 'slug', 'path', 'description', 'main_content', 'created_by'];

	public function owner()
	{
		return $this->belongsTo('App\User', 'created_by');
	}
}
