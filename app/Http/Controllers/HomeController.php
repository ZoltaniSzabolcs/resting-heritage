<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index()
    {
        $cemeteries = Cemetery::limit(4)->get();

        return Inertia::render('Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'cemeteries' => $cemeteries,
        ]);
    }
}
