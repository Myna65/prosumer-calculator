<?php

namespace Myna65\ProsumerCalculator;

use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerBuilder;
use Myna65\ProsumerCalculator\Service\DatabaseService;
use Myna65\ProsumerCalculator\Service\FilesService;

/**
 * Class Plugin
 * @package Myna65\ProsumerCalculator
 *
 */
class Plugin extends ContainerAware
{
    const version = "0.1";

    private $mainFile;

    public function __construct($mainFile) {
        parent::__construct();

        $this->mainFile = $mainFile;

        ContainerBuilder::build();

        $this->registerLifecycleHooks();

        AdminMenu::registerMenu();

    }

    private function registerLifecycleHooks() {

        register_activation_hook($this->mainFile, function () {
            /** @var DatabaseService $databaseService */
            $databaseService = $this->get('databaseService');
            $databaseService->upgradeDatabase();

            add_option( 'prosumer_calculator_db_version', Plugin::version);
        });

        register_deactivation_hook($this->mainFile, function () {
            $this->get('cache')->clearCache();
        });

        register_uninstall_hook($this->mainFile, [Plugin::class, 'uninstallHook']);

        add_action('plugins_loaded', function () {

            if(WP_DEBUG) {
                // Hard upgrade

                /** @var DatabaseService $databaseService */
                $databaseService = $this->get('databaseService');
                $databaseService->upgradeDatabase();
            } elseif (get_option( 'prosumer_calculator_db_version' ) != Plugin::version) {
                // Soft upgrade using migrations

                /** @var DatabaseService $databaseService */
                $databaseService = $this->get('databaseService');
                $databaseService->migrateDatabase();

                update_option( 'prosumer_calculator_db_version', Plugin::version);
            }
        });
    }

    static public function uninstallHook() {
        delete_option( 'prosumer_calculator_db_version');
        FilesService::clearAll();
        DatabaseService::removeDatabase();
    }

}