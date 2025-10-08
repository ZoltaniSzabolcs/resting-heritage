<?php

namespace App\Http\Requests;

use Clickbar\Magellan\Data\Geometries\Polygon;
use Clickbar\Magellan\Http\Requests\TransformsGeojsonGeometry;
use Clickbar\Magellan\Rules\GeometryGeojsonRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGraveBoundaryRequest extends FormRequest
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
            'boundary' => ['required', new GeometryGeojsonRule([Polygon::class])],
        ];
    }

    public function geometries(): array
    {
        return ['boundary'];
    }
}
