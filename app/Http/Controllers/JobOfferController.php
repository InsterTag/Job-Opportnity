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
        $jobOffer->title = $request->title; 
        $jobOffer->description = $request->description; 
        $jobOffer->requirements = $request->requirements;
        $jobOffer->salary = $request->salary;
        $jobOffer->publication_date = $request->publication_date;
        $jobOffer->completion_date = $request->completion_date;

        $jobOffer->save();
        return $jobOffer; 
    }
    public function consultasJO()
    {
        $jobOffer = JobOffer::find(1); // Busca la oferta con ID 1
        return $jobOffer->company; // Devuelve las ofertas de trabajo de la compañía
    }
} 