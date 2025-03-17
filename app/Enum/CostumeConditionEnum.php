<?php

namespace App\Enum;

enum CostumeConditionEnum: string
{
  case PERFECT    = 'Parfait';
  case GOOD       = 'Bien';
  case BAD        = 'Mauvais';
  case DEPLORABLE = 'Déplorable';

  public static function toArray(): array
  {
    $array = [];
    foreach (self::cases() as $case) {
      $array[] =['name' => $case->value];
    }
    return $array;
  }
}
