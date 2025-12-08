<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6">Ajouter une Contribution</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contributeurs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold">Titre</label>
                <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" rows="5" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Type de contenu</label>
                    <select name="type_contenu_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">-- Choisir --</option>
                        @foreach($typesContenus as $type)
                            <option value="{{ $type->id_type_contenu }}" {{ old('type_contenu_id') == $type->id_type_contenu ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Région</label>
                    <select name="region_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">-- Choisir --</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                {{ $region->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Langue</label>
                    <select name="langue_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">-- Choisir --</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ? 'selected' : '' }}>
                                {{ $langue->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Media (image ou vidéo)</label>
                <input type="file" name="media" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 transition">
                    Soumettre
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
