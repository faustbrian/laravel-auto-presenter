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

use Illuminate\Database\Eloquent\Model;

abstract class AbstractPresenter
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var \BrianFaust\AutoPresenter\Decorator
     */
    protected $decorator;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \BrianFaust\AutoPresenter\Decorator $decorator
     */
    public function __construct(Model $model, Decorator $decorator)
    {
        $this->model = $model;
        $this->decorator = $decorator;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->model->{$property};
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }
}
