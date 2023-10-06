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
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])->first();

            if (!$user) {
                $user = Companyuser::where('company_email', $credentials['email'])->first();
            }

            if ($user) {
                $passwordField = ($user instanceof Companyuser) ? 'company_password' : 'password';

                if (Hash::check($credentials['password'], $user->$passwordField)) {
                    Login::create([
                        'email' => $credentials['email'],
                        'login_time' => now(),
                    ]);

                    $userType = ($user instanceof Companyuser) ? 'company' : 'user';

                    return response()->json([
                        'success' => true,
                        'message' => 'Login successful',
                        'userType' => $userType,
                    ]);
                }
            }

            \Log::error('Login failed for email: ' . $credentials['email']);
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);

        } catch (Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during login',
            ], 500);
        }
    }   
}
