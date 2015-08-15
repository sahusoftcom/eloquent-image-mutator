<?php

namespace SahusoftCom\EloquentImageMutator;

use Illuminate\Support\ServiceProvider;

class EloquentImageMutatorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/image.php' => config_path('image.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/image.php', 'image');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->handleConfig();
    }

    protected function handleConfig()
    {
        $packageConfig = __DIR__.'/config/image.php';
        $destinationConfig = config_path('image.php');
        
        $this->publishes(array(
            $packageConfig => $destinationConfig,
        ));
    }
}
