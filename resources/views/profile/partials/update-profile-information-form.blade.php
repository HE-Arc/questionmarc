<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Mes informations') }}
        </h2>

    </header>

    <form method="post" action="{{ route('profile.update') }}" class="max-w-sm">
        @csrf
        @method('patch')

        <div class="mb-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="mb-4">
            <x-input-label for="filiere" :value="__('Filiere')" />
            <select id="filiere" name="filiere" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                <option value="" disabled {{ old('filiere', $user->filiere) ? '' : 'selected' }}>Choisissez une filière</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere }}" {{ old('filiere', $user->filiere) == $filiere ? 'selected' : '' }}>
                        {{ $filiere }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('filiere')" />
        </div>

        <div class = "mb-4">
            <x-input-label for="year" :value="__('Year')" />
            <input id="year" name="year" type="range" min="1" max="3" step="1" list="year-options" value="{{ old('year', $user->year) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            <datalist id="year-options">
                <option value="1" label="1"></option>
                <option value="2" label="2"></option>
                <option value="3" label="3"></option>
            </datalist>
            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mt-1">
                <span>1</span>
                <span>2</span>
                <span>3</span>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <div class="mb-4">
            <x-input-label for="profile_picture_type" :value="__('Profile Picture Type')" />
            <select id="profile_picture_type" name="profile_picture_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" {{ old('profile_picture_type', $user->profile_picture_type) == 1 ? 'selected' : '' }}>Robot</option>
                <option value="5" {{ old('profile_picture_type', $user->profile_picture_type) == 5 ? 'selected' : '' }}>Human</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture_type')" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
