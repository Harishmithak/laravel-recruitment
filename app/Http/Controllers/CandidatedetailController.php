<?php
namespace App\Http\Controllers;
use App\Models\Candidatedetail;
use Illuminate\Http\Request;
use App\Models\Companyuser;

class CandidatedetailController extends Controller
{
    public function store(Request $request)
    {
        try {
            \Log::info('Received request:', $request->all());
            $validatedData = $request->validate([
                'company_id' => 'required|exists:companyusers,id',
                'job_id' => 'required|exists:jobs,id',
                'name' => 'required|string',
                'email' => 'required|email',
                'dob' => 'required|date',
                'candidate_image' => 'sometimes|image|max:2048',
                'signature_image' => 'sometimes|image|max:2048',
                'resume'=> 'nullable|file|mimes:pdf|max:2048',
            ]);
            if ($request->hasFile('candidate_image')) {
                $imagePath = $request->file('candidate_image')->store('uploads', 'public');
            } else {
                $imagePath = null;
            }

            if ($request->hasFile('signature_image')) {
                $imagePathSign = $request->file('signature_image')->store('signature', 'public');
            } else {
                $imagePathSign = null;
            }
            if ($request->hasFile('resume')) {
                $imagePathResume = $request->file('resume')->store('resumes', 'public');
            } else {
                $imagePathResume = null;
            }
            $candidateDetail = new Candidatedetail([
                'company_id' => $validatedData['company_id'],
                'job_id' => $validatedData['job_id'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'dob' => $validatedData['dob'],
                'candidate_image' => $imagePath, 
                'signature_image' => $imagePathSign, 
                'resume' => $imagePathResume, 
            ]);
            $candidateDetail->save();
            return response()->json([
                'message' => 'Application submitted successfully',
                'candidate_id' => $candidateDetail->id,
                'company_id' => $candidateDetail->company_id,
                'job_id' => $candidateDetail->job_id,
            ]);
        } catch (Exception $e) {
            \Log::error('Exception occurred: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error submitting application',
            ], 500);
        }
    }

    // public function getAllDetails()
    // {
    //     try {
      
    //          $details = Candidatedetail::all();

    //         return response()->json([
    //             'message' => 'Details fetched successfully',
    //             'details' => $details,
    //         ]);
    //     } catch (Exception $e) {
    //         \Log::error('Exception occurred: ' . $e->getMessage());
    //         return response()->json([
    //             'message' => 'Error fetching details',
    //         ], 500);
    //     }
    // }
    public function getAllDetails($userEmail)
    {
        try {
            // Retrieve the corresponding company_id from the companyusers table
            $company = Companyuser::where('company_email', $userEmail)->first();
            $companyId = $company->id;

            // Retrieve candidate details based on the company_id
            $details = Candidatedetail::where('company_id', $companyId)->get();

            return response()->json([
                'message' => 'Details fetched successfully',
                'details' => $details,
            ]);
        } catch (\Exception $e) {
            \Log::error('Exception occurred: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error fetching details',
            ], 500);
        }
    }
}
