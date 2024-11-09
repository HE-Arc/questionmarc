<x-app-layout>
    <div class="flex flex-col items-center">
        <!-- Formulaire de filtres -->
        <form method="GET" action="{{ route('welcome') }}" class="w-full p-6">
            <div class="flex flex-wrap gap-4">
                <!-- Filtre par module -->
                <select name="module" class="border border-gray-300 rounded p-2 flex-1">
                    <option value="">Tous les modules</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->name }}" {{ $selectedModule == $module->name ? 'selected' : '' }}>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
                <!-- Filtre par filière -->
                <select name="filiere" class="border border-gray-300 rounded p-2 flex-1">
                    <option value="">Toutes les filières</option>
                    @foreach ($filieres as $filiere)
                        <option value="{{ $filiere->filiere }}"
                            {{ $selectedFiliere == $filiere->filiere ? 'selected' : '' }}>
                            {{ $filiere->filiere }}
                        </option>
                    @endforeach
                </select>
                <!-- Filtre par année -->
                <select name="year" class="border border-gray-300 rounded p-2 flex-1">
                    <option value="">Toutes les années</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>
                <!-- Bouton de soumission -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
            </div>
        </form>

        <!-- Affichage des questions -->
        <div class="grid grid-cols-1 gap-6 max-w-xl flex-1 p-6">
            @forelse ($questions as $question)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                                <img src="https://robohash.org/{{ $question->author->username }}.png?size=50x50&set=set{{ $question->author->profile_picture_type }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="ml-2 font-medium dark:text-black">
                                <div>{{ $question->author->username }}</div>
                                <div class="text-sm text-gray-500">Créé le {{ $question->created_date }}</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <h3 class="text-lg font-bold text-gray-900">{{ $question->title }}</h3>
                        </div>
                        <div class="text-gray-700 break-words">
                            {{ $question->content }}
                        </div>
                    </div>
                    <!-- Filiere and Module at the bottom with dynamic colored tags -->
                    <div class="mt-4 flex gap-2 justify-start">
                        <span class="px-3 py-1 rounded-full text-sm text-white"
                            style="background-color: {{ $dynamicColor($question->author->filiere) }}">
                            {{ $question->author->filiere }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm text-white truncate max-w-xs"
                            style="background-color: {{ $dynamicColor($question->module->name) }}">
                            {{ $question->module->name }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div class="text-center">
                        <h3 class="text-lg font-bold text-gray-900">Aucunes questions trouvées</h3>
                    </div>


                @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex flex-col items-center">
            {!! $questions->appends(request()->input())->links() !!}
        </div>
    </div>
</x-app-layout>
