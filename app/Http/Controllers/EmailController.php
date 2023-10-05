<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SortlistedMail;
use Illuminate\Http\Request;
class EmailController extends Controller
{
    public function sendEmail($email)
    {
        try {
            Mail::to($email)->send(new SortlistedMail());
            return response()->json(['message' => 'Email sent successfully']);
        } catch (Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['error' => 'Error sending email'], 500);
        }
        
}

}