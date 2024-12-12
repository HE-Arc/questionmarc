<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="p-6">
            <!-- Photo de profil et informations utilisateur -->
            <div class="flex flex-col items-center mb-6">
                <img src="https://robohash.org/{{ $user->username }}.png?size=150x150&set=set{{ $user->profile_picture_type }}"
                     class="w-32 h-32 rounded-full bg-white mb-4">
                <div class="grid grid-cols-3 gap-4 w-full text-center">
                    <p class="font-semibold"><strong>Filière :</strong><br> {{ $user->filiere }}</p>
                    <p class="font-semibold text-xl"><strong>{{ $user->username }}</strong></p>
                    <p class="font-semibold"><strong>Année :</strong><br> {{ $user->year }}</p>
                </div>
            </div>

            <!-- Liste des questions -->
            <div class="flex flex-col items-center">
                <h2 class="text-xl font-semibold mb-4 text-center">Questions posées</h2>
                <div class="grid grid-cols-1 gap-6 max-w-full flex-1 p-6">
                    @forelse($questions as $question)
                        <div class="{{ $question->resolved ? 'bg-green-50' : 'bg-white' }} shadow-md rounded-lg p-6 flex flex-col justify-between cursor-pointer"
                            onclick="window.location='{{ route('questions.show', $question->id) }}'">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $question->title }}</h3>
                                <div class="text-sm text-gray-500">Créé le {{ $question->created_date }}</div>
                                <p class="text-gray-700 mt-2">{{ Str::limit($question->content, 150) }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Aucune question trouvée.</p>
                    @endforelse
                </div>
            </div>

            <!-- Liste des réponses -->
            <div>
                <h2 class="text-xl font-semibold mb-4 text-center">Réponses données</h2>
                <div class="grid grid-cols-1 gap-6">
                    @forelse($answers as $answer)
                        <div class="shadow-md rounded-lg p-6 flex flex-col justify-between">
                            <div>
                                <p class="text-gray-700">{{ Str::limit($answer->content, 150) }}</p>
                                <div class="text-sm text-gray-500 mt-2">Répondu le {{ $answer->created_date }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Aucune réponse trouvée.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
