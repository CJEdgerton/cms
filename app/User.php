<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin', 'last_name', 'first_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        Relationships
     */
        public function pages()
        {
            return $this->hasMany('App\Page', 'created_by');
        }

        public function collaborations()
        {
            return $this->belongsToMany('App\Page', 'page_collaborators');
        }


    /*
        Helpers
     */
        public function fullName()
        {
            return $this->first_name . ' ' . $this->last_name;
        }

        public function isAdmin()
        {
            return $this->is_admin ? 'Yes' : 'No';
        }
}
