<?php

namespace App\Http\Controllers;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
  public function agg_job_application(Request $request) {
    $validatedData = $request->validate([
        'message' => 'required|string|max:1000',
        'job_offer_id' => 'required|integer|exists:job_offers,id'
    ]);

    $application = new JobApplication();
    $application->message = $validatedData['message'];
    $application->unemployed_id = Auth::id(); // Asigna el ID del usuario autenticado
    $application->job_offer_id = $validatedData['job_offer_id'];
    $application->save();

    return $application;
}
}
