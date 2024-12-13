<!-- resources/views/livewire/search-bar.blade.php -->
<div class="relative">
    <form class="d-flex" role="search">
        <!-- Champ de Recherche, on le setup à live, pour envoyer automatiquement les requêtes dans SearchBar.php
            l'idée est de mettre un "délai" de 300ms, puor pas surchargé les requêtes asyncrhone. -->
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Chercher une question..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </form>
    @if (!empty($search))
        <div class="absolute z-50 mt-1 w-full bg-white rounded-md shadow-lg">
            @if (count($questions) > 0)
                @foreach ($questions as $question)
                    <div class="{{ $question->resolved ? 'bg-green-50' : 'bg-white' }} shadow-sm rounded-md p-4 flex items-start space-x-4 cursor-pointer hover:bg-gray-100 transition-colors duration-200"
                        onclick="window.location.href = '{{ route('questions.show', $question) }}'">

                        <!-- Image de l'Utilisateur -->
                        <div class="relative w-8 h-8 bg-gray-100 rounded-full flex-shrink-0">
                            <img src="https://robohash.org/{{ $question->author->username }}.png?size=40x40&set=set{{ $question->author->profile_picture_type }}"
                                alt="{{ $question->author->username }}" class="w-full h-full object-cover rounded-full">
                        </div>

                        <!-- Informations de la Question -->
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
                                <!-- Titre de la Question -->
                                <h4 class="text-sm font-semibold text-gray-900 hover:text-indigo-600 truncate">
                                    {{ \Illuminate\Support\Str::limit($question->title, 50, '...') }}
                                </h4>
                                <!-- Date de Création -->
                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-2">
                                    Créé le {{ \Carbon\Carbon::parse($question->created_at)->format('d/m/Y') }}
                                </span>
                            </div>
                            <!-- Nom de l'Utilisateur (optionnel) -->
                            <div class="text-xs text-gray-600 mt-1">
                                Par {{ $question->author->username }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <span class="block px-4 py-2 text-gray-800">Aucun résultat pour "{{ $search }}"</span>
            @endif
        </div>
    @endif
</div>
