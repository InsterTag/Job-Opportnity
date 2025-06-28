<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;
use App\Models\Classified;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Asegurarse que es un desempleado
        if (!$user || !$user->unemployed) {
            abort(403, 'Solo los desempleados pueden ver sus favoritos.');
        }

        $favoriteJobOffers = $user->unemployed->favoriteJobOffers()->with('company', 'categories')->get();
        $favoriteClassifieds = $user->unemployed->favoriteClassifieds()->with('company', 'unemployed', 'categories')->get();

        return view('favorites.index', compact('favoriteJobOffers', 'favoriteClassifieds'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:joboffer,classified',
            'id' => 'required|integer',
        ]);

        $user = auth()->user();

        if (!$user->unemployed) {
            return response()->json(['error' => 'Solo los desempleados pueden marcar favoritos.'], 403);
        }

        $unemployed = $user->unemployed;

        // Obtener modelo dinámico
        $modelClass = $request->type === 'joboffer' ? JobOffer::class : Classified::class;
        $item = $modelClass::findOrFail($request->id);

        $existing = $unemployed->favorites()
            ->where('favoritable_id', $item->id)
            ->where('favoritable_type', $modelClass)
            ->first();

        if ($existing) {
            $existing->delete();
            $isFavorite = false;
        } else {
            $unemployed->favorites()->create([
                'favoritable_id' => $item->id,
                'favoritable_type' => $modelClass,
            ]);
            $isFavorite = true;
        }

        return response()->json(['isFavorite' => $isFavorite]);
    }
}
