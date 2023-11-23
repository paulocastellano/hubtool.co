<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Requests\Tool\CreateRequest;

use App\Enums\Tool\Status as ToolStatus;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index(Request $request): Response
    {
        $tools = Tool::where('user_id', auth()->user()->id)->get();

        return Inertia::render('Tool/Index', [
            'tools' => $tools
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Tool/Create');
    }

    public function store(CreateRequest $request)
    {
        $tool = Tool::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'slug' => Str::uuid(),
            'photo' => $request->file('photo')->storePubliclyAs('users', Str::uuid() . '.' . $request->file('photo')->extension()),
            'website' => $request->website,
            'brief' => $request->brief,
            'description' => $request->description,
            'pricing' => $request->pricing,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'support_email' => $request->support_email,
            'apple_store_link' => $request->apple_store_link,
            'google_store_link' => $request->google_store_link,
            'status' => ToolStatus::STATUS_PENDING
        ]);

        session()->flash('flash.banner', 'Your Tool has been submitted for review.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('tools.index'));
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Tool/Edit');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function show($slug, Request $request): Response
    {

        $tool = Tool::where('slug', $slug)->firstOrFail();

        $relatedTools = Tool::published()
            ->withWhereHas('categories', function ($query) use ($tool) {
                $query->whereIn('categories.id', $tool->categories->pluck('id'));
            })
            ->where('id', '!=', $tool->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return Inertia::render('Tool/Show', [
            'tool' => $tool,
            'relatedTools' => $relatedTools
        ]);
    }

    public function destroy($id, Request $request)
    {

    }
}
