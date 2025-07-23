<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Unemployed;
use App\Models\Classified;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassifiedController extends Controller
{
    public function index(Request $request)
    {
        $query = Classified::with(['company', 'unemployed', 'categories']);

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }

        $classifieds = $query->latest()->paginate(10);

        return view('classifieds.index', compact('classifieds'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('classifieds.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = Auth::user();

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'geolocation' => $request->geolocation,
                'salary' => $request->salary,
            ];

            if ($user->type === 'company') {
                $data['company_id'] = $user->company->id;
            } elseif ($user->type === 'unemployed') {
                $data['unemployed_id'] = $user->unemployed->id;
            }

            $classified = Classified::create($data);

            if ($request->has('categories')) {
                $classified->categories()->attach($request->categories);
            }

            return redirect()->route('classifieds.index', $classified->id)
                             ->with('success', 'Clasificado creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $classified = Classified::with(['company', 'unemployed', 'categories'])->findOrFail($id);
        $isFavorite = false;

        if (Auth::check() && Auth::user()->type === 'unemployed') {
            $isFavorite = Auth::user()->unemployed->favoriteClassifieds()->where('classified_id', $id)->exists();
        }

        return view('classifieds.index', compact('classified', 'isFavorite'));
    }

    public function edit($id)
    {
        $classified = Classified::findOrFail($id);
        $categories = Category::all();

        if (Auth::user()->type === 'company' && $classified->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        return view('classifieds.edit', compact('classified', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $classified = Classified::findOrFail($id);

        if (Auth::user()->type === 'company' && $classified->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        $validator = Validator::make($request->all(), $this->validationRules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $classified->update([
    'title' => $request->title,
    'description' => $request->description,
    'location' => $request->location,
    'geolocation' => $request->geolocation,
    'salary' => $request->salary,
]);


            if ($request->has('categories')) {
                $classified->categories()->sync($request->categories);
            }

            return redirect()->route('classifieds.index', $classified->id)
                             ->with('success', 'Clasificado actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $classified = Classified::findOrFail($id);

        if (Auth::user()->type === 'company' && $classified->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        $classified->delete();

        return redirect()->route('classifieds.index')->with('success', 'Clasificado eliminado');
    }

    public function byLocation(Request $request)
    {
        $request->validate(['location' => 'required|string']);

        $classifieds = Classified::where('location', 'like', '%' . $request->location . '%')
            ->with(['company', 'unemployed', 'categories'])
            ->get();

        return response()->json($classifieds);
    }

    private function validationRules()
{
    return [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'geolocation' => 'required|string|max:255',
        'salary' => 'nullable|numeric|min:0',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
    ];
}

}
