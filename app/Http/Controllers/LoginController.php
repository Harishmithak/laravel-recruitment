<?php

namespace App\Http\Controllers;
use App\Models\login;
use App\Models\User;
use App\Models\Companyuser;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password', 'usertype');
    //     $user = null;

    //     if ($credentials['usertype'] === 'user') {
    //         $user = User::where('email', $credentials['email'])
    //             ->where('password', $credentials['password'])
    //             ->first();
    //     } elseif ($credentials['usertype'] === 'company') {
    //         $user = Companyuser::where('company_email', $credentials['email'])
    //             ->where('company_password', $credentials['password'])
    //             ->first();
    //     }

    //     if ($user) {
    //         Login::create([
    
    //             'email' => $credentials['email'], 
               
    //             'usertype' => $credentials['usertype'],
    //             'login_time' => now(),
    //         ]);
    //         return response()->json(['message' => 'Login successful']);
    //     }

    //     return response()->json(['message' => 'Login failed'], 401);
    // }

    public function login(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'usertype' => 'required|in:user,company', 
    ]);

    $credentials = $request->only('email', 'password', 'usertype');
    $user = null;

    if ($credentials['usertype'] === 'user') {
        $user = User::where('email', $credentials['email'])->first();
    } elseif ($credentials['usertype'] === 'company') {
        $user = Companyuser::where('company_email', $credentials['email'])->first();
    }

    if ($user)  {
        if (($credentials['usertype'] === 'user' && Hash::check($request->input('password'), $user->password)) ||
        ($credentials['usertype'] === 'company' && Hash::check($request->input('password'), $user->company_password))) {
        \Log::info('Password Hash Check Passed');
        Login::create([
            'email' => $credentials['email'], 
            'usertype' => $credentials['usertype'],
            'login_time' => now(),
        ]);
        return response()->json(['message' => 'Login successful']);
    }
    }
    return response()->json(['message' => 'Login failed'], 401);
}
 
}
