<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'test' => 'test',
          'id' => $this->id,
          'lastname' => $this->lastname,
          'firstname' => $this->firstname,
          'email' => $this->email,
          'tel' => $this->tel,
          'address' => $this->address,
          'zip_code' => $this->zip_code,
          'city' => $this->city,
          'is_volunteer' => (bool) $this->is_volunteer,
          'size' => $this->size,
          'shoe_size' => $this->shoe_size,
          'current_costumes' => CostumeHistoryResource::collection($this->currentCostumes),
          'past_costumes' => CostumeHistoryResource::collection($this->pastCostumes),
        ];
    }
}
