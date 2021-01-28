<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    //

    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, ' User registered successfully');

    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user=Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, ' User login successful');
 
        }else{
        return $this->sendError('Unauthorised! ', ['error'=>'Unauthorised!']);

        }
    }













    
    // public function reset(Request $request, User $user)
    // {   
    //     $input = $request->all();
    //     $validator = Validator::make($input,[
    //         'name'=>'required',
    //         'email'=>'required|email',
    //         'o_password'=>'required',
    //         'n_password'=>'required',
    //     ]);

    //     if($validator->fails()){
    //         return $this->sendError('Validation error.', $validator->errors());
    //     }
    //     if(!Hash::check($input['o_password'], Auth::user()->password)){
    //         return $this->sendError('Old password didnt match.');
    //     }

    //     $input['n_password'] = bcrypt($input['n_password']);
    //     Auth::user()->password = $input['n_password'];
    //     Auth::user()->save();
    //     $success['token'] = $user->createToken('MyApp')->accessToken;
    //     $success['name'] = $user->name;

    //     return $this->sendResponse($success, ' User registered successfully');

    // }
}