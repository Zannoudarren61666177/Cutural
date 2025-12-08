<div class="form-group">
    <label for="id_langue">Langue</label>
    <select name="id_langue" id="id_langue" class="form-control" required>
        @foreach($langues as $langue)
            <option value="{{ $langue->id_langue }}" 
                {{ old('id_langue', $contenu->id_langue) == $langue->id_langue ? 'selected' : '' }}>
                {{ $langue->libelle }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_region">Région</label>
    <select name="id_region" id="id_region" class="form-control" required>
        @foreach($regions as $region)
            <option value="{{ $region->id_region }}" 
                {{ old('id_region', $contenu->id_region) == $region->id_region ? 'selected' : '' }}>
                {{ $region->nom_region }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_type_contenu">Type de Contenu</label>
    <select name="id_type_contenu" id="id_type_contenu" class="form-control" required>
        @foreach($type_contenus as $type)
            <option value="{{ $type->id_type_contenu }}" 
                {{ old('id_type_contenu', $contenu->id_type_contenu) == $type->id_type_contenu ? 'selected' : '' }}>
                {{ $type->libelle_type }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_auteur">Auteur</label>
    <select name="id_auteur" id="id_auteur" class="form-control" required>
        @foreach($users as $user)
            <option value="{{ $user->id_user }}" 
                {{ old('id_auteur', $contenu->id_auteur) == $user->id_user ? 'selected' : '' }}>
                {{ $user->nom }} {{ $user->prenom ?? '' }}
            </option>
        @endforeach
    </select>
</div>
