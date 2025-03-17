<?php

namespace App\Http\Requests\Actors;

use Illuminate\Foundation\Http\FormRequest;

class ActorUpdateRequest extends FormRequest
{
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
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'id' => ['required', 'integer', 'exists:actors,id'],
      'lastname' => ['required', 'string', 'max:255'],
      'firstname' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', "unique:actors,email,$this->id,id"],
      'tel' => ['required', 'string'],
      'address' => ['required', 'string', 'max:255'],
      'zip_code' => ['required', 'string', 'max:5'],
      'city' => ['required', 'string', 'max:255'],
      'size' => ['nullable', 'string', 'max:255'],
      'shoe_size' => ['nullable', 'string', 'max:255'],
      'is_volunteer' => ['nullable', 'boolean'],
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
      'lastname.required' => 'Le nom de famille est obligatoire',
      'firstname.required' => 'Le prénom est obligatoire',
      'email' => [
        'required' => "L'email est obligatoire",
        'email' => "L'email doit être valide",
        'unique' => "L'email est déjà prise"
      ],
      'tel.required' => 'Le numéro de téléphone est obligatoire',
      'address.required' => "L'adresse est obligatoire",
      'zip_code' => [
        'required' => 'Le code postal est obligatoire',
        'max' => 'Le code postal doit contenir 5 chiffres',
      ],
      'city.required' => 'La ville est obligatoire',
    ];
  }
}
