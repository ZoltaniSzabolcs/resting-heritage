<?php

namespace App\Http\Requests;

use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Http\Requests\TransformsGeojsonGeometry;
use Clickbar\Magellan\Rules\GeometryGeojsonRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCemeteryRequest extends FormRequest
{
    use TransformsGeojsonGeometry;

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
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1023'],
            'entrance' => ['required', new GeometryGeojsonRule([Point::class])],
            'center' => ['required', new GeometryGeojsonRule([Point::class])],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'cemetery name',
            'city' => 'cemetery city',
            'description' => 'cemetery description',
            'entrance' => 'cemetery entrance',
            'center' => 'cemetery center',
        ];
    }

    public function geometries(): array
    {
        return ['entrance', 'center'];
    }
}
