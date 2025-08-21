<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    // Mostrar entrevistas relacionadas a una postulación (candidato y empresa)
    public function index($applicationId)
    {
        $application = JobApplication::with('jobOffer.company', 'unemployed.user')->findOrFail($applicationId);

        // Permisos básicos: el candidato o la empresa propietaria pueden ver
        $user = Auth::user();
        if(!$user) abort(403);

        $isCompanyOwner = $user->isCompany() && $user->company->id === $application->jobOffer->company_id;
        $isCandidate = $user->isUnemployed() && $user->unemployed->id === $application->unemployed_id;
        if(!($isCompanyOwner || $isCandidate)) abort(403);

        $interviews = Interview::where('job_application_id', $applicationId)->orderBy('scheduled_at','asc')->get();

        return view('interviews.index', compact('application','interviews'));
    }

    // Crear nueva entrevista (solo empresa)
    public function store(Request $request, $applicationId)
    {
        $application = JobApplication::with('jobOffer.company')->findOrFail($applicationId);
        $user = Auth::user();
        if(!$user || !($user->isCompany() && $user->company->id === $application->jobOffer->company_id)) {
            abort(403);
        }

        $data = $request->validate([
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:5',
            'mode' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data['job_application_id'] = $applicationId;
        $data['status'] = 'scheduled';

    $interview = Interview::create($data);

    // No cambiar el estado de la postulación aquí: mantener el estado (por ejemplo 'accepted')
    // para evitar que revirtiendo a 'pending' al programar/editar horarios.

    // Opcional: notificar al candidato (no implementado aquí)

    return redirect()->back()->with('success','Entrevista programada correctamente.');
    }
}
