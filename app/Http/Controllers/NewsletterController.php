<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Newsletter');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $request->email,
            'is_subscribed' => true,
        ]);

        return redirect()->back()->with('success', 'Thanks for subscribing!');
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:newsletters,email',
        ]);

        Newsletter::where('email', $request->email)->update([
            'is_subscribed' => false,
        ]);

        return redirect()->back()->with('success', 'You have been unsubscribed!');
    } 
}
