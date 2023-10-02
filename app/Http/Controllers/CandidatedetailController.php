<?php

namespace App\Http\Controllers;
use App\Models\Candidatedetail;

use Illuminate\Http\Request;

class CandidatedetailController extends Controller
{
 
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companyusers,id',
           
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'dob' => 'required|date',
            // 'photo' => 'required|image|max:2048', // Assuming photo is an image
            // 'Resume' => 'required|file|max:2048', // Assuming Resume is a file
        ]);

   
        $candidateDetail = new Candidatedetail($validatedData);

        $candidateDetail->save();

       
        return response()->json([
            'message' => 'Application submitted successfully',
            'candidate_id' => $candidateDetail->id, 
            'company_id' => $candidateDetail->company_id, 
            'job_id' => $candidateDetail->job_id, 
        ]);
    }
}
