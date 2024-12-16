<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Posez une nouvelle question</h2>
                </div>
                <div class="mt-8 text-2xl">
                    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Year and filliere of the user displayed for information -->
                        <div class="mb-4">
                            <label for="year" class="block text-gray-700 text-sm font-bold mb-2">Année</label>
                            <p class="text-gray-500 text-l font-bold mb-2">{{ Auth::user()->year }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="filliere" class="block text-gray-700 text-sm font-bold mb-2">Filière</label>
                            <p class="text-gray-500 text-l font-bold mb-2">{{ Auth::user()->filiere }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="module" class="block text-gray-700 text-sm font-bold mb-2">Module</label>
                            <select name="module_id" id="module_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
                            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-6">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Détails</label>
                            <textarea name="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Ajout images :</label>
                            <div class="flex items-center">
                                <input type="file" id="image" name="image[]"
                                    accept="image/jpeg,image/png,image/jpg,image/gif" multiple
                                    class="block w-full text-sm mb-2 text-gray-700">
                            </div>
                            @error('image.*')
                                <x-input-error class="mt-2" :messages="[$message]" />
                            @enderror
                            <ul id="file-list" class="list-disc pl-5 block w-full text-sm mb-2 text-gray-700">
                                <!-- Files list -->
                            </ul>
                        </div>
                </div>
                <div class="flex items center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Créer
                    </button>
                    <a href="{{ route('welcome') }}" class="bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Annuler
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/upload-image-list.js') }}"></script>
</x-app-layout>

