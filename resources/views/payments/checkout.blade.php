<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6">Paiement pour le contenu</h2>

        <p class="mb-4">Titre : <strong>{{ $contenu->titre }}</strong></p>
        <p class="mb-4">Prix : <strong>{{ $contenu->prix }} F CFA</strong></p>

        <form action="{{ route('payments.process', $contenu) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 transition">
                Payer et Voir le contenu
            </button>
        </form>
    </div>
</x-app-layout>
