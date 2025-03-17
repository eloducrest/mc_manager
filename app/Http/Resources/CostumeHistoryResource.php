<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CostumeHistoryResource extends JsonResource
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
        'actor_id' => $this->actor_id,
        'costume_id' => $this->costume_id,
        'amount_deposit' => $this->amount_deposit,
        'take_condition' => $this->take_condition,
        'return_condition' => $this->return_condition,
        'returned_at' => $this->returned_at,
        'amount_returned_deposit' => $this->amount_returned_deposit,
        'is_to_be_repaired' => (bool) $this->is_to_be_repaired,
        'comments' => $this->comments,
        'shoe_size' => $this->shoe_size,
        'costume_name' => $this->costume->name,
        'costume_number' => $this->costume->number
        //'current_costumes' => CostumeHistoryResource::collection($this->currentCostumes),
        //'past_costumes' => CostumeHistoryResource::collection($this->pastCostumes),
      ];
    }
}
