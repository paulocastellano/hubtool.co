<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Requests\Tool\CreateRequest;
use App\Http\Requests\Tool\UpdateRequest;

use App\Enums\Tool\Status as ToolStatus;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index(Request $request): Response
    {
        $tools = Tool::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

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
            'photo' => $request->file('photo')->storePubliclyAs('tools', Str::uuid() . '.' . $request->file('photo')->extension()),
            'website' => $request->website,
            'headline' => $request->headline,
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
            'status' => ToolStatus::STATUS_PENDING,
            'submitted_at' => now(),
            'queue_priority' => false,
        ]);

        session()->flash('flash.banner', 'Your Tool has been submitted for review.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('tools.index'));
    }

    public function edit($id, Request $request): Response
    {
        $tool = Tool::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        return Inertia::render('Tool/Edit', [
            'tool' => $tool
        ]);
    }

    public function update($id, UpdateRequest $request)
    {
        $tool = Tool::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        $tool->update([
            'name' => $request->name,
            'slug' => Str::uuid(),
            'website' => $request->website,
            'headline' => $request->headline,
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
            'status' => ToolStatus::STATUS_PENDING,
            'submitted_at' => now(),
        ]);

        if($request->hasFile('photo')) {
            $tool->update([
                'photo' => $request->file('photo')->storePubliclyAs('tools', Str::uuid() . '.' . $request->file('photo')->extension()),
            ]);
        }

        session()->flash('flash.banner', 'Your Tool need to be reviewed again.');
        session()->flash('flash.bannerStyle', 'success');

        return back();
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
        $tool = Tool::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        $tool->delete();

        session()->flash('flash.banner', 'Your Tool has been deleted.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('tools.index'));
    }

    public function imageHandler(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->storePubliclyAs('markdown-upload', Str::uuid() . '.' . $request->file('image')->extension());

        return response()->json(['status' => 'success', 'path' => Storage::url($path)]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string'
        ]);

        $tools = Tool::published()
        ->where(function ($query) use ($request) {
            $query->where('name', 'ILIKE', '%' . $request->q . '%');
            $query->orWhere('headline', 'ILIKE', '%' . $request->q . '%');
        })
        ->orderBy('published_at', 'desc')
        ->limit(5)
        ->get();

        return response()->json($tools);
    }
}
