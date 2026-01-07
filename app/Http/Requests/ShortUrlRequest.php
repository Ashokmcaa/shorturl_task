<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShortUrlRequest extends FormRequest
{

    public function authorize(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $role = Auth::user()->role->name;


        if (in_array($role, ['Admin', 'Member', 'SuperAdmin'])) {
            return false;
        }

        return false;
    }


    public function rules(): array
    {
        return [
            'original_url' => 'required|url|max:2048',
        ];
    }


    public function messages(): array
    {
        return [
            'original_url.required' => 'Original URL is required',
            'original_url.url'      => 'Please provide a valid URL',
        ];
    }
}
