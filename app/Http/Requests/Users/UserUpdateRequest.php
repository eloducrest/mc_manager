<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    $rules = [
      'id' => ['required', 'integer', 'exists:users,id'],
      'lastname' => ['required', 'string', 'max:255'],
      'firstname' => ['required', 'string', 'max:255'],
      'role' => ['required', 'string', 'max:255'],
      'function' => ['required', 'string', 'max:255'],
      'email' => ["required", "email", "unique:users,email,$this->id,id"],
      'tel' => ['required', 'string', 'max:255'],
      'img_profile' => ['nullable', 'string', 'max:255'],
    ];

    if ($this->hasFile('img_profile')) {
      $rules['img_profile'] = ['image'];
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
      'lastname.required' => 'Le nom de famille est obligatoire',
      'firstname.required' => 'Le Prénom est obligatoire',
      'role.required' => 'Le rôle est obligatoire',
      'function.required' => 'La fonction est obligatoire',
      'email' => [
        'required' => 'L\'email est obligatoire',
        'email' => 'L\'email doit être valide (ex: test@gmail.com)',
        'unique' => 'L\'email est déjà prise',
      ],
      'tel.required' => 'Le n° de téléphone est obligatoire',
      'img_profile.image' => 'L\'image doit être une image (jpg, jpeg, png, bmp, gif, svg, ou webp)',
    ];
  }
}
