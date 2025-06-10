<?php

namespace App\Http\Controllers;

use App\Models\FavoriteOffer;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteOfferController extends Controller
{
    // Mostrar las ofertas favoritas del usuario cesante autenticado
    public function index()
    {
        $user = Auth::user();

        // Verificar que sea un usuario cesante
        if (!$user || !$user->unemployed) {
            return redirect()->route('job-offers.index')
                            ->with('error', 'Solo los cesantes pueden ver ofertas favoritas.');
        }

        // Obtener las ofertas favoritas del cesante
        $favoriteOffers = JobOffer::whereHas('favoriteUnemployed', function($query) use ($user) {
                                $query->where('unemployed_id', $user->unemployed->id);
                            })
                            ->with(['company', 'categories'])
                            ->paginate(10);

        return view('job-offers.favorites', compact('favoriteOffers'));
    }

    // Agregar o quitar una oferta de los favoritos del usuario
    public function toggle(Request $request, JobOffer $jobOffer)
    {
        $user = Auth::user();

        // Solo cesantes pueden marcar favoritos
        if (!$user || !$user->unemployed) {
            return response()->json([
                'success' => false,
                'message' => 'Solo los cesantes pueden marcar ofertas como favoritas.'
            ]);
        }

        // Verificar si ya está marcada como favorita
        $exists = FavoriteOffer::where('unemployed_id', $user->unemployed->id)
                                ->where('job_offer_id', $jobOffer->id)
                                ->exists();

        if ($exists) {
            // Si ya es favorita, eliminarla
            FavoriteOffer::where('unemployed_id', $user->unemployed->id)
                        ->where('job_offer_id', $jobOffer->id)
                        ->delete();
            $isFavorite = false;
            $message = 'Oferta eliminada de favoritos';
        } else {
            // Si no es favorita, agregarla
            FavoriteOffer::create([
                'unemployed_id' => $user->unemployed->id,
                'job_offer_id' => $jobOffer->id
            ]);
            $isFavorite = true;
            $message = 'Oferta añadida a favoritos';
        }

        // Responder en JSON si se espera desde el frontend (ej: AJAX)
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'isFavorite' => $isFavorite,
                'message' => $message
            ]);
        }

        return back()->with('success', $message);
    }
}
