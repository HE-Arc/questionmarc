<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with(['author', 'module']);

        // Récupérer la filière et l'année de l'utilisateur connecté
        $userFiliere = Auth::check() ? Auth::user()->filiere : null;
        $userYear = Auth::check() ? Auth::user()->year : null;

        // Filtre par module
        if ($request->filled('module')) {
            $query->whereHas('module', function ($q) use ($request) {
                $q->where('name', $request->input('module'));
            });
        }

        // Filtre par filière
        if ($request->filled('filiere')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('filiere', $request->input('filiere'));
            });
        } elseif ($userFiliere) {
            $query->whereHas('author', function ($q) use ($userFiliere) {
                $q->where('filiere', $userFiliere);
            });
        }

        // Filtre par année
        if ($request->filled('year')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('year', $request->input('year'));
            });
        } elseif ($userYear) {
            $query->whereHas('author', function ($q) use ($userYear) {
                $q->where('year', $userYear);
            });
        }

        // Filtre par statut "résolu"
        if ($request->filled('resolved')) {
            $query->where('resolved', $request->input('resolved'));
        }

        // Tri par date de création
        $query->orderBy('created_date', 'desc');

        $questions = $query->paginate(5);

        // Récupérer les modules avec le nombre de questions
        $modules = Module::withCount('questions')->get();
        $filieres = User::select('filiere')->distinct()->get();
        $years = User::select('year')->distinct()->get();

        return view('index', [
            'questions' => $questions,
            'modules' => $modules,
            'filieres' => $filieres,
            'years' => $years,
            'selectedModule' => $request->input('module'),
            'selectedFiliere' => $request->input('filiere', $userFiliere),
            'selectedYear' => $request->input('year', $userYear),
            'selectedResolved' => $request->input('resolved'),
        ]);
    }
}
