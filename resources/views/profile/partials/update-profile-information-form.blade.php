<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="filiere" :value="__('Filiere')" />
            <x-text-input id="filiere" name="filiere" type="text" class="mt-1 block w-full" :value="old('filiere', $user->filiere)" required autocomplete="filiere" />
            <x-input-error class="mt-2" :messages="$errors->get('filiere')" />
        </div>

        <div>
            <x-input-label for="year" :value="__('Year')" />
            <x-text-input id="year" name="year" type="text" class="mt-1 block w-full" :value="old('year', $user->year)" required autocomplete="year" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <div>
            <x-input-label for="profile_picture_type" :value="__('Profile Picture Type')" />
            <select id="profile_picture_type" name="profile_picture_type" class="mt-1 block w-full" required autocomplete="profile_picture_type">
                <option value="1" {{ old('profile_picture_type', $user->profile_picture_type) == 1 ? 'selected' : '' }}>Robot</option>
                <option value="5" {{ old('profile_picture_type', $user->profile_picture_type) == 5 ? 'selected' : '' }}>Human</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture_type')" />
        </div>

        <div class="flex items-center gap-4">
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
