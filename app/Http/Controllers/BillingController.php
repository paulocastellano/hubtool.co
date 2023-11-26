<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Enums\Tool\Status as ToolStatus;

class BillingController extends Controller
{
    public function billingPortal(Request $request)
    {
        return Inertia::location($request->user()->redirectToBillingPortal(route('tools.index')));
    }

    public function skipeLine($toolId, Request $request)
    {
        return $request->user()->checkout([env('STRIPE_PRICE_SKIP_LINE') => 1], [
            'success_url' => route('billing.skip-line-success', $toolId),
            'cancel_url' => route('tools.index'),
        ]);
    }

    public function skipeLineSuccess($toolId, Request $request)
    {
        $tool = $request->user()->tools()->find($toolId);

        $tool->update([
            'updated_at' => now(),
            'queue_priority' => true,
            'status' => ToolStatus::STATUS_PENDING,
        ]);

        session()->flash('flash.banner', 'You are now in the front of the line.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('tools.index');
    }
}
