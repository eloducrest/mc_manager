<?php

namespace App\Http\Requests\Repairs;

use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ToBeRepairedRequest extends FormRequest
{
  public function authorize(): bool
  {
    return auth()->check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'costume_id' => ['required', 'integer', 'exists:costumes,id'],
      'condition_before_repair' => ['required', 'string', Rule::enum(CostumeConditionEnum::class)],
      'repair_comment' => ['required', 'string'],
    ];
  }
}
