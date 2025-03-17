<?php

namespace App\Providers;

use App\Search\All;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    Inertia::share('scoutID', config('scout.algolia.id'));
    Inertia::share('scoutSecret', config('scout.algolia.secret'));
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    if ($this->app->isProduction()) {
      \Illuminate\Support\Facades\URL::forceScheme('https');
    }
    All::bootSearchable();
  }
}
