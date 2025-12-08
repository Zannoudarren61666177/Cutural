<x-app-layout>

    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
            {{ $evenement->titre }}
        </h1>

        @if($evenement->date)
            <p class="mt-4 text-lg text-white/90">
                📅 {{ $evenement->date->format('d F Y') }}
            </p>
        @endif
    </div>

    <!-- CONTENU -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-5xl mx-auto px-6 bg-white shadow-xl rounded-2xl p-10 leading-relaxed">

            <div class="prose max-w-full text-gray-800 text-lg">
                {!! nl2br(e($evenement->description)) !!}
            </div>

            @if($evenement->region)
                <div class="mt-8 text-gray-700">
                    <strong class="font-semibold">Région :</strong>
                    {{ $evenement->region->nom ?? 'Non spécifié' }}
                </div>
            @endif

        </div>
    </section>

</x-app-layout>
