<?php


namespace Myna65\ProsumerCalculator\Service;


use Symfony\Component\Filesystem\Filesystem;

class FilesService {

    public static function getBaseFile() {
        return WP_CONTENT_DIR . '/prosumer-calculator';
    }

    public function clearCache() {
        $cachePath = self::getBaseFile().'cache';

        $fs = new Filesystem();

        if($fs->exists($cachePath)) {
            $fs->remove($cachePath);
        }
    }

    public static function clearAll() {
        $path = self::getBaseFile();

        $fs = new Filesystem();

        if($fs->exists($path)) {
            $fs->remove($path);
        }
    }

}