<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Validator;

class UserController extends Controller
{
    
    public function encode(Request $request) {

        /** request */
        $input  = $request->all();

        $payload = [
            'iss' => 'Ebiz', 
            'sub' => 'Lumen Token JWT', 
            'iat' => time(),
            'exp' => time() + 60*60, 
            'user' => $input,
            'desc' => ''
          ];
          
          $jwt = JWT::encode($payload, env('JWT_SECRET'));
          
          $result = true;
          $message = 'Create Token succeed';
          $user_data = [];
          
          return ['result'=>$result, 'message'=>$message, 'token'=>$jwt, 'data'=> $input];
    }

    
    public function decode(Request $request) {

        /** validate */
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' => 'Validation errors', 'data' =>  $validator->errors()], 422);
        }

        /** request */
        $input  = $request->all();
        
        $decoded = JWT::decode($input['token'], env('JWT_SECRET'), array('HS256'));
        
        $result = true;
        $message = 'Decode succeed';
        $data = $decoded;
        
        return ['result'=>$result, 'message'=>$message, 'data'=>$data];
    }
}
