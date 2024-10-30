<x-app-layout>
    <div class="flex justify-center">
        <div class="grid grid-cols-1 gap-6 max-w-xl flex-1 p-6">
            @foreach ($questions as $question)
                <div class="bg-white shadow-md rounded-lg p-6 flex-1">
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
                    <div class="text-gray-700">
                        {{ $question->content }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 flex flex-col items-center">
        {!! $questions->links() !!}
    </div>
</x-app-layout>
