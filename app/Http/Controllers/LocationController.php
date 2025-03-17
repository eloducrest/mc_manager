<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Inertia\Inertia;
use Inertia\Response;

class LocationController extends Controller
{
  public function index(): Response
  {
    $locations = Location::with(['costumes.location', 'costumes.period', 'costumes.category'])
      ->get();

    return Inertia::render('Locations/LocationIndex', [
      'locations' => $locations
    ]);
  }

  public function show(Location $location): Response
  {
    return Inertia::render('Locations/LocationView', [
      'location' => $location->load(['costumes.location', 'costumes.period', 'costumes.category'])
    ]);
  }
}
