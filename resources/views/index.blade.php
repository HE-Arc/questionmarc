<x-app-layout>
    <div class="flex flex-col items-center">
        <div class="flex content-center justify-center w-full"> <!-- Limite la largeur maximale -->
            <!-- Form filters -->
            <form method="GET" action="{{ route('welcome') }}" class="w-full p-6">
                <div class="flex flex-col gap-4 md:flex-row md:flex-wrap justify-center"> <!-- Centrer les filtres -->
                    <!-- Filter by filiere -->
                    <select id="filiere-select" name="filiere" class="...">
                        <option value="">Toutes les filières</option>
                        @foreach ($filieres as $filiere)
                            <option value="{{ $filiere->filiere_name }}" {{ $selectedFiliere == $filiere->filiere_name ? 'selected' : '' }}>
                                {{ $filiere->filiere_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter by year -->
                    <select id="year-select" name="year" class="...">
                        <option value="">Toutes les années</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter by module -->
                    <select id="module-select" name="module" class="...">
                        <option value="">Tous les modules</option>
                        <!-- Javascript auto input here -->
                    </select>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
                </div>
            </form>
        </div>


        <!-- questions -->
        <div class="grid grid-cols-1 gap-6 max-w-full flex-1 p-6">
            @forelse ($questions as $question)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between cursor-pointer" onclick="window.location='{{ route('questions.show', $question->id) }}'">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
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
                    <div class="mt-4 flex gap-2 justify-start">
                        <span class="px-3 py-1 rounded-full text-sm text-white"
                            style="background-color: {{ $dynamicColor($question->module->filiere_name) }}">
                            {{ $question->module->filiere_name }}
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
                        <h3 class="text-lg font-bold text-gray-900">Aucune question trouvée</h3>
                    </div>
                </div>
            @endforelse
        </div>


        <!-- Pagination -->
        <div class="mb-4 flex flex-col items-center">
            {!! $questions->appends(request()->input())->links() !!}
        </div>
    </div>
    <script>
        window.appData = {
            selectedModule: @json($selectedModule ?? ''),
            apiModulesUrl: @json($apiModulesUrl),
        };
    </script>

    <script src="{{ asset('js/filters.js') }}"></script>
</x-app-layout>
