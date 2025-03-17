<?php

namespace App\Http\Middleware;

use Algolia\ScoutExtended\Facades\Algolia;
use App\Enum\CostumeConditionEnum;
use App\Enum\GenderEnum;
use App\Models\CostumesCategory;
use App\Models\Location;
use App\Models\Period;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Determine the current asset version.
   */
  public function version(Request $request): string|null
  {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @return array<string, mixed>
   */
  public function share(Request $request): array
  {
    return [
      ...parent::share($request),
      'auth' => [
        'user' => $request->user(),
      ],
      'costume_settings' => [
        'periods' => Period::all(),
        'categories' => CostumesCategory::all(),
        'sizes' => Size::all(),
        'locations' => Location::all(),
        'genders' => GenderEnum::toArray(),
        'conditions' => CostumeConditionEnum::cases()
      ],
      //'searchKey' => Algolia::searchKey(User::class)
    ];
  }
}
