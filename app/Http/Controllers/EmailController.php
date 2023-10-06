<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SortlistedMail;
use Illuminate\Http\Request;
use App\Models\Candidatedetail;
class EmailController extends Controller
{
    public function sendEmail($email, $shortlistReason)
    {
        try {
            Log::info('Received email: ' . $email); 
            Mail::to($email)->send(new SortlistedMail());
            Candidatedetail::where('email', $email)->update([
                'remarks' => $shortlistReason,
                'status' => 'Shortlisted',
            ]);
            return response()->json(['message' => 'Email sent successfully']);
        } catch (Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Error sending email'], 500);
        }
        
}

}