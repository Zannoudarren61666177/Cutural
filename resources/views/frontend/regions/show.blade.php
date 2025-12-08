<x-app-layout>
    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-800 via-blue-700 to-blue-800 text-center text-white">
        <h1 class="text-5xl font-bold drop-shadow-lg">
            {{ $region->nom }}
        </h1>

        <p class="mt-3 text-lg text-white/90">
            Découvrez les richesses culturelles et historiques de cette région
        </p>
    </div>

    <!-- DESCRIPTION -->
    <section class="py-16 bg-gray-50 max-w-4xl mx-auto px-6 space-y-10">
        
        <!-- Description -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Description</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                {{ $region->description }}
            </p>
        </div>

        <!-- Langues -->
        @if($region->langues->count())
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Langues principales</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($region->langues as $langue)
                        <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $langue->nom }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

    </section>

    <!-- Bouton retour -->
    <div class="text-center pb-16">
        <a href="{{ route('regions.index') }}"
           class="inline-block bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold 
                  hover:bg-blue-800 transition duration-300 shadow">
            ← Retour aux régions
        </a>
    </div>

</x-app-layout>
