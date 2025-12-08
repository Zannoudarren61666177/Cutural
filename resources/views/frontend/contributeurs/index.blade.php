<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Mes Contributions</h2>

            @if(Auth::user()->role === 'contributeur')
                <a href="{{ route('contributeurs.ajouter') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition">
                    + Ajouter un contenu
                </a>
            @endif
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- LISTE DES CONTRIBUTIONS -->
        @if($contributions->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($contributions as $contenu)
                    <div class="bg-white rounded-2xl shadow-lg p-4 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold mb-2">{{ $contenu->titre }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ Str::limit($contenu->description, 100) }}</p>

                        <p class="text-gray-500 text-xs mb-2">
                            Statut: 
                            <span class="@if($contenu->statut == 'publié') text-green-600
                                         @elseif($contenu->statut == 'en_attente') text-yellow-600
                                         @else text-red-600 @endif font-semibold">
                                {{ ucfirst($contenu->statut) }}
                            </span>
                        </p>

                        <a href="{{ route('contributeurs.show', $contenu) }}" class="text-blue-700 hover:underline text-sm">
                            Voir les détails →
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- PAGINATION (si nécessaire) -->
            <div class="mt-6">
                {{ $contributions->links() }}
            </div>
        @else
            <p class="text-gray-600">Vous n'avez encore soumis aucune contribution.</p>
        @endif
    </div>
</x-app-layout>
