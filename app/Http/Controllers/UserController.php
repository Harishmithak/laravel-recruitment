<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;


use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $registrationView = View::make('auth.register')->render();
        return response()->json(['registration_view' => $registrationView]);

    }

}
