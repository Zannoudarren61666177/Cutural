<div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-2xl transition duration-300 text-center">
    <h3 class="text-xl font-semibold mb-2">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $text }}</p>
    @if(isset($link))
        <a href="{{ $link }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
            Voir
        </a>
    @endif
</div>
