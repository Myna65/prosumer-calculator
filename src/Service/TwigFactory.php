<?php


namespace Myna65\ProsumerCalculator\Service;


use Symfony\Component\Filesystem\Filesystem;

class TwigFactory {

    public static function build() {

        $twigCachePath = FilesService::getBaseFile().'/cache/twig';
        $fs = new Filesystem();

        if(!$fs->exists($twigCachePath)) {

            $fs->mkdir($twigCachePath);

        }

        $twigLoader = new \Twig_Loader_Filesystem(__DIR__.'/../../views');

        return new \Twig_Environment($twigLoader,[
            'cache' => $twigCachePath,
            'debug' => WP_DEBUG
        ]);

    }

}