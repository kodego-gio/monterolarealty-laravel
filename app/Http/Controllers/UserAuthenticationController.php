<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthenticationController extends Controller
{
    public function register(Request $request){

        //VALIDATE INPUT
        $validator = Validator::make($request->all(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'password' => 'required',
            'facebook_url' => 'required',
            'role' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors()->all()],500);
        }
        //HASHING PASSWORD
        $password_hash = Hash::make($request->password);

        //INSERT TO DATABASE
        $user = User::create([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => $password_hash,
            'fb_link' => $request->facebook_url,
            'usertype' => $request->role,
        ]);

        //TOKEN
        $token = $user->createToken('KodegoTokenPassword')->accessToken;

        $response = ['message' => 'User successfully created!','token'=> $token];

        return $response;
    }

    public function login(Request $request){
        //VALIDATE INPUT
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors()->all()],500);
        }

        //select * from user where email = $request->email
        $user = User::where('email',$request->email)->first();

        //if exist
        if($user){
            //check if same password using hash
            $check_password = Hash::check($request->password, $user->password);

            //if same password
            if($check_password){
                $token = $user->createToken('KodegoTokenPassword')->accessToken;
                $response = ['message' => 'User successfully logged in!','token'=> $token, 'user' => $user];

                return $response;

            }else{
                return response(['message'=> 'Invalid password!'],500);
            }

        }else{
            return response(['message'=> 'Email does not exist!'],500);
        }


    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'User successfully logged out!'];

        return $response;
    }
}
