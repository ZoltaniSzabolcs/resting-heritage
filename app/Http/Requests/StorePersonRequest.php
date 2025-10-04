<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'initials' => ['nullable', 'string', 'max:10'],
            'grave_id' => ['required', 'exists:graves,id'],
            'birth_date' => ['nullable','date'],
            'death_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string'],
            'death_place' => ['nullable', 'string'],
            'biography' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url'],
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => "peron first name",
            'last_name' => "person last name",
            'grave_id' => "grave",
            'full_name' => "person full name",
            'birth_date' => "person birth date",
            'death_date' => "person death date",
            'birth_place' => "person birth place",
            'death_place' => "person death place",
            'biography' =>  "person biography",
            'occupation' => "person occupation",
            'image_url' => "person image url",
        ];
    }
}
