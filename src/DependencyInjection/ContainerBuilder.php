<?php


namespace Myna65\ProsumerCalculator\DependencyInjection;


use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Tools\Setup;
use Myna65\ProsumerCalculator\Service\DnoSerializerBuilder;
use Myna65\ProsumerCalculator\Service\FilesService;
use Myna65\ProsumerCalculator\Service\DatabaseService;
use Myna65\ProsumerCalculator\Service\FormFactoryBuilder;
use Myna65\ProsumerCalculator\Service\TablePrefix;
use Myna65\ProsumerCalculator\Service\TwigBuilder;
use Pimple\Container;

class ContainerBuilder
{
    public static function build() {
        $container = new Container();

        $container['cache'] = function () {
            return new FilesService();
        };

        $container['twig'] = function () {
            return TwigBuilder::build();
        };

        $container['formFactory'] = function ($container) {
            return FormFactoryBuilder::build($container['twig']);
        };

        $container['dbconfig'] = function () {
            $paths = array( __DIR__.'/../Entity/' );
            $isDevMode = WP_DEBUG;
            return Setup::createAnnotationMetadataConfiguration( $paths, $isDevMode );
        };

        $container['entityManager'] = function ($container ) {
            $dbParams = array(
                'driver'   => 'mysqli',
                'host'     => DB_HOST,
                'user'     => DB_USER,
                'password' => DB_PASSWORD,
                'dbname'   => DB_NAME,
                'charset'  => 'UTF8'

            );
            $config = $container['dbconfig'];


            $evm = new EventManager();
            $evm->addEventListener(Events::loadClassMetadata, new TablePrefix());

            return EntityManager::create( $dbParams, $config, $evm );
        };

        $container['databaseService'] = function ($container) {
            return new DatabaseService($container['entityManager']);
        };

        $container['dnoSerializer'] = function () {
            return DnoSerializerBuilder::build();
        };

        ContainerAware::setContainer($container);
    }
}