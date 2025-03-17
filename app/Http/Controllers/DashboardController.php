<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Costume;
use App\Models\CostumesCategory;
use App\Models\Period;
use App\Models\Size;
use App\Repositories\AccessoriesRepository;
use App\Repositories\CostumesRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function __construct(
    protected CostumesRepository    $costumesRepository,
    protected AccessoriesRepository $accessoriesRepository
  ){}

  public function index()
  {
    return Inertia::render('Dashboard', [
      'accessories' => $this->accessoriesRepository->query()
        ->orderByDesc('created_at')
        ->get(),
      'costumes' => $this->costumesRepository->query()
        ->orderByDesc('created_at')
        ->get(),
      'repairs' => Costume::where('is_to_be_repaired', true)
        ->with('costumeHistories')
        ->get(),
      'actors' => Actor::all(),
      'costumes_settings' => [
        'periods' => Period::all(),
        'categories' => CostumesCategory::all(),
        'sizes' => Size::all()
      ]
    ]);
  }
}
