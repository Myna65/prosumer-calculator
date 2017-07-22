<?php


namespace Myna65\ProsumerCalculator\DependencyInjection;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Myna65\ProsumerCalculator\Service\TwigFactory;
use Pimple\Container;

class ContainerBuilder
{
    public static function build() {
        $container = new Container();

        $container['twig'] = function () {
            return TwigFactory::buildTwig();
        };

        $container['dbconfig'] = function () {
            $paths = array( __DIR__.'/../Entity/City.php' );
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
            return EntityManager::create( $dbParams, $config );
        };

        ContainerAware::setContainer($container);
    }
}