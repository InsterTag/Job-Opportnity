<?php

namespace App\Http\Controllers;
use App\Models\TrainingUser;
use Illuminate\Http\Request;

class TrainingUserController extends Controller
{
    public function create() {
        return view('TrainingUser-form');
    }

    public function agg_training_user(Request $request) {
        $validatedData = $request->validate([
            'training_id' => 'required|integer|exists:trainings,id',
            'unemployed_id' => 'required|integer|exists:unemployeds,id'
        ]);

        $relation = new TrainingUser();
        $relation->training_id = $validatedData['training_id'];
        $relation->unemployed_id = $validatedData['unemployed_id'];
        $relation->save();

        return $relation;
    }
}