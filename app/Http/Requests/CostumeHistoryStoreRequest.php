<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CostumeHistoryStoreRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      "*.costume_id" => ['required', 'integer', Rule::exists('costumes', 'id')],
      "*.actor_id" => ['required', 'integer', Rule::exists('actors', 'id')],
      "*.amount_deposit" => ['required', 'numeric']
    ];
  }
}
