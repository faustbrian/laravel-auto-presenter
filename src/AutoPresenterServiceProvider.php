<?php

namespace BrianFaust\AutoPresenter;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class AutoPresenterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Factory $view)
    {
        $view->composer('*', function ($view) {
            $data = array_merge($view->getFactory()->getShared(), $view->getData());

            foreach ($data as $var => $model) {
                $view[$var] = $this->app['presenters']->decorate($model);
            }
        }, 999);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('presenters', function () {
            return new Decorator();
        });
    }
}
