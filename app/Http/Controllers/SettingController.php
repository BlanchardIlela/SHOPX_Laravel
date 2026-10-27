<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Servieces\AlertService;
use App\Servieces\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index() : View
    {
        return view('admin.settings.section.general-settings');
    }

    function generalSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_phone' => ['nullable', 'string', 'max:255']
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        /* Récuperer le cache et afficher les résultat */
        $settings = app()->make(SettingService::class);
        $settings->clearCashedSettings();

        AlertService::updated();

        return redirect()->back();
    }
}
