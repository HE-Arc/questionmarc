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
        $query = Question::with(['author', 'module'])
            ->withCount([
                'answers as upvotes_total' => function ($query) {
                    // Calculer la somme des upvotes pour toutes les réponses associées
                    $query->select(DB::raw('SUM((SELECT COUNT(*) FROM answers_users_upvote WHERE answers_users_upvote.answer_id = answers.id))'));
                }
            ]);

        // Appliquer les filtres existants
        if ($request->filled('module')) {
            $query->whereHas('module', function ($q) use ($request) {
                $q->where('name', $request->input('module'));
            });
        } else {
            $query->whereHas('module', function ($q) use ($request) {
                if ($request->filled('filiere')) {
                    $q->where('filiere_name', $request->input('filiere'));
                }
                if ($request->filled('year')) {
                    $q->where('year', $request->input('year'));
                }
            });
        }

        if ($request->filled('resolved')) {
            $query->where('resolved', $request->input('resolved'));
        }

        $query->orderBy('created_date', 'desc');

        $questions = $query->paginate(5);

        // Passer les données nécessaires à la vue
        $modules = Module::withCount('questions')->get();
        $filieres = Module::select('filiere_name')->distinct()->get();
        $years = Module::select('year')->distinct()->get();
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
