<?php

namespace App;

use App\User;
use App\Utilities\PageHelpers;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['name', 'path', 'description', 'main_content', 'created_by', 'updated_by', 'active'];

	/*
		Relationships 
	 */
		public function owner()
		{
			return $this->belongsTo('App\User', 'created_by');
		}

		public function collaborators()
		{
			return $this->belongsToMany('App\User', 'page_collaborators');
		}

		public function updater()
		{
			return $this->belongsTo('App\User', 'updated_by');
		}

	/*
		Helpers
	 */
		public function formattedPath()
		{
			$page_helper = new PageHelpers;

			return $page_helper->removeLeadingAndTrailingSlashes($this->path);
		}

		public function isActive()
		{
			return $this->active ? 'Yes' : 'No';
		}

		public function addCollaborator(User $user)
		{
			\DB::table('page_collaborators')->insert([
				'page_id' => $this->id,
				'user_id' => $user->id
			]);
		}

		public function removeCollaborators()
		{
			\DB::table('page_collaborators')->where('page_id', $this->id)->delete();
		}

		public function potentialCollaborators()
		{
			$owner_id = $this->owner->id;
			$ids      =  array_unique( array_merge($this->collaboratorIds(), [$owner_id]) );

			// Get users
			return User::whereNotIn('id', $ids)->get();
		}

		public function collaboratorIds()
		{
			return $this->collaborators->pluck('id')->toArray();
		}
}
