<?php namespace Api\StarterKit\Providers;

use Dingo\Api\Provider\LaravelServiceProvider as DingoLaravelServiceProvider;
use Tymon\JWTAuth\Providers\LaravelServiceProvider as JWTLaravelServiceProvider;

class LaravelServiceProvider extends ApiStarterServiceProvider
{

  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    $this->publishConfigs();

    parent::boot();
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $path = realpath(__DIR__ . '/../Config/jwt.php');
    $this->mergeConfigFrom($path, 'jwt');

    $this->registerProvider();

    parent::register();
  }

  /**
   * register providers
   */
  private function registerProvider()
  {
    $this->app->register(JWTLaravelServiceProvider::class);
    $this->app->register(DingoLaravelServiceProvider::class);
  }

  /**
   * Publish config file.
   */
  private function publishConfigs()
  {
    $this->publishes([
      __DIR__ . '/../Config/config.php' => config_path('consts.php'),
    ]);
  }

}