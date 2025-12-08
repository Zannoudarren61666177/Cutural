<section class="space-y-6 max-w-2xl mx-auto">
    <header class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            {{ __("Mettez à jour les informations de votre compte et votre adresse e-mail.") }}
        </p>
    </header>

    {{-- Formulaire pour renvoyer le mail de vérification --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Formulaire de mise à jour du profil --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 bg-white/70 backdrop-blur-md p-6 rounded-2xl shadow-lg">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200" 
                :value="old('name', $user->name)" 
                required autofocus autocomplete="name" 
            />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-700 focus:ring focus:ring-blue-200" 
                :value="old('email', $user->email)" 
                required autocomplete="username" 
            />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Votre adresse e-mail n’est pas vérifiée.') }}
                        <button 
                            form="send-verification" 
                            class="underline text-sm text-blue-700 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Cliquez ici pour renvoyer le mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col md:flex-row items-center justify-end gap-4 mt-4">
            <x-primary-button class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition transform active:scale-95">
                {{ __('Enregistrer') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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
