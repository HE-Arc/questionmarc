<x-app-layout>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $questions->links() !!}
        </div>
    </div>
</x-app-layout>
