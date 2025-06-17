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

        if ($request->filled('offer_type')) {
            $query->where('offer_type', $request->offer_type);
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

    public function agg_job_offer(Request $request) {
        $validatedData = $request->validate([
            'company_id' => 'required|integer|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'geolocation' => 'nullable|string',
            'offer_type' => 'required|in:full_time,part_time,contract,temporary,freelance',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id'
        ]);

        $offer = new JobOffer();
        $offer->company_id = $validatedData['company_id'];
        $offer->title = $validatedData['title'];
        $offer->description = $validatedData['description'];
        $offer->salary = $validatedData['salary'];
        $offer->location = $validatedData['location'];
        $offer->geolocation = $validatedData['geolocation'];
        $offer->offer_type = $validatedData['offer_type'];
        $offer->save();

        if (!empty($validatedData['categories'])) {
            $offer->categories()->attach($validatedData['categories']);
        }

        return $offer;
    }

    public function create() {
        $categories = Category::all();
        return view('job-offers.create', compact('categories'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'geolocation' => 'nullable|string',
            'offer_type' => 'required|in:full_time,part_time,contract,temporary,freelance',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id'
        ]);

        $jobOffer = new JobOffer($validatedData);
        $jobOffer->company_id = Auth::user()->company->id;
        $jobOffer->save();

        if (!empty($validatedData['categories'])) {
            $jobOffer->categories()->attach($validatedData['categories']);
        }

        return redirect()->route('job-offers.index')->with('success', 'Oferta laboral creada exitosamente.');
    }

    public function show(JobOffer $jobOffer) {
        return view('job-offers.show', compact('jobOffer'));
    }

    public function edit(JobOffer $jobOffer) {
        $categories = Category::all();
        return view('job-offers.edit', compact('jobOffer', 'categories'));
    }

    public function update(Request $request, JobOffer $jobOffer) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'geolocation' => 'nullable|string',
            'offer_type' => 'required|in:full_time,part_time,contract,temporary,freelance',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id'
        ]);

        $jobOffer->update($validatedData);

        if (isset($validatedData['categories'])) {
            $jobOffer->categories()->sync($validatedData['categories']);
        }

        return redirect()->route('job-offers.show', $jobOffer)->with('success', 'Oferta laboral actualizada exitosamente.');
    }

    public function destroy(JobOffer $jobOffer) {
        $jobOffer->delete();
        return redirect()->route('job-offers.index')->with('success', 'Oferta laboral eliminada exitosamente.');
    }
}