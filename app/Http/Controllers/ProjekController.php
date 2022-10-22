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
        $user->email = 'forever@pipeline.com.my';
        $user->name = $request->nama;
        $user->nama = $request->nama;
        $user->namalogin = $request->namalogin;
        $user->katalaluan = $request->katalaluan;
        $user->projek_id = $projek_id;
        $user->save();
        return back();        
    }   
    
     /**
     * Login
     *
     * Check that the service is up. If everything is okay, you'll get a 200 OK response.
     *
     * Otherwise, the request will fail with a 400 error, and a response listing the failed services.
     *
     * @bodyParam user_id int required The id of the user. Example: 9
     * @bodyParam room_id string The id of the room.
     * @bodyParam forever boolean Whether to ban the user forever. Example: false
     * @bodyParam another_one number This won't be added to the examples. No-example* 
     * @response 400 scenario="Service is unhealthy" {"status": "down", "services": {"database": "up", "redis": "down"}}
     * @responseField status The status of this API (`up` or `down`).
     * @responseField services Map of each downstream service and their status (`up` or `down`).
     */
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
