<?php

namespace App\Http\Controllers\api\v2;

use App\Models\User;
use App\Models\AdminLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRegisterController extends BaseController
{

   
    public function register(Request $request)
    {
       
            
    $validator = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
        $users = AdminLogin::where('email', $validator['email'])->first();

        if ($users) {
            return $this->sendError('User already exists', ['error' => 'User already exists']);
        }
        
        $user = AdminLogin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'device_id' => $request->device_id, // Store the IP address from the request

        ]);

        
      

        $token = $user->createToken('authToken')->plainTextToken;
        return $this->sendResponse($token, 'User created successfully.');}

    public function login(Request $request)
    {

        
    $validator = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
       
        $user = AdminLogin::where('email', $validator['email'])->first();
        
       

    // Check if the user exists and if the password is correct
    if (!$user || !Hash::check($validator['password'], $user->password)) {
 
        // Log the failed attempt
        return $this->sendError('Unauthorized', ['error' => 'Invalid credentials']);
    }



    // Create a new token for the user
    $success['token'] = $user->createToken('MyApp')->plainTextToken;

    // Return a successful response with the token
    return $this->sendResponse($success, 'User login successfully.');
    }

}
