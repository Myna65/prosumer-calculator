<?php

namespace Myna65\ProsumerCalculator\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerBuilder;

class DatabaseService {

    /** @var EntityManager */
    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function upgradeDatabase() {

        $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($this->em);

        $sql = $schemaTool->getUpdateSchemaSql($metadata, true);

        if(count($sql) !== 0) {
            $schemaTool->updateSchema($metadata, true);
        }

    }

    public function migrateDatabase() {
        $this->upgradeDatabase();
    }

    public static function removeDatabase() {

        global $wpdb;

        ContainerBuilder::build();
        $em = ContainerAware::getStatic('entityManager');

        $metadata = $em->getMetadataFactory()->getAllMetadata();
        $tables = [];

        foreach ($metadata as $metadatum) {
            $tables[] = $metadatum->table['name'];
        }

        $wpdb->query(sprintf('SET FOREIGN_KEY_CHECKS = 0;'));
        foreach ($tables as $table)
        {
            $wpdb->query(sprintf('DROP TABLE %s', $table));
        }
        $wpdb->query(sprintf('SET FOREIGN_KEY_CHECKS = 1;'));


    }



}