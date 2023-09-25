<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companyuser;
use Illuminate\Support\Facades\Hash;

class CompanyuserController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companyusers,company_email',
            'company_password' => 'required|string|min:6',
        ]);

 
        $companyUser = Companyuser::create([
            'company_name' => $request->input('company_name'),
            'company_email' => $request->input('company_email'),
            'company_password' => bcrypt($request->input('company_password')),
        ]);

       
        return response()->json(['companyUser' => $companyUser], 201);
    }


    public function show($id)
    {
        
        $companyUser = Companyuser::find($id);


        if (!$companyUser) {
            return response()->json(['message' => 'Company user not found'], 404);
        }

    
        return response()->json(['companyUser' => $companyUser], 200);
    }
}
