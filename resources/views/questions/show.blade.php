<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">

            <!-- Section Question and Réponses (Left Panel) -->
            <div class="w-full lg:w-3/5 space-y-6">
                <!-- Section Question -->
                <x-question :question="$question" :classic="false" :questionImages="$questionImages"></x-question>

                <!-- Section Réponses -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-medium mb-4">{{ count($question->answers) }}
                        réponse{{ count($question->answers) > 1 ? 's' : '' }}</h3>
                    @foreach ($answers as $index => $answer)
                        <x-answer :index="$index" :answers="$answers" :answer="$answer" :question="$question" :classic="true"></x-answer>
                    @endforeach
                    <!-- Pagination links -->
                    <div class="mt-6 flex justify-center">
                        {{ $answers->links() }}
                    </div>
                </div>
            </div>

            <!-- Section Formulaire de Réponse (Right Panel) -->
            <div class="w-full lg:w-2/5 bg-white p-6 rounded-lg shadow self-start sticky top-6">
                <h3 class="text-xl font-medium mb-4">Envoyer une réponse</h3>
                <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Votre réponse :</label>
                        <textarea id="content" name="content" rows="10"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Ajout images :</label>
                        <div class="flex items-center">
                            <input type="file" id="image" name="image[]"
                                accept="image/jpeg,image/png,image/jpg,image/gif" multiple
                                class="block w-3/5 text-sm mb-2 text-gray-700">
                            <button type="submit"
                                class="ml-2 w-2/5 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                                Envoyer
                            </button>
                        </div>
                        @error('image.*')
                            <x-input-error class="mt-2" :messages="[$message]" />
                        @enderror
                        <ul id="file-list" class="list-disc pl-5 block w-full text-sm mb-2 text-gray-700">
                            <!-- Files list -->
                        </ul>
                    </div>
                    <div class="text-right self-end">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-upvote-script></x-upvote-script>
    <script src="{{ asset('js/upload-image-list.js') }}"></script>
</x-app-layout>
