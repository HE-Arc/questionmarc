<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class SearchBar extends Component
{
    public $search = '';

    public function render()
    {
        $questions = [];
        $this->search = trim($this->search);

        if (strlen($this->search) >= 1) {
            // Sépare les mots par les espaces
            $words = preg_split('/\s+/', $this->search);

            // Construire une requête fulltext en mode booléen
            // Sans le préfixe '+' pour que les mots soient facultatifs
            // Ajout de '*' à la fin de chaque mot pour des recherches plus flexibles (termes partiels)
            $searchQuery = '';
            foreach ($words as $word) {
                $searchQuery .= $word . '* ';
            }
            $searchQuery = trim($searchQuery);

            // Exécution de la requête fulltext en mode booléen
            // On trie par pertinence, ceux qui matchent le plus de mots ressortiront en premier
            $questions = Question::whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", [$searchQuery])
                ->orderByRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE) DESC", [$searchQuery])
                ->take(10)
                ->get();
        }

        return view('livewire.search-bar', [
            'questions' => $questions
        ]);
    }

    public function submitSearch()
    {
        // Rediriger vers le controller avec le paramètre search
        return redirect()->route('welcome', ['search' => $this->search]);
    }
}


