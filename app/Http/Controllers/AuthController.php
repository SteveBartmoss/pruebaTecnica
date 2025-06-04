<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthFormRequest;
use App\Http\Requests\LoginFormRequest;

class AuthController extends Controller
{
    
    public function register(AuthFormRequest $request){

        $validated = $request->validated();

        $user = User::create($validated);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()-json([
                'message' => 'Successfully created user!',
                'accessToken' => $token,
            ],201);
            
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }

    public function login(LoginFormRequest $request){

        $customPermissions = ['action' => 'ver', 'subject' => 'AclHome'];
        $validated = $request->validated();

        $credentials = ['email' => $validated->email, 'password' => $validated->password];

        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'El usuario o contraseña son incorrectas'
            ],401);
        }

        $userData = User::where('email',$validated->email)->first();

        $tokenResult = $userData->createToken('Personal Access Token',['*'], now()->addMinutes($expirationMinutes));
        $token = $tokenResult->plainTextToken;

        $permissions = $user->getAlllPermisssions()->pluck('name')->map(function ($permission){
            list($action, $subject) = explode('-',$permission);
            return [
                'action' => $action,
                'subject' => $subject,
            ];
        })->toArray();

        array_push($permissions, $customPermissions);
        $data = [
            'userData' => $userData,
            'userAbilityRules' => $permissions,
            'tokenType' => 'Bearer',
            'accessToken' => $token
        ];

        return response()->json($data);
    }

    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    
}
