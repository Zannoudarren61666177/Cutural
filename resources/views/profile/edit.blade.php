<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Header -->
            <header class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white drop-shadow-lg">
                    {{ __('Mon Profil') }}
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Gérez vos informations personnelles, votre mot de passe et votre compte.
                </p>
            </header>

            <!-- Update Profile Information -->
            <section class="bg-white/70 backdrop-blur-md shadow-lg sm:rounded-2xl p-6 transition transform hover:scale-102">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Update Password -->
            <section class="bg-white/70 backdrop-blur-md shadow-lg sm:rounded-2xl p-6 transition transform hover:scale-102">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Delete Account -->
            <section class="bg-white/70 backdrop-blur-md shadow-lg sm:rounded-2xl p-6 transition transform hover:scale-102">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>

    <!-- Styles supplémentaires -->
    <style>
        /* Effet léger au hover pour les sections */
        .hover\\:scale-102:hover {
            transform: scale(1.02);
        }

        /* Input et bouton peuvent être harmonisés ici si nécessaire */
        input, button {
            transition: all 0.2s ease;
        }

        button:active {
            transform: scale(0.97);
        }
    </style>
</x-app-layout>
