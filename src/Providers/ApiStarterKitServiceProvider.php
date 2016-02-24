<?php
namespace Api\StarterKit\Providers;

use Api\StarterKit\Serializer\ApiSerializer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ApiStarterKitServiceProvider extends ServiceProvider
{

  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    $this->publishConfigs();

    // register common validator
    $this->registerValidator();
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $this->registerProvider();

    // set api serializer
    $this->app['api.transformer']
      ->getAdapter()
      ->getFractal()
      ->setSerializer(new ApiSerializer);
  }

  /**
   * register providers
   */
  private function registerProvider()
  {
    $this->app->register(\Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class);
    $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);
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

  private function registerValidator()
  {
    Validator::extend('phone', function ($attribute, $value, $parameters) {
      return preg_match("/^1[0-9]{2}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $value);
    });
  }

}