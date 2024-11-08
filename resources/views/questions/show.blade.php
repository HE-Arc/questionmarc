<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap lg:flex-nowrap space-y-6 lg:space-y-0 lg:space-x-6">

            <!-- Section Question et Réponses -->
            <div class="w-full lg:w-3/5 bg-white p-6 rounded-lg shadow bg-white cursor-pointer">
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
            </div>

            <!-- Section Formulaire de Réponse -->
            <div class="w-full lg:w-2/5 bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-medium mb-4">Envoyer une réponse</h3>
                <form action="{{ route('questions.store', $question->id) }}" method="POST">
                    @csrf
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
