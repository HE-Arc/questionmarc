<x-app-layout>
    <div class="flex flex-col items-center">
        <div class="flex content-center justify-center w-full"> <!-- Limite la largeur maximale -->
            <!-- Form filters -->
            <form method="GET" action="{{ route('welcome') }}" class="w-full p-6">
                <div class="flex flex-col gap-4 md:flex-row md:flex-wrap justify-center"> <!-- Centrer les filtres -->
                    <!-- Filter by filiere -->
                    <select id="filiere-select" name="filiere" class="rounded-md">
                        <option value="">Toutes les filières</option>
                        @foreach ($filieres as $filiere)
                            <option value="{{ $filiere->filiere_name }}"
                                {{ $selectedFiliere == $filiere->filiere_name ? 'selected' : '' }}>
                                {{ $filiere->filiere_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter by year -->
                    <select id="year-select" name="year" class="rounded-md">
                        <option value="">Toutes les années</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter by module -->
                    <select id="module-select" name="module" class="rounded-md">
                        <option value="">Tous les modules</option>
                        <!-- Javascript auto input here -->
                    </select>

                    <!-- Filter by resolved questions -->
                    <select id="resolved-select" name="resolved" class="rounded-md">
                        <option value="">Toutes les questions</option>
                        <option value="1" {{ $selectedResolved == '1' ? 'selected' : '' }}>Résolues</option>
                        <option value="0" {{ $selectedResolved == '0' ? 'selected' : '' }}>Non résolues</option>
                    </select>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
                </div>
            </form>
        </div>


        <!-- questions -->
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 p-6">
                @forelse ($questions as $question)
                    <x-question :question="$question" :classic="true"></x-question>
                @empty
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-gray-900">Aucune question trouvée</h3>
                        </div>
                    </div>
                @endforelse
            </div>
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
