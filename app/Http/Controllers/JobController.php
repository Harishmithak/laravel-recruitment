<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {

        $jobs = job::all();
        return response()->json(['jobs' => $jobs], 200);
    }

    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'company_id'=>'required',
            'company_name'=>'required|string',
            'job_position' => 'required|string',
            'job_description' => 'required|string',
            'basic_qualification' => 'required|string',
            'skills_required' => 'required|string',
            'application_start_date' => 'required|date',
            'application_end_date' => 'required|date',
        ]);

      
        // $user = auth()->user();
        // $companyId = $user->id;
        // $companyName = $user->company_name;

     
        $job = new job([
             'company_id' =>$validatedData['company_id'] ,
            'company_name' => $validatedData['company_name'],
            'job_position' => $validatedData['job_position'],
            'job_description' => $validatedData['job_description'],
            'basic_qualification' => $validatedData['basic_qualification'],
            'skills_required' => $validatedData['skills_required'],
            'application_start_date' => $validatedData['application_start_date'],
            'application_end_date' => $validatedData['application_end_date'],
        ]);

        $job->save();

        return response()->json(['message' => 'Job created successfully'], 201);
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

    // public function destroy($id)
    // {
       
    //     $job = job::find($id);

    //     if (!$job) {
    //         return response()->json(['message' => 'Job not found'], 404);
    //     }

        
    //     $job->delete();

    //     return response()->json(['message' => 'Job deleted successfully'], 204);
    // }
    public function softDelete($id){
        $job = job::find($id);

            if (!$job) {
                return response()->json(['message' => 'Job not found'], 404);
            }
            $job->delete();
    
            return response()->json(['message' => 'Job deleted successfully'], 204);
    }
}
