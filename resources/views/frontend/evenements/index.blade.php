<x-app-layout>

    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Événements</h1>
        <p class="mt-4 text-white/90 text-lg">
            Festivals • Cérémonies • Traditions vivantes du Bénin
        </p>
    </div>

    <!-- LISTE DES ÉVÉNEMENTS -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($evenements as $evenement)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 p-6">

                        {{-- TITRE --}}
                        <h3 class="text-2xl font-semibold mb-3 text-gray-800">
                            {{ $evenement->titre }}
                        </h3>

                        {{-- DESCRIPTION --}}
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {{ Str::limit($evenement->description, 120) }}
                        </p>

                        {{-- BOUTON --}}
                        <a href="{{ route('frontend.evenements.show', $evenement) }}"
                           class="inline-block text-blue-700 font-semibold hover:underline">
                            Voir détails →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-center col-span-3">
                        Aucun événement pour le moment.
                    </p>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-10">
                {{ $evenements->links() }}
            </div>
        </div>
    </section>

</x-app-layout>
