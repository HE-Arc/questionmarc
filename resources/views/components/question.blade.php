@props(['question', 'classic', 'questionImages'])

<div class="{{ $question->resolved ? 'bg-green-50' : 'bg-white' }} rounded-lg p-6 shadow{{ $classic ? '-md flex flex-col justify-between cursor-pointer' : '' }}"
    @if ($classic) onclick="window.location='{{ route('questions.show', $question->id) }}'" @endif>
    <div>
        <div class="flex items-center gap-4 mb-4">
            <div class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                <img src="https://robohash.org/{{ $question->author->username }}.png?size=50x50&set=set{{ $question->author->profile_picture_type }}"
                    class="w-full h-full object-cover">
            </div>
            <div class="ml-2 font-medium dark:text-black">
                <div>
                    <a href="{{ route('profile.show', $question->author->id) }}" class="text-blue-500 hover:underline">
                        {{ $question->author->username }}
                    </a>
                </div>
                <div class="text-sm text-gray-500">Créé le {{ $question->created_date }}</div>
            </div>
        </div>
        <div class="mb-2">
            <h3 class="text-lg font-bold text-gray-900">{{ $question->title }}</h3>
        </div>
        <div class="text-gray-700 break-words">
            <div class="white-space-pre-line break-words text-justify"> {!! nl2br(e($question->content)) !!}
            </div>
        </div>
    </div>
    @if ($classic == false)
        @if ($questionImages->count() > 0)
            <x-carousel :card="$question" :images="$questionImages" />
        @endif
    @endif

    <div class="mt-4 flex justify-between">
        <div class="flex gap-2">
            <span class="px-3 py-1 rounded-full text-xs lg:text-sm text-white break-words content-center"
                style="background-color: {{ $dynamicColor($question->module->filiere_name) }};">
                {{ $question->module->filiere_name }}
            </span>
            <span class="flex px-3 py-1 rounded-full text-xs lg:text-sm text-white max-w-xs break-words content-center"
                style="background-color: {{ $dynamicColor($question->module->name) }};">
                {{ $question->module->name }}
            </span>
        </div>
        @if ($classic)
            <div class="flex gap-2 items-center justify-between">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    stroke="#000000">
                    <path
                        d="M21 21H6.2C5.07989 21 4.51984 21 4.09202 20.782C3.71569 20.5903 3.40973 20.2843 3.21799 19.908C3 19.4802 3 18.9201 3 17.8V3M7 15L12 9L16 13L21 7"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="px-3 py-1 rounded-full text-sm text-white bg-blue-500">
                    {{ $question->upvotes_total ?? 0 }}
                </span>
            </div>
        @endif
    </div>
</div>
