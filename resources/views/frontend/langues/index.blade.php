<x-app-layout>

    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Langues du Bénin</h1>
        <p class="mt-4 text-white/90 text-lg">
            Fon · Yoruba · Dendi · Mina · Adja · Bariba et bien d’autres
        </p>
    </div>

    <!-- LISTE DES LANGUES -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">

            @forelse($langues as $langue)
                <div class="bg-white shadow-lg hover:shadow-2xl rounded-2xl p-6 transition transform hover:-translate-y-2">
                    <h3 class="text-2xl font-semibold mb-3 text-gray-800">
                        {{ $langue->nom }}
                    </h3>

                    <p class="text-gray-600 mb-4 line-clamp-4">
                        {{ Str::limit($langue->description, 120) }}
                    </p>

                    <a href="{{ route('langues.show', $langue) }}"
                       class="inline-block mt-2 text-blue-700 font-semibold hover:underline">
                        Voir détails →
                    </a>
                </div>
            @empty
                <p class="text-gray-500 col-span-3 text-center text-lg">
                    Aucune langue disponible pour le moment.
                </p>
            @endforelse

        </div>
    </section>

</x-app-layout>
