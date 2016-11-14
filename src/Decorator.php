<?php

namespace BrianFaust\AutoPresenter;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

class Decorator
{
    /**
     * Namepsaces checked for proprietary presenters.
     *
     * @var string[]
     */
    protected $proprietaryNamespaces = ['App\\Presenters\\'];

    /**
     * Generic presenter, that will be used if no proprietary presenter is found.
     *
     * @var string
     */
    protected $genericPresenter = Presenter::class;

    /**
     * Set generic presenter class.
     *
     * @param string $class
     */
    public function setGenericPresenter($class)
    {
        $this->genericPresenter = $class;
    }

    /**
     * Add namespace for proprietary presenter lookup.
     *
     * @param string $namespace
     */
    public function addNamespace($namespace)
    {
        array_unshift($this->proprietaryNamespaces, $namespace);
    }

    /**
     * Decorate a model with a presenter class.
     *
     * @param mixed $model
     *
     * @return \BrianFaust\AutoPresenter\Presenter
     */
    public function decorate($model)
    {
        if ($model instanceof Collection || is_array($model) || $model instanceof Paginator) {
            return $this->decorateMany($model);
        }

        if (!$model instanceof Presentable) {
            return $model;
        }

        $presenter = $this->genericPresenter;

        foreach ($this->proprietaryNamespaces as $namespace) {
            if (class_exists($proprietary = $namespace.class_basename($model))) {
                $presenter = $proprietary;
                break;
            }
        }

        return new $presenter($model, $this);
    }

    /**
     * Decorate many models with a presenter class.
     *
     * @param mixed $models
     *
     * @return \Illuminate\Support\Collection
     */
    public function decorateMany($models)
    {
        foreach ($models as $key => $model) {
            if ($model instanceof Presentable) {
                $models[$key] = $this->decorate($model);
            }
        }

        return $models;
    }
}
