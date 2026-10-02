<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Servieces\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        return view('Admin.profile.index');
    }

    function profileUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:admins,email,' . auth('admin')->user()->id],
            /* La mise à jour de l'image n'est pas obligatoire */
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);


        $user = auth('admin')->user();
        /* permet de vérifier si un fichier valide a été envoyé dans la requête HTTP */
        if ($request->hasFile('avatar')) {
            $filePath = $this->uploadFile($request->file('avatar'), $user->avatar);
            $filePath ? $user->avatar = $filePath : null;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        AlertService::updated();

        return redirect()->back();
    }

    function passwordUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = auth('admin')->user();
        $user->password = bcrypt($request->password);
        $user->save();

        AlertService::updated();

        return redirect()->back();
    }
}
