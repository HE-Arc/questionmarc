<x-app-layout>
    <div class="flex justify-center">
        <div class="grid grid-cols-1 gap-6 max-w-xl flex-1 p-6">
            @foreach ($questions as $question)
                <div class="bg-white shadow-md rounded-lg p-6 flex-1">
                    <div class="flex items-center mb-4">
                        <div class="text-sm font-medium text-gray-900">{{ $question->author->username}}</div>
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
