<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function create() {
        return view('Company-form');
    }

    public function agg_company(Request $request) {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $company = new Company();
        $company->user_id = Auth::id(); // forma correcta y más simple que Auth::user()->id
        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->save();

        return redirect()->route('home')->with('success', 'Empresa registrada correctamente.');
    }
}
