<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Servieces\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::all();
        return view('Admin.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //Obtenir tous les role disponible
        $roles = Role::all();
        return view('admin.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        /* Trouver un role ou pas  */
        $role = Role::findOrFail($request->role);

        /* Verifions si le role est super admin
        pas possibilité de créer un user */
        if($role->name == 'Super Admin') {
            AlertService::error("You can not create Super Admin role.");
            return to_route('admin.role-users.index');
        }

        /* Création de l'instance Admin */
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        /* Assigné un role à un User */
        $admin->assignRole($role);

        AlertService::created();

        return to_route('admin.role-users.index');
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
    public function edit(Admin $role_user): View
    {
        $admin = $role_user;
        $roles = Role::all();
        return view('Admin.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $role_user)
    {
         /* Verifions si le role est super admin
        pas possibilité de faire la mise à jour */
        if($role_user->hasRole('Super Admin')) {
            AlertService::error("You can not update Super Admin user.");
            return to_route('admin.role-users.index');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email, ' . $role_user->id],
        ]);

        /* Trouver un role ou pas  */
        $role = Role::findOrFail($request->role);

         /* Verifions si le role est super admin
        pas possibilité de créer un user */
        if($role->name == 'Super Admin') {
            AlertService::error("You can not update Super Admin role.");
            return to_route('admin.role-users.index');
        }

        /* Création de l'instance Admin */
        $admin = $role_user;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', 'min:8']
            ]);
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        /* Assigné un role à un User */
        $admin->assignRole($role);

        AlertService::updated();

        return to_route('admin.role-users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $role_user): JsonResponse
    {
        /* Verifions si le role est super admin
        pas possibilité de faire la mise à jour */
        if($role_user->hasRole('Super Admin')) {
            AlertService::error("You can not update Super Admin user.");
            return response()->json(['status' => 'error', 'message' => 'You can not delete Super Admin user.']);
        }
        try {
            // remove roles form
            foreach ($role_user->getRoleNames() as $role) {
                $role_user->removeRole($role);
            }

            $role_user->delete();

            AlertService::deleted();

            return response()->json(['status' => 'success', 'message' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            Log::error('Role Delete Error: ', $th);
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
