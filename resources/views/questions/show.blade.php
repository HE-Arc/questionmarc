<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">

            <!-- Section Question and Réponses (Left Panel) -->
            <div class="w-full lg:w-3/5 space-y-6">
                <!-- Section Question -->
                <div class="bg-white p-6 rounded-lg shadow cursor-pointer">
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

                <!-- Section Réponses -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-medium mb-4">{{ count($question->answers) }} réponse{{ count($question->answers) > 1 ? 's' : '' }}</h3>
                    @foreach ($answers as $index => $answer)
                        <div class="mb-4 flex flex-col">
                            <!-- Section Contenu de la réponse -->
                            <div class="flex-grow bg-gray-100 p-4 rounded-lg">
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
                                <div class="text-gray-700 mb-4">
                                    {{ $answer->content }}
                                </div>
                            </div>

                            <!-- Section Bouton d'upvote et compteur -->
                            <div class="flex items-center mt-2">
                                <form action="{{ route('answers.upvote', $answer->id) }}" method="POST"
                                    class="flex items-center">
                                    @csrf
                                    <button type="submit"
                                        class="{{ $answer->userHasUpvoted ? 'text-indigo-600 hover:text-gray-500' : 'text-gray-500 hover:text-indigo-600' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-6 w-6">
                                            <path
                                                d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                        </svg>
                                    </button>
                                </form>
                                <span class="ml-2 text-gray-700">{{ $answer->upvoters_count ?? 0 }}</span>
                            </div>
                        </div>
                        @if ($index !== count($answers) - 1)
                            <hr class="my-4 border-gray-300">
                        @endif
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
                <form action="{{ route('answers.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Votre réponse :</label>
                        <textarea id="content" name="content" rows="10"
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
