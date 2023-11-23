<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Tool;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    public function show($slug, Request $request): Response
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $tools = Tool::published()
            ->withWhereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category->id);
            })
            ->orderBy('published_at', 'desc')
            ->get();

        return Inertia::render('Category/Show', [
            'category' => $category,
            'tools' => $tools
        ]);
    }
}
