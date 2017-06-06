<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\SpellChecker;

class UtilityController extends Controller
{
    public function spellCheck(Request $request)
    {
        return (new SpellChecker)->spellCheck(
            explode(",", $request->words)
        );
    }
}
