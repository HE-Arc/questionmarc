<x-app-layout>
    <div class="container mx-auto p-6">
        <div x-data="{ activeTab: '{{ $tab }}' }" class="p-6">
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

            <!-- Onglets -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-4 justify-center">
                    <button
                        class="py-2 px-4 font-semibold text-gray-600 hover:text-blue-500"
                        :class="activeTab === 'questions' ? 'border-b-2 border-blue-500 text-blue-500' : ''"
                        @click="activeTab = 'questions'">
                        Questions
                    </button>
                    <button
                        class="py-2 px-4 font-semibold text-gray-600 hover:text-blue-500"
                        :class="activeTab === 'answers' ? 'border-b-2 border-blue-500 text-blue-500' : ''"
                        @click="activeTab = 'answers'">
                        Réponses
                    </button>
                    <button
                        class="py-2 px-4 font-semibold text-gray-600 hover:text-blue-500"
                        :class="activeTab === 'upvotes' ? 'border-b-2 border-blue-500 text-blue-500' : ''"
                        @click="activeTab = 'upvotes'">
                        Upvotes
                    </button>
                </nav>
            </div>

            <!-- Contenu des onglets -->
            <!-- Questions -->
            <div x-show="activeTab === 'questions'" class="flex flex-col items-center">
                <div class="lg:w-3/4 sm:w-full px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-6 p-6">
                        @forelse($questions as $question)
                            <x-question :question="$question" :classic="true"></x-question>
                        @empty
                            <p class="text-center">Aucune question trouvée.</p>
                        @endforelse
                    </div>
                </div>
                <div class="mt-4">
                    {{ $questions->appends(['tab' => 'questions'])->links() }}
                </div>
            </div>

            <!-- Réponses -->
            <div x-show="activeTab === 'answers'" class="flex flex-col items-center">
                <div class="lg:w-3/4 sm:w-full px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-6 p-6">
                        @forelse($answers as $index => $answer)
                            <x-answer :index="$index" :answers="$answers" :answer="$answer" :classic="false"></x-answer>
                        @empty
                            <p class="text-center">Aucune réponse trouvée.</p>
                        @endforelse
                    </div>
                </div>
                <div class="mt-4">
                    {{ $answers->appends(['tab' => 'answers'])->links() }}
                </div>
            </div>

            <!-- Upvotes -->
            <div x-show="activeTab === 'upvotes'" class="flex flex-col items-center">
                <div class="lg:w-3/4 sm:w-full px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-6 p-6">
                        @forelse($upvotedAnswers as $index => $answer)
                            <x-answer :index="$index" :answers="$upvotedAnswers" :answer="$answer" :classic="false"></x-answer>
                        @empty
                            <p class="text-center">Aucune réponse trouvée.</p>
                        @endforelse
                    </div>
                </div>
                <div class="mt-4">
                    {{ $upvotedAnswers->appends(['tab' => 'upvotes'])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-upvote-script></x-upvote-script>
</x-app-layout>
