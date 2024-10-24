<x-app-layout>
    <table class="min-w-full divide-y divide-gray-200">
        <caption class="caption-top">
            <h2 class="text-2xl font-semibold text-gray-900">Questions</h2>
        </caption>
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Questions</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contenu</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($questions as $question)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $question->content }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 flex flex-col items-center">
        {!! $questions->links() !!}
    </div>
</x-app-layout>
