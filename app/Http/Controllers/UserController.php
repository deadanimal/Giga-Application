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

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'namalogin' => 'required',
                    'katalaluan' => 'required',
                    'projek_id' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['namalogin', 'katalaluan', 'projek']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = ProjekUser::where([
                ['namalogin', '=', $request->namalogin],
                ['katalaluan', '=', $request->katalaluan],
                ['projek_id', '=', $request->projek_id],
            ])->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
