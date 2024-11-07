<x-app-layout>
    <div class="flex justify-center">
        <div class="grid grid-cols-1 gap-6 max-w-xl flex-1 p-6">
            @foreach ($questions as $question)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                                <img src="https://robohash.org/{{$question->author->username}}.png?size=50x50&set=set{{$question->author->profile_picture_type}}" class="w-full h-full object-cover">
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
                    <!-- Filiere and Module at the bottom with dynamic colored tags -->
                    <div class="mt-4 flex gap-2 justify-start">
                        <span class="px-3 py-1 rounded-full text-sm text-white" style="background-color: {{ $dynamicColor($question->author->filiere) }}">
                            {{ $question->author->filiere }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm text-white truncate max-w-xs" style="background-color: {{ $dynamicColor($question->module->name) }}">
                            {{ $question->module->name }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 flex flex-col items-center">
        {!! $questions->links() !!}
    </div>
</x-app-layout>
