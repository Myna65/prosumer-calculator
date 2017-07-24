<?php


namespace Myna65\ProsumerCalculator\Service;


use Myna65\ProsumerCalculator\Twig\FakeTranslation;
use Symfony\Component\Filesystem\Filesystem;

class TwigBuilder {

    public static function build() {

        $twigCachePath = FilesService::getBaseFile().'/cache/twig';
        $fs = new Filesystem();

        if(!$fs->exists($twigCachePath)) {

            $fs->mkdir($twigCachePath);

        }

        $twigLoader = new \Twig_Loader_Filesystem([
            __DIR__ . '/../../views',
            __DIR__ . '/../../vendor/symfony/twig-bridge/Resources/views/Form'
        ]);

        $twig = new \Twig_Environment($twigLoader,[
            'cache' => $twigCachePath,
            'debug' => WP_DEBUG
        ]);

        $twig->addExtension(new FakeTranslation());

        return $twig;

    }

}