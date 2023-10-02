<?php

namespace App\Http\Controllers;
use App\Models\login;
use App\Models\User;
use App\Models\Companyuser;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Check if credentials match a user in the 'users' table
        $user = User::where('email', $credentials['email'])->first();
    
        // If not found in 'users' table, check 'companyusers' table
        if (!$user) {
            $user = Companyuser::where('company_email', $credentials['email'])->first();
        }
    
        if ($user) {
            // Check the password based on the user type
            $passwordField = ($user instanceof Companyuser) ? 'company_password' : 'password';
    
            if (Hash::check($credentials['password'], $user->$passwordField)) {
                // Your existing login logic
                // For example, you can add the following lines to store login information
                // in the 'logins' table
                Login::create([
                    'email' => $credentials['email'],
                    'login_time' => now(),
                ]);
    
                return response()->json(['message' => 'Login successful']);
            }
        }
    
        return response()->json(['message' => 'Login failed'], 401);
    }
    
    

//     public function login(Request $request)
// {

//     $request->validate([
//         'email' => 'required|email',
//          'password' => 'required',
//         // 'usertype' => 'required|in:user,company', 
//     ]);

//     $credentials = $request->only('email', 'password', 'usertype');
//     $user = null;

//     if ($credentials['usertype'] === 'user') {
//         $user = User::where('email', $credentials['email'])->first();
//     } elseif ($credentials['usertype'] === 'company') {
//         $user = Companyuser::where('company_email', $credentials['email'])->first();
//     }

//     if ($user)  {
//         if (($credentials['usertype'] === 'user' && Hash::check($request->input('password'), $user->password)) ||
//         ($credentials['usertype'] === 'company' && Hash::check($request->input('password'), $user->company_password))) {
      
//         Login::create([
//             'email' => $credentials['email'], 
//             'usertype' => $credentials['usertype'],
//             'login_time' => now(),
            
//         ]);
//         return response()->json(['message' => 'Login successful']);
//     }
//     }
//     return response()->json(['message' => 'Login failed'], 401);
// }
 
}
