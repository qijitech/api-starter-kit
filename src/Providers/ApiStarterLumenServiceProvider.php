<?php

namespace Api\StarterKit\Providers;

use Api\StarterKit\Serializer\ApiSerializer;
use Dingo\Api\Auth\Provider\JWT as DingoJWTProvider;
use Dingo\Api\Provider\LumenServiceProvider as DingoLumenServiceProvider;
use Illuminate\Support\ServiceProvider;
use Mnabialek\LaravelSqlLogger\Providers\ServiceProvider as LaravelSqlLoggerProvider;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Providers\LumenServiceProvider as JWTLumenServiceProvider;

class ApiStarterLumenServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->configure('config');
    $this->app->configure('consts');
    $this->app->configure('auth');

    $path = realpath(__DIR__ . '/../Config/lumen_auth.php');
    $this->mergeConfigFrom($path, 'auth');

    $path = realpath(__DIR__ . '/../Config/config.php');
    $this->mergeConfigFrom($path, 'consts');

    //
    $this->app->withFacades();
    $this->app->withEloquent();

    $this->app->alias('JWTAuth', JWTAuth::class);
    /** This gives you finer control over the payloads you create if you require it.
     *  Source: https://github.com/tymondesigns/jwt-auth/wiki/Installation
     */
    $this->app->alias('JWTFactory', JWTFactory::class);

    $this->app->register(JWTLumenServiceProvider::class);
    $this->app->register(DingoLumenServiceProvider::class);
    $this->app->register(LaravelSqlLoggerProvider::class);

    // set api serializer
    if (config('api.transformer')) {
      $this->app['api.transformer']
        ->getAdapter()
        ->getFractal()
        ->setSerializer(new ApiSerializer);
    }

    $this->app['api.auth']->extend('jwt', function ($app) {
      return new DingoJWTProvider($app['Tymon\JWTAuth\JWTAuth']);
    });
  }
}