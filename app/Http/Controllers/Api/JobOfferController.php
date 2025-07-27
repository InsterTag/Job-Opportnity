<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOffer;

class JobOfferController extends Controller
{
    public function index()
    {
        $joboffers=JobOffer::included()->filter()->sort()->getOrPaginate();
        return response()->json($joboffers);
    }

    public function store(Request $request)
    {
        $created = JobOffer::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = JobOffer::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = JobOffer::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = JobOffer::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
