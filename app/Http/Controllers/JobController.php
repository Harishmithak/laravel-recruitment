<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $loggedInEmail = $request->input('company_email');
        $jobs = job::where('company_email', $loggedInEmail)->get();
        return response()->json(['jobs' => $jobs], 200);
    }
    public function index1()
    {
        $jobs = job::all();

        return response()->json(['jobs' => $jobs], 200);
     
    
    }
       
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_email' => 'required|email',
                'job_position' => 'required',
                'job_description' => 'required',
                'basic_qualification' => 'required',
                'skills_required' => 'required',
                'application_start_date' => 'required|date',
                'application_end_date' => 'required|date',
                'status' => 'required',
            ]);
    
      
            $company = \App\Models\Companyuser::where('company_email', $request->input('company_email'))->first();
        
            if (!$company) {
                return response()->json(['error' => 'Company not found.'], 404);
            }
    
          
            $job = new Job([
                'company_id' => $company->id,
                'company_name' => $company->company_name,
                'company_email' => $request->input('company_email'),
                'job_position' => $request->input('job_position'),
                'job_description' => $request->input('job_description'),
                'basic_qualification' => $request->input('basic_qualification'),
                'skills_required' => $request->input('skills_required'),
                'application_start_date' => $request->input('application_start_date'),
                'application_end_date' => $request->input('application_end_date'),
                'status' => $request->input('status'),
              
            ]);
    
            $company->jobs()->save($job);
            return response()->json(['job' => $job], 201);

        } catch (\Exception $e) {
          
            \Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    

    public function show($id)
    {
  
        $job = job::find($id);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json(['job' => $job], 200);
    }

    public function update(Request $request, $id)
    {
      
        $validatedData = $request->validate([
            'job_position' => 'required|string',
            'job_description' => 'required|string',
            'basic_qualification' => 'required|string',
            'skills_required' => 'required|string',
            'application_start_date' => 'required|date',
            'application_end_date' => 'required|date',
        ]);

        $job = job::find($id);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

      
        $job->update($validatedData);

        return response()->json(['message' => 'Job updated successfully', 'job' => $job], 200);
    }

    public function softDelete($id){
        $job = job::find($id);

            if (!$job) {
                return response()->json(['message' => 'Job not found'], 404);
            }
            $job->delete();
    
            return response()->json(['message' => 'Job deleted successfully'], 204);
    }

public function restore($id){
    $job = job::withTrashed()->find($id);
    $job->restore();
    return response()->json(['job' => $job], 200);

}

    public function showByLoggedInEmail(Request $request)
{
    
    $loggedInEmail = $request->user()->email;

  
    $jobs = job::where('company_name', $loggedInEmail)->get();

    if ($jobs->isEmpty()) {
        return response()->json(['message' => 'No jobs found for the logged-in user'], 404);
    }

    return response()->json(['jobs' => $jobs], 200);
}

}
