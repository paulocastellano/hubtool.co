<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Tool;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {

        $tools = Tool::published()
            ->with('categories')
            ->orderBy('published_at', 'desc')
            ->limit(30)
            ->get()
            ->groupBy(function ($tool) {
                return \Carbon\Carbon::parse($tool->published_at)->format('d-m-Y');
            });

        return Inertia::render('Home', [
            'tools' => $tools,
        ]);
    }
}
