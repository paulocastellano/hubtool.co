<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return Inertia::render('Account/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'hasPassword' => $request->user()->password ? true : false,
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->photo) {
            $request->user()->photo = $request->file('photo')->storePubliclyAs('users', Str::uuid() . '.' . $request->file('photo')->extension());
        }

        $request->user()->save();

        session()->flash('flash.banner', 'Profile updated');
        session()->flash('flash.bannerStyle', 'success');

        return back();
    }

    public function deletePhoto(Request $request)
    {
        $user = $request->user();
        $user->photo = null;
        $user->save();

        session()->flash('flash.banner', 'Photo deleted');
        session()->flash('flash.bannerStyle', 'success');

        return back();
    }

    public function updatePassword(Request $request)
    {
        // user
        $user = auth()->user();

        Validator::make($request->all(), [
            'current_password' => ['nullable', 'string', 'current_password:web', Rule::requiredIf($user->password ? true : false)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword');

        // user
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('flash.banner', 'Password updated.');
        session()->flash('flash.bannerStyle', 'success');

        return back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        // user
        $user = auth()->user();

        // delete tools
        foreach ($user->tools as $tool) {
            $tool->delete();
        }

        // delete user
        $user->delete();

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('flash.banner', 'Your account has been successfully deleted.');
        session()->flash('flash.bannerStyle', 'success');

        return Redirect::to('/');
    }
}
