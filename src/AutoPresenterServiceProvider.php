<?php

/*
 * This file is part of Eloquent Auto Presenter.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
    public function register(): void
    {
        $this->app->singleton('presenters', function () {
            return new Decorator();
        });
    }
}
