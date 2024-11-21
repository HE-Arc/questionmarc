<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">

            <!-- Section Question and Réponses (Left Panel) -->
            <div class="w-full lg:w-3/5 space-y-6">
                <!-- Section Question -->
                <div class="bg-white p-6 rounded-lg shadow">
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
                    <div class="text-gray-700">
                        {{ $question->content }}
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

                <!-- Section Réponses -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-medium mb-4">{{ count($question->answers) }} réponse{{ count($question->answers) > 1 ? 's' : '' }}</h3>
                    @foreach ($answers as $answer)
                        <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                            <div class="flex items-center gap-4 mb-2">
                                <div
                                    class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                                    <img src="https://robohash.org/{{ $answer->author->username }}.png?size=50x50&set=set{{ $answer->author->profile_picture_type }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="ml-2 font-medium dark:text-black">
                                    <div>{{ $answer->author->username }}</div>
                                    <div class="text-sm text-gray-500">Répondu le {{ $answer->created_date }}</div>
                                </div>
                            </div>
                            <div class="text-gray-700">
                                {{ $answer->content }}
                            </div>
                            <!-- Best Answer Badge -->
                            @if ($answer->validated)
                                <div class="mt-4 flex items-center gap-2">
                                    <div class="px-3 py-1 bg-green-400 text-white rounded-full text-sm">
                                        Meilleure réponse
                                    </div>
                                    @if (Auth::check() && Auth::user()->id == $question->author_id)
                                        <form action="{{ route('answers.cancel', $answer->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                                                Annuler
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @elseif (Auth::check() && Auth::user()->id == $question->author_id && !$question->resolved)
                                <form action="{{ route('answers.accept', $answer->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                                        Valider
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                    <!-- Pagination links -->
                    <div class="mt-6 flex justify-center">
                        {{ $answers->links() }}
                    </div>
                </div>
            </div>

            <!-- Section Formulaire de Réponse (Right Panel) -->
            <div class="w-full lg:w-2/5 bg-white p-6 rounded-lg shadow self-start">
                <h3 class="text-xl font-medium mb-4">Envoyer une réponse</h3>
                <form action="{{ route('answers.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Votre réponse :</label>
                        <textarea id="content" name="content" rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
