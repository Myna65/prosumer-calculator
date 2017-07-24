<?php


namespace Myna65\ProsumerCalculator\Service;


use Myna65\ProsumerCalculator\Entity\City;
use Myna65\ProsumerCalculator\Entity\DNO;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DnoSerializerBuilder {

    public static function build() {
        return new Serializer(
            array(new ObjectNormalizer(null, null, null, new DnoPropertyExtractor()), new ArrayDenormalizer()),
            array(new JsonEncoder())
        );
    }

}

class DnoPropertyExtractor implements PropertyTypeExtractorInterface {

    public function getTypes($class, $property, array $context = array()) {

        if (!is_a($class, DNO::class, true)) {
            return null;
        }

        if ('cities' !== $property) {
            return null;
        }

        return [
            new Type(Type::BUILTIN_TYPE_OBJECT, false, City::class . '[]')
        ];

    }

}