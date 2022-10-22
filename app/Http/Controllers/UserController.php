<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjekUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function cipta_gambar(Request $request) {
        $path = $request->file('upload')->store('giga/uploads');
    }
}
