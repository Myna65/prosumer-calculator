<?php


namespace Myna65\ProsumerCalculator\DependencyInjection;


class ContainerProvider extends ContainerAware
{
    public function getService($name) {
        return $this->get($name);
    }
}