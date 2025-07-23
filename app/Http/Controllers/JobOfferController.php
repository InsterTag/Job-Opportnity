<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class JobOfferController extends Controller
{
    public function index(Request $request) {
        $query = JobOffer::with(['company', 'categories']);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $jobOffers = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('job-offers.index', compact('jobOffers', 'categories'));
    }

    // Guardar desde AJAX personalizado
    public function agg_job_offer(Request $request) {
        $offer = new JobOffer();
        $offer->company_id = $request->company_id;
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->salary = $request->salary;
        $offer->location = $request->location;
        $offer->geolocation = $request->geolocation;
        $offer->save();

        return $offer;
    }

    public function create()
    {
        $categories = Category::all();
        return view('job-offers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $jobOffer = new JobOffer($request->except('offer_type')); // Excluir campo eliminado
        $jobOffer->company_id = Auth::user()->company->id;
        $jobOffer->save();

        $jobOffer->categories()->attach($request->categories);

        return redirect()->route('job-offers.index')
                         ->with('success', 'Oferta laboral creada exitosamente.');
    }

    public function show(JobOffer $jobOffer)
    {
        return redirect()->route('job-offers.index'); // Cambiado como pediste
    }

    public function edit(JobOffer $jobOffer)
    {
        $categories = Category::all();
        return view('job-offers.edit', compact('jobOffer', 'categories'));
    }

    public function update(Request $request, JobOffer $jobOffer)
    {
        $jobOffer->update($request->except('offer_type')); // Excluir campo eliminado
        $jobOffer->categories()->sync($request->categories);

        return redirect()->route('job-offers.show', $jobOffer)
                         ->with('success', 'Oferta laboral actualizada exitosamente.');
    }

    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();

        return redirect()->route('job-offers.index')
                         ->with('success', 'Oferta laboral eliminada exitosamente.');
    }
}
