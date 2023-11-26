<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

use App\Models\Category;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => function () use ($request) {
                    if (!$request->user()) {
                        return;
                    }

                    return array_merge($request->user()->toArray(), array_filter([
                        'tools' => $request->user()->tools,
                    ]));
                }
            ],

            'cache' => [
                'featured_categories' => fn () => Category::where('is_featured', true)->orderBy('name', 'asc')->get(),
            ],

            'flash' => $request->session()->get('flash', []),
            'env' => config('app.env'),
            'locale' => app()->getLocale(),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
