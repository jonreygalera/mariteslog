<?php

namespace Jonre\Mariteslog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class MariteslogServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    $this->bootRoutes();
  }

  public function bootRoutes()
  {      
    Route::group($this->apiRouteConfiguration(), function() {
      $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    });
  }


  protected function apiRouteConfiguration()
  {
    return [
      'prefix' => 'api/mariteslog'
    ];
  }
}
