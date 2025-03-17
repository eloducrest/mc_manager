<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait GlobalControllerTrait
{
  protected function setImageUrl(UploadedFile|string|null $file, string $name): string
  {
    if ($file && $file instanceof UploadedFile) {
      $ext = $file->extension();
      $path = $file->storeAs('costumes', Str::slug($name) . '.' . $ext, 'public');

      return '/storage/' . $path;
    } else {
      return '/image/empty.jpg';
    }

  }
}
