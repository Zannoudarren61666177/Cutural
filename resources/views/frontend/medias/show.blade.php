<x-app-layout>
    <div class="py-20 bg-blue-700 text-white text-center">
        <h1 class="text-4xl font-bold">{{ $media->titre }}</h1>
        <a href="{{ route('medias.index') }}" class="mt-4 inline-block text-blue-200 hover:text-white underline">
            ← Retour aux médias
        </a>
    </div>

    <section class="py-16 bg-gray-100 max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            @if($media->type == 'image')
                <img src="{{ asset('storage/' . $media->fichier) }}" class="w-full rounded-xl shadow mb-4">
            @elseif($media->type == 'video')
                <video controls class="w-full rounded-xl shadow mb-4">
                    <source src="{{ asset('storage/' . $media->fichier) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture vidéo.
                </video>
            @elseif($media->type == 'audio')
                <audio controls class="w-full mb-4">
                    <source src="{{ asset('storage/' . $media->fichier) }}" type="audio/mpeg">
                    Votre navigateur ne supporte pas la lecture audio.
                </audio>
            @else
                <p class="text-gray-500">Média non disponible.</p>
            @endif

            @if($media->description)
                <p class="text-gray-700 mt-2">{{ $media->description }}</p>
            @endif
        </div>
    </section>
</x-app-layout>
