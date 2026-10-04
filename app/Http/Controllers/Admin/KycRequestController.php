<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KycRequestController extends Controller
{
    //

    function index(): View
    {
        return view('Admin.kyc.index');
    }
}
