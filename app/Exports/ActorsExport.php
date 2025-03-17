<?php

namespace App\Exports;

use App\Models\Actor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ActorsExport implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping, WithStyles
{
  /**
   * @return Collection
   */
  public function collection(): Collection
  {
    return Actor::all();
  }

  public function headings(): array
  {
    return [
      /* A*/ 'NOM',
      /* B*/ 'Prénom',
      /* C*/ 'Email',
      /* D*/ 'Téléphone',
      /* E*/ 'Adresse',
      /* F*/ 'Code Postal',
      /* G*/ 'Ville',
      /* H*/ 'Bénévole',
      /* I*/ 'Taille',
      /* J*/ 'Taille chaussure',
      /* K*/ 'Supprimé le',
      /* L*/ 'Créé le',
      /* M*/ 'Mis à jour le'
    ];
  }

  public function columnFormats(): array
  {
    return [
      'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    ];
  }

  public function map(/** @var Actor $actor */ $actor): array
  {
    return [
      /* A*/ $actor->lastname,
      /* B*/ $actor->firstname,
      /* C*/ $actor->email,
      /* D*/ $actor->tel,
      /* E*/ $actor->address,
      /* F*/ $actor->zip_code,
      /* G*/ $actor->city,
      /* H*/ $actor->is_volunteer ? 'Oui' : 'Non',
      /* I*/ $actor->size,
      /* J*/ $actor->shoe_size,
      /* K*/ $actor->deleted_at ? Date::dateTimeToExcel($actor->deleted_at) : '',
      /* L*/ Date::dateTimeToExcel($actor->created_at),
      /* M*/ Date::dateTimeToExcel($actor->updated_at),
    ];
  }

  public function styles(Worksheet $sheet): array
  {
    return [
      1 => [
        'font' => [
          'bold' => true,
          'size' => 14,
        ]
      ]
    ];
  }
}
