<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendApiError($validator->errors()->first(), 400);
        }

        $credentials = $request->only('email', 'password');

        if ($token = Auth::guard('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return $this->sendApiError('Unauthorized', 403);
    }

    protected function respondWithToken($token)
    {
        $expiredTime = Auth::guard('api')->factory()->getTTL() * 60;
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addSeconds($expiredTime)->toDateTimeString()
        ]);
    }
}
