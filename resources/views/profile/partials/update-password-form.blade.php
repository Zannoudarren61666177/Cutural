<section class="space-y-6 max-w-2xl mx-auto">
    <header class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Modifier le mot de passe') }}
        </h2>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 bg-white/70 backdrop-blur-md p-6 rounded-2xl shadow-lg">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-600" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-600" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <div class="flex flex-col md:flex-row items-center justify-end gap-4 mt-4">
            <x-primary-button class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition transform active:scale-95">
                {{ __('Enregistrer') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 mt-2 md:mt-0"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
