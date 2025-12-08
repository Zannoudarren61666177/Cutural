<x-app-layout>

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 py-20 text-center text-white">
        <h1 class="text-4xl font-bold">Médias</h1>
        <p class="mt-3 text-white/80">Photos, audios et vidéos illustrant le patrimoine</p>
    </div>

    <!-- GRILLE DES MÉDIAS -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6">
            @forelse($medias as $media)
                <a href="{{ route('medias.show', $media) }}" class="rounded-xl overflow-hidden shadow hover:shadow-xl transition block">
                    @if($media->type == 'image')
                        <img src="{{ asset('storage/' . $media->fichier) }}" alt="{{ $media->titre ?? 'Média' }}" class="h-44 w-full object-cover">
                    @elseif($media->type == 'video')
                        <div class="relative h-44 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <span class="text-center">Vidéo</span>
                        </div>
                    @else
                        <div class="relative h-44 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <span class="text-center">Autre média</span>
                        </div>
                    @endif
                </a>
            @empty
                <p class="text-gray-500 col-span-4 text-center">Aucun média disponible pour le moment.</p>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-8">
            {{ $medias->links() }}
        </div>
    </section>

</x-app-layout>
