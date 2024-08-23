<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        try{
            $user = User::where('email',$request->email)->first();

            if(!$user || ! Hash::check(
                        $request->password,
                        $user->password))
                throw new Exception('Dados inválidos!!!');

            $token  = $user->createToken($request->email)->plainTextToken;
            return response()->json(['token'=>$token]);

        }catch(Exception $error){
            return $this->errorHandler('Erro ao efetuar login!!!', $error,403);
        }
    }
}
