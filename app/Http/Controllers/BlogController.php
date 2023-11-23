<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function home(Request $request): Response
    {
        $query = BlogPost::published()->latest();

        // search
        if ($request->q) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'ILIKE', '%' . $request->q . '%');
            });
        }

        $blogPosts = $query->paginate(12);

        return Inertia::render('Blog/Home', [
            'blogPosts' => $blogPosts,
        ]);
    }

    public function show($slug): Response
    {
        return Inertia::render('Blog/Show', [
            'blogPost' => BlogPost::where('slug', $slug)
                ->with('user:id,name,photo,job_description')
                ->with('blog_category')
                ->published()
                ->firstOrFail(),
        ]);
    }

    public function category($slug, Request $request): Response
    {
        $blogPosts = BlogPost::withWhereHas('blog_category', fn ($query) => $query->where('slug', $slug))
            ->with('user:id,name,photo')
            ->with('blog_category')
            ->published()
            ->latest()
            ->paginate(10);

        return Inertia::render('Blog/Home', [
            'blogPosts' => $blogPosts
        ]);
    }
}
