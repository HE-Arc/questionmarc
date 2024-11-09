<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with(['author', 'module']);

        // Filter by module
        if ($request->filled('module')) {
            $query->whereHas('module', function ($q) use ($request) {
                $q->where('name', $request->input('module'));
            });
        } else {
            // Filter by filiere and year if modules not available
            $query->whereHas('module', function ($q) use ($request) {
                if ($request->filled('filiere')) {
                    $q->where('filiere_name', $request->input('filiere'));
                }
                if ($request->filled('year')) {
                    $q->where('year', $request->input('year'));
                }
            });
        }

        // Filter by status "resolved"
        if ($request->filled('resolved')) {
            $query->where('resolved', $request->input('resolved'));
        }

        // Filter by created date
        $query->orderBy('created_date', 'desc');

        $questions = $query->paginate(5);

        // Get all modules, filieres and years
        $modules = Module::withCount('questions')->get();
        $filieres = Module::select('filiere_name')->distinct()->get();
        $years = Module::select('year')->distinct()->get();

        // Passer l'URL de l'API des modules à la vue
        $apiModulesUrl = route('api.modules');

        return view('index', [
            'questions' => $questions,
            'modules' => $modules,
            'filieres' => $filieres,
            'years' => $years,
            'selectedModule' => $request->input('module'),
            'selectedFiliere' => $request->input('filiere'),
            'selectedYear' => $request->input('year'),
            'selectedResolved' => $request->input('resolved'),
            'apiModulesUrl' => $apiModulesUrl,
        ]);
    }

    public function getModules(Request $request)
    {
        $filiere = $request->input('filiere');
        $year = $request->input('year');

        $query = Module::query();

        if ($filiere) {
            $query->where('filiere_name', $filiere);
        }

        if ($year) {
            $query->where('year', $year);
        }

        $modules = $query->orderBy('name')->get();

        return response()->json($modules);
    }


}
