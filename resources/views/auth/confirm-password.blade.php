<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

    <!-- Nom -->
    <div>
        <x-input-label for="nom" :value="__('Nom')" />
        <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
    </div>

    <!-- Prénom -->
    <div class="mt-4">
        <x-input-label for="prenom" :value="__('Prénom')" />
        <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Mot de passe -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Mot de passe')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirmer mot de passe -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Rôle -->
    <div class="mt-4">
        <x-input-label for="role_id" :value="__('Rôle')" />
        <select name="role_id" id="role_id" class="block mt-1 w-full" required>
            <option value="">-- Sélectionnez un rôle --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id_role }}" {{ old('role_id') == $role->id_role ? 'selected' : '' }}>
                    {{ $role->nom_role }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('S\'inscrire') }}
        </x-primary-button>
    </div>
</form>

</x-guest-layout>
