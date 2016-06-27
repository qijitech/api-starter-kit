<?php namespace Api\StarterKit\Providers;

use Dingo\Api\Provider\LumenServiceProvider as DingoLumenServiceProvider;
use Mnabialek\LaravelSqlLogger\Providers\ServiceProvider as LaravelSqlLoggerProvider;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Providers\LumenServiceProvider as JWTLumenServiceProvider;

class LumenServiceProvider extends ApiStarterServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // merge consts config
    $this->app->configure('consts');
    $path = realpath(__DIR__ . '/../Config/config.php');
    $this->mergeConfigFrom($path, 'consts');

    $this->app->configure('auth');
    // make auth config
    $path = realpath(__DIR__ . '/../Config/auth.php');
    $this->app->make('config')->set('auth', require $path);

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

    parent::register();
  }
}