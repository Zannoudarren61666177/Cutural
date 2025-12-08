<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6">
        <h2 class="text-3xl font-bold mb-4">{{ $contenu->titre }}</h2>
        <p class="text-gray-600 mb-4">{{ $contenu->description }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-500 mb-6">
            <p><strong>Type :</strong> {{ $contenu->typeContenu->libelle_type }}</p>
            <p><strong>Région :</strong> {{ $contenu->region->nom }}</p>
            <p><strong>Langue :</strong> {{ $contenu->langue->nom }}</p>
        </div>

        <p class="mb-4">
            <strong>Statut :</strong>
            <span class="@if($contenu->statut == 'publié') text-green-600 
                         @elseif($contenu->statut == 'en_attente') text-yellow-600 
                         @else text-red-600 @endif font-semibold">
                {{ ucfirst($contenu->statut) }}
            </span>
        </p>

        @if($contenu->media)
            <div class="mb-6">
                @if(str_contains($contenu->media, '.mp4'))
                    <video controls class="w-full rounded-lg shadow-md">
                        <source src="{{ asset('storage/'.$contenu->media) }}" type="video/mp4">
                    </video>
                @else
                    <img src="{{ asset('storage/'.$contenu->media) }}" alt="Media" class="w-full rounded-lg shadow-md">
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <a href="{{ route('contributeurs.index') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                ← Retour à mes contributions
            </a>
            <a href="{{ route('contributeurs.ajouter') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition">
                Ajouter un nouveau contenu
            </a>
        </div>
    </div>
</x-app-layout>
