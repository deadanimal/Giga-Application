<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Projek;
use App\Models\User;


class ProjekController extends Controller
{
    public function senarai(Request $request) {
        $projeks = Projek::all();
        return view('projek_senarai', compact('projeks'));
    }

    public function cipta(Request $request) {
        $projek = New Projek;
        $projek->nama = $request->nama;
        $projek->prefix = $request->prefix;
        $projek->nota = $request->nota;
        $projek->save();
        return back();
    }

    public function satu(Request $request) {
        $id = (int)$request->route('id');
        $user = $request->user();        
        $projek = Projek::find($id);
        $users = User::where('projek_id', $id)->get();
        return view('projek_satu', compact('projek', 'users'));
    }    

    public function kemaskini(Request $request) {

    }

    public function cipta_user(Request $request) {
        $projek_id = (int)$request->route('id');
        $user = New User;
        $user->nama = $request->nama;
        $user->namalogin = $request->namalogin;
        $user->katalaluan = $request->katalaluan;
        $user->projek_id = $projek_id;
        $user->save();
        return back();        
    }   
    
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'namalogin' => 'required',
                'katalaluan' => 'required',
                'projek_id' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // if(!Auth::attempt($request->only(['namalogin', 'katalaluan', 'projek_id']))){
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Email & Password does not match with our record.',
            //     ], 401);
            // }

            $user = User::where([
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
