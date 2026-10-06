<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Servieces\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KycRequestController extends Controller
{
    //

    function index(): View
    {
        $kycRequests = Kyc::paginate(25);
        return view('Admin.kyc.index', compact('kycRequests'));
    }

    function show(Kyc $kyc_request): View
    {
        return view('Admin.kyc.show', compact('kyc_request'));
    }

    function download(Kyc $kyc_request): StreamedResponse
    {
        return Storage::disk('local')->download($kyc_request->document_scan_copy);
    }

    function update(Kyc $kyc_request, Request $request): RedirectResponse
    {
        $kyc_request->update([
            'status' => $request->status,
        ]);

        AlertService::updated();

        return redirect()->route('admin.kyc.index');
    }
}
