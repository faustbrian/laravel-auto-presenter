<?php

namespace BrianFaust\Tests\AutoPresenter;

use BrianFaust\AutoPresenter\AutoPresenterServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return AutoPresenterServiceProvider::class;
    }
}
