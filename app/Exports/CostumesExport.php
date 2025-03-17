<?php

namespace App\Exports;

use App\Models\Costume;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CostumesExport implements FromCollection
{
  /**
   * @return Collection
   */
  public function collection(): Collection
  {
    return Costume::withTrashed()->get();
  }
}
