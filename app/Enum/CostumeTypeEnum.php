<?php

namespace App\Enum;

enum CostumeTypeEnum: string
{
  case ACCESSORY    = 'Accessoire';
  case COSTUME      = 'Costume';

  public static function toArray(): array
  {
    $array = [];
    foreach (self::cases() as $case) {
      $array[] =['name' => $case->value];
    }
    return $array;
  }
}
