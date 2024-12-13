<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';
    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 1) {
            $results = \App\Models\Question::where('title', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.search-bar', [
            'questions' => $results
        ]);
    }
}
