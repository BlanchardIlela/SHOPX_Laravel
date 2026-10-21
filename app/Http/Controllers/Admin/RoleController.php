<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Servieces\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /* Compter le nombre de relations entre
        les éléments en question. */
        $roles = Role::withCount('permissions')->get();
        return view('Admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        /* Toutes les autorisations seront groupée
        en fonction de leur noms */
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['required', 'array']
        ]);

        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);
        $role->syncPermissions($request->permissions);

        AlertService::created();

        return to_route('admin.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name, '. $role->id],
            'permissions' => ['required', 'array']
        ]);

        $role->update(['name' => $request->role]);
        $role->syncPermissions($request->permissions);

        AlertService::updated();

        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
