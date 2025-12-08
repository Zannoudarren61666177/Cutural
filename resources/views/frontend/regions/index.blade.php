<x-app-layout>

    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-800 via-blue-700 to-blue-800 text-center text-white">
        <h1 class="text-5xl font-bold drop-shadow-lg">Régions du Bénin</h1>
        <p class="mt-4 text-white/90 text-lg">
            Découvrez les départements et leurs richesses culturelles et historiques
        </p>
    </div>

    <!-- LISTE DES RÉGIONS -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($regions as $region)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6
                            border border-gray-100 hover:-translate-y-2">

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        {{ $region->nom }}
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-4">
                        {{ $region->description }}
                    </p>

                    <a href="{{ route('regions.show', $region) }}"
                       class="inline-block text-blue-700 font-semibold hover:underline">
                        Voir détails →
                    </a>
                </div>
            @empty
                <p class="text-gray-500 col-span-3 text-center">
                    Aucune région disponible pour le moment.
                </p>
            @endforelse

        </div>
    </section>

</x-app-layout>
