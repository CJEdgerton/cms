<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\SpellChecker;

class UtilityController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function spellCheck(Request $request)
    {
        return (new SpellChecker)->spellCheck(
            explode(",", $request->words)
        );
    }

    public function uploadImage(Request $request)
    {
    	// dd($request->file('image'));
        return asset(
            $request->file('image')->store('images', 'public')
        );
    }

}
