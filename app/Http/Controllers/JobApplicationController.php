<?php

namespace App\Http\Controllers;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create() {
        return view('JobApplication-form');
    }

    public function agg_job_application(Request $request) {
        $application = new JobApplication();
        $application->message = $request->message;
        $application->unemployed_id = $request->unemployed_id;
        $application->job_offer_id = $request->job_offer_id;
        $application->save();

        return $application;
    }
}
