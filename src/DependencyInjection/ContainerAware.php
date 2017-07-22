<?php

namespace Myna65\ProsumerCalculator\DependencyInjection;

use Pimple\Container;

class ContainerAware {

    private static $container;

    public static function setContainer($container) {
        self::$container = $container;
    }

    public function __construct() {
        if(self::$container === null) {
            self::$container = new Container();
        }
    }

    protected function get($service) {
        return self::$container[$service];
    }

    public static function getStatic($service) {
        return self::$container[$service];
    }

}