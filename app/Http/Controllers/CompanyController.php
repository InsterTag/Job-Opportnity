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
        $company->name = $request->name; // Asegúrate de que el campo 'name' esté en el formulario
        $company->address = $request->address; // Agrega otros campos según sea necesario
        $company->email = $request->email;
        $company->phone = $request->phone;

        $company->save();
        return $company; // O redirige a otra página según tu necesidad
    }

    public function consultasCom()
    {
        $company = Company::find(1); // Busca la compañía con ID 1
        return $company->jobOffer; // Devuelve las ofertas de trabajo de la compañía
    }
} 

