<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class KonfigurationController extends Controller
{
    public function index()
    {
        $currentLevel = session('level');

        return view('settings.index', [
            'currentLevel' => $currentLevel,
            'pageTitle' => 'Konfigurasi',
        ]);
    }
}
