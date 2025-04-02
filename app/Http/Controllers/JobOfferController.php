<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function create()
    {
        return view('joboffer'); // Asegúrate de tener la vista correspondiente
    }

    public function agg_joboffer(Request $request)
    {
        $jobOffer = new JobOffer();
        $jobOffer->title = $request->title; // Asegúrate de que el campo 'title' esté en el formulario
        $jobOffer->description = $request->description; // Agrega otros campos según sea necesario
        $jobOffer->company_id = $request->company_id; // Asegúrate de que el campo 'company_id' esté en el formulario
        $jobOffer->salary = $request->salary;
        $jobOffer->location = $request->location;

        $jobOffer->save();
        return $jobOffer; // O redirige a otra página según tu necesidad
    }
} 