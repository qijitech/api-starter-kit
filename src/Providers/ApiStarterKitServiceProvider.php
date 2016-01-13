<?php
namespace Api\StarterKit\Providers;

use Api\StarterKit\Serializer\ApiSerializer;
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

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // set api serializer
        $this->app['api.transformer']
            ->getAdapter()
            ->getFractal()
            ->setSerializer(new ApiSerializer);
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