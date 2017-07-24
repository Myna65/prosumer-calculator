<?php


namespace Myna65\ProsumerCalculator\Twig;


class FakeTranslation extends \Twig_Extension {

    public function getFilters() {
        return [
            new \Twig_SimpleFilter('trans', function ($string) {
                return $string;
            })
        ];
    }

}