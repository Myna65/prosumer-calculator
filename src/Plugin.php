<?php

namespace Myna65\ProsumerCalculator;

use Myna65\ProsumerCalculator\DependencyInjection\ContainerBuilder;

/**
 * Class Plugin
 * @package Myna65\ProsumerCalculator
 *
 * Singleton class to manage plugin
 */
class Plugin
{
    /** @var Plugin */
    private static $instance;

    /**
     * Get Singleton
     *
     * @return Plugin
     */
    public static function getInstance() {
       if(self::$instance === null) {
           self::$instance = new Plugin();
       }
       return self::$instance;
    }

    private function __construct() {

        ContainerBuilder::build();

        AdminMenu::registerMenu();

    }


}