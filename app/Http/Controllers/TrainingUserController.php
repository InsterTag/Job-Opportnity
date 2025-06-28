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
        $relation = new TrainingUser();
        $relation->training_id = $request->training_id;
        $relation->unemployed_id = $request->unemployed_id;
        $relation->save();

        return $relation;
    }
}
