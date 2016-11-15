<?php

namespace BrianFaust\AutoPresenter;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractPresenter
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * @var \BrianFaust\AutoPresenter\Decorator
     */
    private $decorator;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \BrianFaust\AutoPresenter\Decorator $decorator
     */
    public function __construct(Model $model, Decorator $decorator)
    {
        $this->model = $model;
        $this->decorator = $decorator;
    }
}
