<?php

namespace App\Http\Controllers;

use App\Models\FavoriteOffer;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteOfferController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->unemployed) {
            return redirect()->route('job-offers.index')
                            ->with('error', 'Solo los cesantes pueden ver ofertas favoritas.');
        }

        $favoriteOffers = JobOffer::whereHas('favoriteUnemployed', function($query) use ($user) {
                                $query->where('unemployed_id', $user->unemployed->id);
                            })
                            ->with(['company', 'categories'])
                            ->paginate(10);

        return view('job-offers.favorites', compact('favoriteOffers'));
    }

    public function toggle(Request $request, JobOffer $jobOffer)
    {
        $validatedData = $request->validate([
            'unemployed_id' => 'sometimes|integer|exists:unemployeds,id',
            'job_offer_id' => 'required|integer|exists:job_offers,id'
        ]);

        $user = Auth::user();

        if (!$user || !$user->unemployed) {
            return response()->json([
                'success' => false,
                'message' => 'Solo los cesantes pueden marcar ofertas como favoritas.'
            ], 403);
        }

        $exists = FavoriteOffer::where('unemployed_id', $user->unemployed->id)
                                ->where('job_offer_id', $jobOffer->id)
                                ->exists();

        if ($exists) {
            FavoriteOffer::where('unemployed_id', $user->unemployed->id)
                        ->where('job_offer_id', $jobOffer->id)
                        ->delete();
            $isFavorite = false;
            $message = 'Oferta eliminada de favoritos';
        } else {
            FavoriteOffer::create([
                'unemployed_id' => $user->unemployed->id,
                'job_offer_id' => $jobOffer->id
            ]);
            $isFavorite = true;
            $message = 'Oferta añadida a favoritos';
        }

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