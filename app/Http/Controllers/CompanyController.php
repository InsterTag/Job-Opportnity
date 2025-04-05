<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('company'); 
    }

    public function agg_company(Request $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->description = $request->description;
        $company->location = $request->location;
        $company->type_of_company = $request->type_of_company;
        $company->contact = $request->contact;

        $company->save();
        return $company;
    }

    public function consultasCom()
    {
        $company = Company::find(1); // Busca la compañía con ID 1
        return $company->jobOffers; // Devuelve las ofertas de trabajo de la compañía
    }
} 

