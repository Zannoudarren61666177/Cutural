<x-app-layout>

    @php
        $user = auth()->user();
        $hasPaid = $user && $user->commandes()
            ->where('contenu_id', $contenu->id_contenu)
            ->where('statut', 'payé')
            ->exists();
    @endphp

    {{-- Si contenu premium ET non payé -> on bloque l'accès --}}
    @if($contenu->is_premium && !$hasPaid)
        <div class="max-w-2xl mx-auto mt-20 p-8 bg-white shadow-lg rounded-xl text-center">
            <h2 class="text-2xl font-bold mb-4 text-red-600">
                Ce contenu est premium
            </h2>

            <p class="text-gray-700 mb-6">
                Veuillez payer pour accéder au contenu complet.
            </p>

            <form action="{{ route('payments.process', $contenu) }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition">
                    Payer 300 F et Voir le contenu
                </button>
            </form>

            <p class="mt-4">
                <a href="{{ route('contenus.index') }}" class="text-blue-700 hover:underline">
                    ← Retour aux contenus
                </a>
            </p>
        </div>
    @else

        <!-- HEADER -->
        <div class="py-20 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
                {{ $contenu->titre }}
            </h1>

            @if($contenu->typeContenu)
                <p class="mt-3 text-white/80 text-lg font-medium">
                    {{ $contenu->typeContenu->nom }}
                </p>
            @endif
        </div>

        <!-- CONTENU COMPLET -->
        <section class="py-16 bg-gray-100">
            <div class="max-w-5xl mx-auto px-6 space-y-12">

                {{-- Image principale --}}
                @if($contenu->image)
                    <img 
                        src="{{ asset('storage/' . $contenu->image) }}" 
                        alt="{{ $contenu->titre }}"
                        class="w-full max-h-[500px] object-cover rounded-xl shadow-lg"
                    >
                @endif

                {{-- Texte complet --}}
                <div class="bg-white p-8 rounded-xl shadow-lg prose max-w-full text-gray-800 leading-relaxed text-lg">
                    {!! nl2br(e($contenu->texte)) !!}
                </div>

                {{-- Médias associés (images, vidéos, audios) --}}
                @if($contenu->medias && $contenu->medias->count())
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h2 class="text-2xl font-bold mb-4">Médias associés</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                            @foreach($contenu->medias as $media)

                                {{-- Image --}}
                                @if($media->typeMedia->type === 'image')
                                    <img 
                                        src="{{ asset('storage/' . $media->fichier) }}" 
                                        class="rounded-lg shadow-md object-cover h-48 w-full"
                                    >
                                @endif

                                {{-- Vidéo --}}
                                @if($media->typeMedia->type === 'video')
                                    <video controls class="w-full rounded-lg shadow-md h-48 object-cover">
                                        <source src="{{ asset('storage/' . $media->fichier) }}">
                                    </video>
                                @endif

                                {{-- Audio --}}
                                @if($media->typeMedia->type === 'audio')
                                    <audio controls class="w-full mt-2">
                                        <source src="{{ asset('storage/' . $media->fichier) }}">
                                    </audio>
                                @endif

                            @endforeach

                        </div>
                    </div>
                @endif

                {{-- Informations annexes --}}
                <div class="bg-white p-8 rounded-xl shadow-lg space-y-4">

                    @if($contenu->region)
                        <p>
                            <span class="font-semibold">Région :</span>
                            {{ $contenu->region->nom_region ?? $contenu->region->nom }}
                        </p>
                    @endif

                    @if($contenu->langues && $contenu->langues->count())
                        <p>
                            <span class="font-semibold">Langues :</span>
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($contenu->langues as $langue)
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    {{ $langue->nom }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </section>

    @endif

</x-app-layout>
