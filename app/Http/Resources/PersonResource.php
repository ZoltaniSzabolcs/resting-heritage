<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'graveId' => $this->grave_id,
            'firstName' =>$this->first_name,
            'lastName' =>$this->last_name,
            'initials' =>$this->initials,
            'birthDate' => $this->birth_date,
            'deathDate' => $this->death_date,
            'birthPlace' => $this->birth_place,
            'deathPlace' => $this->death_place,
            'biography' =>$this->biography,
            'occupation' =>$this->occupation,
            'imageUrl' =>$this->image_url,
        ];
    }
}
