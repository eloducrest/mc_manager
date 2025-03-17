<?php

namespace App\Http\Requests\Costumes;

use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DissociateCostumeToActorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
          'costume_id' => ['required', 'integer', 'exists:costumes,id'],
          'actor_id' => ['required', 'integer', 'exists:actors,id'],
          'amount_returned_deposit' => ['required', 'integer'],
          'return_condition' => ['required', 'string', Rule::enum(CostumeConditionEnum::class)],
          'is_to_be_repaired' => ['boolean'],
          'comments' => ['nullable', 'string'],
        ];
    }
}
