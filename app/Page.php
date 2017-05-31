<?php

namespace App;

use App\Utilities\PageHelpers;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['name', 'path', 'description', 'main_content', 'created_by'];

	public function owner()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function formattedPath()
	{
		$page_helper = new PageHelpers;

		return $page_helper->removeLeadingAndTrailingSlashes($this->path);
	}
}
