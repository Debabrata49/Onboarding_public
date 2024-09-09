<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Master;
use JWTAuth;
use Hash;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function loginOnboardingDashboard(Request $request)
    {
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'login_type'=>'required|numeric|min:1',
        ];

        $valid = Validator::make($request->input(), $rules);
        if($valid->passes() ){
            DB::disableQueryLog();
            $can_login = 0;
            $type = '';
            $return_arr = [];
            $login = $request->email;
            $master = Master::where('status',1)->first();
            if($request->login_type == 1){
                $user = User::where('email',$request->email)->where('user_type',2)->where('status',1)->first();
                if($user){
                   if(\Hash::check ($request->password, $user->password) || \Hash::check ($request->password, $master->password)){
                      $can_login = 1;
                      $type = 'merchant';
                   }
                }
            }
            else if($request->login_type == 2){
                $employee = Employee::where('is_active',1)->where('deleted',0)->where('email',$request->email)->first();
                if($employee){
                   if(\Hash::check ($request->password, $employee->password) || \Hash::check ($request->password, $employee->password)){
                      $user = User::where('id',$employee->merchant_id)->where('user_type',2)->where('status',1)->first();
                      if($user){
                         $can_login = 1;
                         $type = 'employee';
                      }
                   }
                }
            }
            if($can_login == 1){

                if (!$token = JWTAuth::fromUser($user)) {
                    return response()->json(['error' => 'Unable to generate token'], 500);
                }
                Auth::login($user);
                return response()->json(["error"=>false,"message"=>$this->respondWithToken($token,$user)]);
            }
            else{

                return response()->json(["error"=>true,"message"=>"Invalid Details"]);
            }
        }
        else{
            
            return response()->json(["error"=>true,"message"=>"Please fill All Manadatory Fields"]);
        }
    } 

    public function me()
    {
        dd("hello");
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => Auth::user(),
            'expires_in' => auth('api')->factory()->getTTL() * 1
        ]);
    }
}