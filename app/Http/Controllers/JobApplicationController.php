<?php
namespace App\Http\Controllers;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;
    // Formulario de postulación
    public function create(Request $request)
    {
        return view('job-applications.create', [
            'unemployed_id' => $request->unemployed_id ?? null,
            'job_offer_id' => $request->job_offer_id ?? null,
        ]);
    }

    // Guardar postulación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'nullable|string|max:2000',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'unemployed_id' => 'required|exists:unemployeds,id',
            'job_offer_id' => 'required|exists:job_offers,id',
        ]);

        // Prevenir doble postulación
        $exists = JobApplication::where('unemployed_id', $validated['unemployed_id'])
            ->where('job_offer_id', $validated['job_offer_id'])
            ->exists();
        if ($exists) {
            return back()->with('error', 'Ya has postulado a esta oferta.');
        }

        $application = new JobApplication();
        $application->message = $validated['message'] ?? null;
        $application->unemployed_id = $validated['unemployed_id'];
        $application->job_offer_id = $validated['job_offer_id'];
        $application->status = 'pending';

        // Subida de CV
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('cvs', $filename, 'public');
            $application->cv_path = $path;
        }

        $application->save();
        return back()->with('success', 'Postulación enviada correctamente.');
    }

    // Listado para empresa
    public function indexCompany(Request $request)
    {
        $companyId = auth()->user()->company->id;

        // Base query for company applications
        $baseQuery = JobApplication::whereHas('jobOffer', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        });

        // Counters (total and by status)
        $totalCount = (clone $baseQuery)->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $acceptedCount = (clone $baseQuery)->where('status', 'accepted')->count();
        $rejectedCount = (clone $baseQuery)->where('status', 'rejected')->count();

        // Apply filters and pagination
        $applications = $baseQuery
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->with(['unemployed.user', 'jobOffer.company'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('job-applications.index-company', compact('applications', 'totalCount', 'pendingCount', 'acceptedCount', 'rejectedCount'));
    }

    // Listado para cesante
    public function indexUnemployed(Request $request)
    {
        $unemployedId = auth()->user()->unemployed->id;
        $applications = JobApplication::where('unemployed_id', $unemployedId)
        ->when($request->status, fn($q) => $q->where('status', $request->status))
        ->with(['jobOffer.company'])
        ->orderByDesc('created_at')
        ->paginate(10);
        return view('job-applications.index-unemployed', compact('applications'));
    }

    // Actualizar estado de postulación
    public function updateStatus(Request $request, $id)
    {
        $application = JobApplication::findOrFail($id);
        $this->authorize('updateStatus', $application);
        $status = strtolower($request->input('status'));
        $map = [
            'pendiente' => 'pending',
            'pending' => 'pending',
            'aceptada' => 'accepted',
            'aceptado' => 'accepted',
            'accepted' => 'accepted',
            'rechazada' => 'rejected',
            'rechazado' => 'rejected',
            'rejected' => 'rejected',
        ];
    $application->status = $map[$status] ?? 'pending';
    $application->save();
    // Notificar al candidato (puedes usar Notification aquí)
    // $application->unemployed->user->notify(new StatusChangedNotification($application));
    return back()->with('success', 'Estado actualizado.');
    }

    // Descargar CV
    public function downloadCv($id)
    {
        $application = JobApplication::findOrFail($id);
        $this->authorize('downloadCv', $application);
        if (!$application->cv_path) {
            abort(404);
        }
    $filename = $application->unemployed->user->name . '_' . $application->jobOffer->title . '.' . pathinfo($application->cv_path, PATHINFO_EXTENSION);
    $filePath = \Storage::disk('public')->path($application->cv_path);
    return response()->download($filePath, $filename);
    }
}
