<?php

namespace App\Http\Controllers;

use App\Exports\ActorsExport;
use App\Exports\CostumesExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportsController extends Controller
{
    public function actors(): BinaryFileResponse
    {
      return Excel::download(new ActorsExport, 'actors.xlsx');
    }

    public function costumes(): BinaryFileResponse
    {
      return Excel::download(new CostumesExport(), 'costumes.xlsx');
    }
}
