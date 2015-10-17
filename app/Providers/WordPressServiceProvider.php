<?php

namespace CMV\Providers;

use Illuminate\Support\ServiceProvider;

class WordPressServiceProvider extends ServiceProvider
{

    protected $bootstrapFilePath = '../wp/wp-load.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {   
        if(\File::exists($this->bootstrapFilePath))
        {
            
            require_once $this->bootstrapFilePath;

        }
    }
}
