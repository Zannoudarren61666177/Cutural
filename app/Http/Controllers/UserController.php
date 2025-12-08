<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Formulaire de création
    public function create()
    {
        $roles = Role::all(); // récupère tous les rôles
        return view('users.create', compact('roles'));
    }

    // Enregistrement d’un nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id_role',
            'langue_id' => 'nullable|exists:langues,id_langue',
            'photo' => 'nullable|string|max:255',
        ]);

        // Hash du mot de passe
        $validated['password'] = Hash::make($validated['password']);

        // Assignation du rôle
        $role = Role::findOrFail($validated['role_id']);
        $validated['role'] = $role->nom_role;
        unset($validated['role_id']);

        // Création de l'utilisateur
        User::create($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur créé avec succès !');
    }

    // Formulaire d’édition
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Mise à jour d’un utilisateur
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id_user},id_user",
            'password' => 'nullable|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id_role',
            'langue_id' => 'nullable|exists:langues,id_langue',
            'photo' => 'nullable|string|max:255',
        ]);

        // Hash du mot de passe si fourni
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Assignation du rôle
        $role = Role::findOrFail($validated['role_id']);
        $validated['role'] = $role->nom_role;
        unset($validated['role_id']);

        // Mise à jour
        $user->update($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Suppression d’un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur supprimé avec succès !');
    }
}
