<x-app-layout>

    <!-- HEADER -->
    <div class="py-20 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
            Contenus Culturels
        </h1>
        <p class="mt-3 text-white/80 text-lg">
            Histoires, traditions et savoirs du Bénin
        </p>
    </div>

    <!-- LISTE DES CONTENUS -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($contenus as $contenu)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden">

                    {{-- Image du contenu --}}
                    @if($contenu->media)
                        <img 
                            src="{{ asset('storage/' . $contenu->media) }}" 
                            alt="{{ $contenu->titre }}"
                            class="w-full h-48 object-cover"
                        >
                    @endif

                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $contenu->titre }}
                        </h3>

                        {{-- Extrait du texte --}}
                        @php
                            $limit = 120; // nombre de caractères à afficher
                            $textePreview = \Illuminate\Support\Str::limit($contenu->texte, $limit);
                        @endphp

                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {!! nl2br(e($textePreview)) !!}
                        </p>

                        {{-- Bouton "Voir plus / Payer" --}}
                        @if(Str::length($contenu->texte) > $limit)
                            @auth
                                @php
                                    $hasPaid = $contenu->commandes()
                                        ->where('user_id', auth()->user()->id_user)
                                        ->where('statut', 'payé')
                                        ->exists();
                                @endphp

                                @if($hasPaid)
                                    <a href="{{ route('contenus.show', $contenu) }}" 
                                       class="text-blue-700 font-semibold hover:underline text-sm">
                                        Lire la suite →
                                    </a>
                                @else
                                    <form method="POST" action="{{ route('payments.process', $contenu) }}">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition text-sm">
                                            Voir plus / Payer 300F
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition text-sm">
                                    Connectez-vous pour voir plus
                                </a>
                            @endauth
                        @endif

                    </div>
                </div>

            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500 text-lg">
                        Aucun contenu disponible pour le moment.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $contenus->links() }}
        </div>
    </section>

</x-app-layout>
