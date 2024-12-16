@props(['index', 'answers', 'answer', 'question', 'classic'])

<div class="mb-4 p-4 rounded-lg flex flex-col {{ $classic == false ? 'bg-white' : ''}}">
    <!-- Section Contenu de la réponse -->
    <div class="p-4 rounded-lg {{ $answer->validated ? 'bg-green-50' : 'bg-gray-100' }} {{ $classic == false && $answer->validated == false ? 'bg-white' : ''}}">
        <div class="flex items-center gap-4 mb-2">
            <div
                class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                <img src="https://robohash.org/{{ $answer->author->username }}.png?size=50x50&set=set{{ $answer->author->profile_picture_type }}"
                    class="w-full h-full object-cover">
            </div>
            <div class="ml-2 font-medium dark:text-black">
                <div>
                    <a href="{{ route('profile.show', $answer->author->id) }}" class="text-blue-500 hover:underline">
                        {{ $answer->author->username }}
                    </a>
                </div>
                <div class="text-sm text-gray-500">Répondu le {{ $answer->created_date }}</div>
            </div>
        </div>
        <div class="text-gray-700 mb-4">
            <div class="white-space-pre-line break-words text-justify">
                {!! nl2br(e($answer->content)) !!}
            </div>
        </div>
        <!-- Best Answer Badge -->
        @if ($answer->validated)
            <div class="mt-4 flex items-center gap-2">
                <div class="px-3 py-1 bg-green-400 text-white rounded-full text-sm">
                    Meilleure réponse
                </div>
                @if ($classic)
                    @if (Auth::check() && Auth::user()->id == $question->author_id)
                        <form action="{{ route('answers.cancel', $answer->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                            class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                                Annuler
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        @elseif ($classic)
            @if (Auth::check() && Auth::user()->id == $question->author_id && !$question->resolved)
                <form action="{{ route('answers.accept', $answer->id) }}" method="POST"
                    class="mt-2">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Valider
                    </button>
                </form>
            @endif
        @endif
    </div>
    <!-- Section Bouton d'upvote et compteur -->
    @if ($classic)
        <div class="flex items-center mt-2">
            <button data-answer-id="{{ $answer->id }}"
                class="upvote-button {{ $answer->userHasUpvoted ? 'text-indigo-600 hover:text-gray-500' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="h-6 w-6">
                <path
                d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
            </svg> </button>
            <span id="upvote-count-{{ $answer->id }}"
                class="ml-2 text-gray-700">{{ $answer->upvoters_count ?? 0 }}</span>
            @if ($index !== count($answers) - 1)
            <hr class="my-4 border-gray-300">
            @endif
        </div>
    @else
        <div class="flex items-center mt-2">
            <button onclick="window.location='{{ route('questions.show', $answer->question_id) }}'" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Aller à la question
                </span>
                </button>
        </div>
        @endif
</div>
