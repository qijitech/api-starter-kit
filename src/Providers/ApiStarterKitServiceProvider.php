<?php
namespace Api\StarterKit\Providers;

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