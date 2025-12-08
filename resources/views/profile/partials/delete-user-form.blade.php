<section class="space-y-6 max-w-2xl mx-auto">
    <header class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Supprimer le compte') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-300">
            {{ __('Une fois votre compte supprimé, toutes ses données seront définitivement perdues. Avant de continuer, téléchargez toute information que vous souhaitez conserver.') }}
        </p>
    </header>

    <!-- Bouton déclencheur -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full md:w-auto bg-red-700 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition transform active:scale-95"
    >
        {{ __('Supprimer le compte') }}
    </x-danger-button>

    <!-- Modal confirmation -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white/70 backdrop-blur-md rounded-2xl shadow-lg">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-800 mb-2">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="text-gray-600 mb-4">
                {{ __('Toutes vos données seront définitivement perdues. Veuillez saisir votre mot de passe pour confirmer.') }}
            </p>

            <!-- Champ mot de passe -->
            <div class="mb-4">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full md:w-3/4 rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200"
                    placeholder="{{ __('Mot de passe') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600" />
            </div>

            <!-- Actions -->
            <div class="mt-6 flex flex-col md:flex-row justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')"
                    class="w-full md:w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition transform active:scale-95">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button type="submit"
                    class="w-full md:w-auto bg-red-700 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition transform active:scale-95">
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
