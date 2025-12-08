<x-app-layout>

    <!-- SECTION HERO -->
    <div class="min-h-screen relative bg-cover bg-center" 
         style="background-image: url('{{ asset('images/bio.webp') }}');">
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative h-full flex flex-col justify-center items-center text-center text-white px-4 pt-32">
            <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg">
                Découvrez la Culture du Bénin
            </h1>
            <p class="mt-4 text-lg md:text-xl max-w-3xl text-white/90">
                Traditions, langues, régions, événements, arts… tout ce qui fait la richesse du Bénin 🇧🇯
            </p>

            <div class="mt-16 flex flex-wrap gap-4 justify-center">
                <a href="#explore" 
                   class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-xl font-semibold shadow-lg 
                          hover:bg-yellow-500 transition transform hover:scale-105">
                    Explorer ↓
                </a>
            </div>
        </div>
    </div>

    <!-- SECTION INTRO -->
    <section id="explore" class="py-28 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Bienvenue sur la plateforme culturelle</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Ici, vous trouverez des ressources authentiques sur les traditions, la diversité ethnique,
                les langues, les arts, les médias, les festivals et l’histoire du Bénin.
                Cette plateforme vise à valoriser et préserver le riche patrimoine culturel du pays.
            </p>
        </div>
    </section>

    <!-- SECTION CARTES -->
    <section class="py-20" style="background: linear-gradient(to bottom, #e8f0ff, #ffffff);">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            <x-front.card 
                title="📚 Contenus Culturels"
                text="Histoires, traditions et recettes béninoises..."
                link="{{ route('contenus.index') }}"
            />

            <x-front.card 
                title="🎵 Médias"
                text="Danses, images, musiques traditionnelles..."
                link="{{ route('medias.index') }}"
            />

            <x-front.card 
                title="🗺️ Régions"
                text="Parcourez les régions du Bénin..."
                link="{{ route('regions.index') }}"
            />

            <x-front.card 
                title="🌐 Langues"
                text="Fon, Yoruba, Dendi, Mina, Adja..."
                link="{{ route('langues.index') }}"
            />

            <x-front.card 
                title="🎉 Festivals"
                text="Vodoun Festival, Gaani, Gèlèdè..."
                link="{{ route('evenements.index') }}"
            />

            <!-- Carte Contributeur -->
            <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-2xl transition duration-300 
                        md:col-span-2 lg:col-span-3">
                <h4 class="text-xl font-semibold mb-2">✏️ Devenir Contributeur</h4>

                @auth
                    @if(auth()->user()->role === 'contributeur')
                        <p class="text-gray-600 text-sm mb-4">
                            Vous êtes contributeur ! Partagez vos contenus culturels.
                        </p>
                        <a href="{{ route('contributeurs.ajouter') }}" 
                           class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
                            Ajouter un contenu
                        </a>

                        <div class="mt-6">
                            <h5 class="font-semibold mb-2">Vos derniers contenus :</h5>
                            <ul class="list-disc pl-5 space-y-1 text-gray-700">
                                @forelse(auth()->user()->contenus as $contenu)
                                    <li>
                                        <a href="{{ route('contenus.show', $contenu) }}" 
                                           class="text-blue-700 hover:underline">
                                            {{ $contenu->titre }}
                                        </a> 
                                        - <span class="text-gray-500">{{ ucfirst($contenu->statut) }}</span>
                                    </li>
                                @empty
                                    <li class="text-gray-500">Aucun contenu publié pour l'instant.</li>
                                @endforelse
                            </ul>
                        </div>
                    @else
                        <p class="text-gray-600 text-sm mb-4">
                            Partagez votre savoir et enrichissez la plateforme culturelle.
                        </p>
                        <form method="POST" action="{{ route('devenir-contributeur') }}">
                            @csrf
                            <button class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition">
                                Postuler
                            </button>
                        </form>
                    @endif
                @else
                    <p class="text-gray-600 text-sm mb-4">
                        Connectez-vous pour contribuer à la plateforme.
                    </p>
                    <a href="{{ route('login') }}" 
                       class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
                        Se connecter
                    </a>
                @endauth
            </div>

        </div>
    </section>

    <!-- SECTION HISTOIRE -->
    <section class="py-28" style="background: linear-gradient(to bottom, #ffffff, #f6efe3);">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4 text-gray-800">Un patrimoine riche et unique</h2>
            <p class="text-gray-700 leading-relaxed text-lg">
                Le Bénin est l’un des berceaux historiques les plus importants d’Afrique de l’Ouest.
                Son histoire, ses peuples, ses traditions et ses expressions artistiques constituent
                une mosaïque culturelle d’une grande valeur.
            </p>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white py-10 text-center">
        © {{ date('Y') }} Culture du Bénin — Tous droits réservés.
    </footer>

</x-app-layout>
