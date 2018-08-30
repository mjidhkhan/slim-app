<?php

namespace App\Controller;

class Controller
{
    protected $container;

    public function __construct($container)
    {
        return $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }

        return $props;
    }
}
