<?php

namespace App\Http\Controllers;
use App\Models\Experiendetail;
use App\Mail\ExperienceApplied;
use App\Models\Candidatedetail; 
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        try {
          
            $validatedData = $request->validate([
                'candidate_id' => 'required|exists:candidatedetails,id',
                'academic_id' => 'required|exists:academicdetails,id',
                'company_id' => 'required|exists:companyusers,id',
                'job_id' => 'required|exists:jobs,id',
                'year_of_experience' => 'required|integer',
                'previous_company_name' => 'required|string',
                'previous_job_position' => 'required|string',
            ]);

            $experienceDetail = Experiendetail::create($validatedData);

            $candidate = Candidatedetail::findOrFail($validatedData['candidate_id']);
            $candidateEmail = $candidate->email;
            $candidatename=$candidate->name;
           // $candidate=$candidate->name;

          
            Mail::to($candidateEmail)->send(new ExperienceApplied($experienceDetail));


            return response()->json([
                'message' => 'Experience detail submitted successfully',
                'experience_detail' => $experienceDetail,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}