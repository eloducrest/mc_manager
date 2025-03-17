<?php

namespace App\Http\Requests\Costumes;

use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CostumeUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    $rules = [
      'id' => ['required', 'integer', 'exists:costumes,id'],
      'period_id' => ['required', 'integer', 'exists:periods,id'],
      'costumes_category_id' => ['required', 'integer', 'exists:costumes_categories,id'],
      'size_id' => ['required', 'integer', 'exists:sizes,id'],
      'location_id' => ['required', 'numeric', 'exists:locations,id'],
      'img_url' => ['nullable', 'string', 'max:255'],
      'number' => ['required', 'string', 'max:255', "unique:costumes,number,$this->id,id"],
      'name' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string', 'max:255'],
      'condition' => ['required', 'string', Rule::enum(CostumeConditionEnum::class)],
      'gender' => ['required', 'string', Rule::enum(GenderEnum::class)],
      'deposit' => ['required', 'integer'],
      'type' => ['required'],
      'is_to_be_repaired' => ['nullable', 'boolean'],
    ];

    if ($this->hasFile('img_url')) {
      $rules['img_url'] = ['image'];
    }

    return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'period_id' => [
        'required' => 'La période est obligatoire',
        'exists' => 'La période n\'existe pas',
      ],
      'costumes_category_id' => [
        'required' => 'La catégorie est obligatoire',
        'exists' => 'La catégorie n\'existe pas',
      ],
      'size_id' => [
        'required' => 'La taille est obligatoire',
        'exists' => 'La taille n\'existe pas',
      ],
      'location_id' => [
        'required' => 'L\'emplacement est obligatoire',
        'exists' => 'L\'emplacement n\'existe pas',
      ],
      'img_url.image' => 'L\'image doit être une image (jpg, jpeg, png, bmp, gif, svg, ou webp)',
      'number' => [
        'required' => 'Le numéro est obligatoire',
        'unique' => 'Le numéro doit être unique',
      ],
      'name.required' => 'Le nom est obligatoire',
      'description.required' => 'La description est obligatoire',
      'gender.required' => 'La description est obligatoire',
      'deposit.required' => 'La description est obligatoire',
    ];
  }
}
