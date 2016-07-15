<?php namespace Api\StarterKit\Providers;

use Api\StarterKit\Serializer\ApiSerializer;
use Api\StarterKit\Utils\ApiResponse;
use Dingo\Api\Auth\Provider\JWT as DingoJWTProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

abstract class ApiStarterServiceProvider extends ServiceProvider
{

  use ApiResponse;

  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    // register common validator
    $this->registerValidator();
  }

  public function register()
  {
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

    $this->registerExceptionHandler();
  }

  private function registerExceptionHandler()
  {
    $this->app['api.exception']->register(function (ModelNotFoundException $exception) {
      return $this->respondNotFound($exception->getMessage());
    });
  }

  private function registerValidator()
  {
    Validator::extend('phone', function ($attribute, $value, $parameters) {
      return preg_match("/^1[0-9]{2}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $value);
    });
  }

}