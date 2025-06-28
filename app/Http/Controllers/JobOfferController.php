<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class JobOfferController extends Controller
{
    // Mostrar listado de ofertas con filtros aplicables
    public function index(Request $request) {
        $query = JobOffer::with(['company', 'categories']);

        // Filtro por palabra clave en título o descripción
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filtro por ubicación
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Filtro por tipo de oferta (tiempo completo, parcial, etc.)
        if ($request->filled('offer_type')) {
            $query->where('offer_type', $request->offer_type);
        }

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Paginación de resultados
        $jobOffers = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('job-offers.index', compact('jobOffers', 'categories'));
    }

    // Guardar oferta (desde formulario personalizado)
    public function agg_job_offer(Request $request) {
        $offer = new JobOffer();
        $offer->company_id = $request->company_id;
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->salary = $request->salary;
        $offer->location = $request->location;
        $offer->geolocation = $request->geolocation;
        $offer->offer_type = $request->offer_type;
        $offer->save();

        return $offer;
    }

    // Mostrar formulario de creación de oferta
    public function create()
    {
        $categories = Category::all();
        return view('job-offers.create', compact('categories'));
    }

    // Guardar nueva oferta laboral
    public function store(Request $request)
    {
        $jobOffer = new JobOffer($request->all());
        $jobOffer->company_id = Auth::user()->company->id;
        $jobOffer->save();

        // Asociar categorías seleccionadas
        $jobOffer->categories()->attach($request->categories);

        return redirect()->route('job-offers.index')
                         ->with('success', 'Oferta laboral creada exitosamente.');
    }

    // Mostrar detalles de una oferta
    public function show(JobOffer $jobOffer)
    {
        return view('job-offers.show', compact('jobOffer'));
    }

    // Mostrar formulario de edición
    public function edit(JobOffer $jobOffer)
    {
        $categories = Category::all();
        return view('job-offers.edit', compact('jobOffer', 'categories'));
    }

    // Actualizar una oferta existente
    public function update(Request $request, JobOffer $jobOffer)
    {
        $jobOffer->update($request->all());

        // Sincronizar nuevas categorías
        $jobOffer->categories()->sync($request->categories);

        return redirect()->route('job-offers.show', $jobOffer)
                         ->with('success', 'Oferta laboral actualizada exitosamente.');
    }

    // Eliminar una oferta laboral
    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();

        return redirect()->route('job-offers.index')
                         ->with('success', 'Oferta laboral eliminada exitosamente.');
    }
}