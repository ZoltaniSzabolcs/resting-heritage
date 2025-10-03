<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'grave_id' => $this->graveId,
            'birth_date' => $this->birthDate,
            'death_date' => $this->deathDate,
            'birth_place' => $this->birthPlace,
            'death_place' => $this->deathPlace,
            'image_url' => $this->imageUrl,
        ]);
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
            'initials' => ['nullable', 'string', 'max:255'],
            'grave_id' => ['required', 'exists:graves,id'],
            'birth_date' => ['nullable','date'],
            'death_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'death_place' => ['nullable', 'string', 'max:255'],
            'biography' => ['nullable', 'string', 'max:1023'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'url'],
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => "peron first name",
            'last_name' => "person last name",
            'initials' => "person initials",
            'grave_id' => "grave",
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
