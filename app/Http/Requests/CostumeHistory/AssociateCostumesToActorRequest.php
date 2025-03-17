<?php

namespace App\Http\Requests\CostumeHistory;

use Illuminate\Foundation\Http\FormRequest;

class AssociateCostumesToActorRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return auth()->check();
  }

  /**
   * Prepare the data for validation.
   */
  protected function prepareForValidation(): void
  {
    /*dd($this);
    $this->merge([
      'slug' => Str::slug($this->slug),
    ]);*/
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'actor_id' => 'required|integer|exists:actors,id',
      'costumes' => 'required|array',
      'costumes.*.costume_id' => 'required|integer|exists:costumes,id',
      'costumes.*.amount_deposit' => 'required|numeric',
      'costumes.*.take_condition' => 'required|string',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'actor_id' => [
        'required' => 'Aucun acteur sélectionné',
        'exists' => 'L\'acteur sélectionné n\'existe pas',
      ],
      'costumes.required' => 'Vous devez sélectionner au moins un costume',
      'costumes.*.costume_id' => [
        'required' => 'Le costume est obligatoire',
        'exists' => 'Le costume sélectionné n\'existe pas',
      ],
      'costumes.*.amount_deposit' => 'Le montant est obligatoire (mettre à 0 si pas de caution donnée)',
    ];
  }
}
