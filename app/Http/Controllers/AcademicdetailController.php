<?php

namespace App\Http\Controllers;
use App\Models\Academicdetail;
use Illuminate\Http\Request;

class AcademicdetailController extends Controller
{
    public function store(Request $request)
    {
        try {
            \Log::info('Request data:', $request->all());
            $validatedData = $request->validate([
            'candidate_id' => 'required|exists:candidatedetails,id',
            'company_id' => 'required|exists:companyusers,id',
            'job_id' => 'required|exists:jobs,id',
            'Qualification' => 'required|string',
            'college_name' => 'required|string',
            'year_of_passing_college' => 'required|integer',
            'percentage_college' => 'required|numeric',
            'school_name_tenth' => 'required|string',
            'year_of_passing_tenth' => 'required|integer',
            'percentage_tenth' => 'required|numeric',
            'school_name_twelfth' => 'required|string',
            'year_of_passing_twelfth' => 'required|integer',
            'percentage_twelfth' => 'required|numeric',
            'skills' => 'required|string',
            'job_position' => 'required|string',
          
        ]);

        $academicDetails = Academicdetail::create($validatedData);
        return response()->json([
            'message' => 'Application submitted successfully',
            'candidate_id' => $academicDetails->candidate_id, 
            'academic_id' => $academicDetails->id, 
            'company_id' => $academicDetails->company_id, 
            'job_id' =>  $academicDetails->job_id, 
        ]);
} catch (Exception $e) {
    \Log::error($e);
    return response()->json(['error' => 'Error'], 500);
}
}

public function getByCandidateId($candidateId)
{
    try {
        $academicDetails = Academicdetail::where('candidate_id', $candidateId)->first();
        return response()->json([
            'message' => 'Academic details fetched successfully',
            'academicDetails' => $academicDetails,
        ]);
    } catch (Exception $e) {
        \Log::error('Exception occurred: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error fetching academic details',
        ], 500);
    }
}
}