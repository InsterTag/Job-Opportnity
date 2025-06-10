<?php

namespace App\Http\Controllers;


use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    

    // Mostrar formulario de creación
    public function create()
    {
        return view('company-form');
    }

    public function agg_company(Request $request) {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
    }
    // Guardar nueva empresa
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $company = new Company();
        $company->user_id = Auth::id(); // forma correcta y más simple que Auth::user()->id
        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->save();

        return redirect()->route('home')->with('success', 'Empresa registrada correctamente.');

        return redirect()->route('home')
                        ->with('success', 'Empresa registrada correctamente.');
    }

    // Mostrar detalles de una empresa
    public function show($id)
    {
        $company = Company::with(['user', 'jobOffers'])->findOrFail($id);
        return view('companies.show', compact('company'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        
        // Verificar que el usuario sea el dueño de la empresa
        if ($company->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar esta empresa.');
        }
        
        return view('companies.edit', compact('company'));
    }

    // Actualizar empresa
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20'
        ]);

        $company = Company::findOrFail($id);
        
        // Verificar que el usuario sea el dueño de la empresa
        if ($company->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar esta empresa.');
        }

        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->location = $request->location;
        $company->website = $request->website;
        $company->phone = $request->phone;
        $company->save();

        return redirect()->route('home')
                        ->with('success', 'Empresa actualizada correctamente.');
    }

    // Eliminar empresa
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        
        // Verificar que el usuario sea el dueño de la empresa
        if ($company->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para eliminar esta empresa.');
        }

        $company->delete();

        return redirect()->route('home')
                        ->with('success', 'Empresa eliminada correctamente.');
    }
}
