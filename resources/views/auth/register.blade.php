<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Filiere -->
        <div>
            <x-input-label for="filiere" :value="__('Filiere')" />
            <select id="filiere" name="filiere" class="mt-1 block w-full" required>
                <option value="ISC">ISC</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('filiere')" />
        </div>

        <!-- Year -->
        <div>
            <x-input-label for="year" :value="__('Year')" />
            <input id="year" name="year" type="range" min="1" max="3" step="1" list="year-options" value="{{ old('year', 1) }}" class="mt-1 block w-full" required>
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

        <!-- Profile Picture Type -->
        <div>
            <x-input-label for="profile_picture_type" :value="__('Profile Picture Type')" />
            <select id="profile_picture_type" name="profile_picture_type" class="mt-1 block w-full" required>
                <option value="1" {{ old('profile_picture_type') == 1 ? 'selected' : '' }}>Robot</option>
                <option value="5" {{ old('profile_picture_type') == 5 ? 'selected' : '' }}>Human</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture_type')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
