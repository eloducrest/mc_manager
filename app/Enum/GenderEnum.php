<?php

namespace App\Enum;

enum GenderEnum: string
{
  case MAN    = 'Homme';
  case WOMAN  = 'Femme';
  case BOY    = 'Garçon';
  case GIRL   = 'Fille';

  public static function toArray(): array
  {
    $array = [];
    foreach (self::cases() as $case) {
      $array[] =['name' => $case->value];
    }
    return $array;
  }
}
