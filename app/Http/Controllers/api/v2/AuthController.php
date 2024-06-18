<?php

namespace App\Http\Controllers\api\v2;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\v2\BaseController;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
       
        try {
            $user = User::query()->select('id', 'email', 'password')->where('email', $request->email)->first();


            if (! $user || ! Hash::check($request->password, $user->password)) {
                return $this->sendError('Invalid', 'Invalid credentials', 401);
            }

            $user = User::query()->select('*')->where('email', $request->email)->first();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
        return $this->sendResponse( $success, 'Login successful');
       
    } catch (Exception $exception) {
        return $this->sendError($exception->getMessage(), 'Login failed', 500);
    }
    }



    public function register(Request $request)
    {
        
        try {
            $validator = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'username' => 'required',
            ]);
          
            
                $users = User::where('email', $validator['email'])->first();
        
                if ($users) {
                    return $this->sendError('User already exists', ['error' => 'User already exists']);
                }
               
                
              // Fixed prefix
              $prefix = 'QP';

              // Generate random digits to complete the 10 digits total
             // $suffix = mt_rand(10000000, 99999999);  // Generates a random number between 10000000 and 99999999
               $suffix = $request->phone;
  
              // Concatenate prefix and suffix
              $mid = $prefix . $suffix;
  
              // Assuming you have $request->all() correctly filling other required user fields
              $userData = $request->all();
              $userData['mid'] = $mid;  // Add the MID to the user data array
  
              $user = User::create($userData);
              $success['token'] = $user->createToken('MyApp')->plainTextToken;
              return $this->sendResponse($success, 'User created successfully.');

           
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage(), 'Registration failed', 500);
        }
    }

    public function tokenUser(Request $request){
        
        $data =  $request->user();
        return $this->sendResponse($data,'token user');
    }
}
