<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_role' => 'required|string|max:255|unique:roles,nom_role',
        ]);

        Role::create($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Rôle créé avec succès !');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'nom_role' => "required|string|max:255|unique:roles,nom_role,{$role->id_role},id_role",
        ]);

        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour !');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé !');
    }
}
