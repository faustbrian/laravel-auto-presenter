<?php

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
}
