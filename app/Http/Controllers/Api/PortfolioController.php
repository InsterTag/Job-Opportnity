<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios=Portfolio::included()->filter()->sort()->getOrPaginate();
        return response()->json($portfolios);
    }

    public function store(Request $request)
    {
        $created = Portfolio::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Portfolio::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Portfolio::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Portfolio::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
