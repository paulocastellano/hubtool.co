<?php

namespace App\Http\Requests\Tool;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules\Enum;
use App\Enums\Tool\Pricing as ToolPricing;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'website' => ['required', 'string', 'max:255', 'url'],
            'headline' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'pricing' => [new Enum(ToolPricing::class)],
            'twitter' => ['nullable', 'string', 'max:255', 'url'],
            'facebook' => ['nullable', 'string', 'max:255', 'url'],
            'instagram' => ['nullable', 'string', 'max:255', 'url'],
            'youtube' => ['nullable', 'string', 'max:255', 'url'],
            'linkedin' => ['nullable', 'string', 'max:255', 'url'],
            'github' => ['nullable', 'string', 'max:255', 'url'],
            'support_email' => ['nullable', 'string', 'max:255', 'email'],
            'apple_store_link' => ['nullable', 'string', 'max:255', 'url'],
            'google_store_link' => ['nullable', 'string', 'max:255', 'url'],
        ];
    }
}
