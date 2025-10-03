<?php

namespace App\Http\Requests;

use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Http\Requests\TransformsGeojsonGeometry;
use Clickbar\Magellan\Rules\GeometryGeojsonRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGraveRequest extends FormRequest
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
            'cemetery_id' => ['required', 'exists:cemeteries,id'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', new GeometryGeojsonRule([Point::class])]
        ];
    }

    public function geometries(): array
    {
        return ['location'];
    }

    public function attributes()
    {
        return [
            'name' => 'grave name',
            'cemetery_id' => 'cemetery',
            'location' => 'grave location'
        ];
    }
}
