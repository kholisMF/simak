<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(session()->all());

        $adminName = Session::get('nama');

        return view('/dashboard', [
            'adminName' => $adminName,
            'pageTitle' => 'Dashboard',
        ]);
    }
}
