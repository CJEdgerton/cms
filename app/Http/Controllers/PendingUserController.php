<?php

namespace App\Http\Controllers;

use App\User;
use App\PendingUser;
use App\Mail\ApprovedRegistrationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PendingUserController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('check_if_admin');
    }

    public function approveRegistration(PendingUser $pending_user)
    {
        // add the pending user to the users table
	        $user = User::create([
				'last_name'  => $pending_user->last_name,
				'first_name' => $pending_user->first_name,
				'email'      => $pending_user->email,
				'password'   => $pending_user->password,
	        ]);

        // delete the pending user
	        $pending_user->delete();

        // email the newly approved user
        	Mail::to($user->email)->send( new ApprovedRegistrationEmail($user) ); 

        // redirect to the users.index page with a flash message of success
	        flash('User activated', 'success');
	        return redirect()->route('users.index');
    }
}
