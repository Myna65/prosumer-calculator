<?php


namespace Myna65\ProsumerCalculator;


use Myna65\ProsumerCalculator\Controller\AdminController;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;

class AdminMenu extends ContainerAware {

    public static function registerMenu() {
        add_action('admin_menu', function() {
            add_menu_page(
                'Prosumer Calculator',
                'Prosumer',
                'manage_options',
                'prosumer_calculator',
                function() {
                    (new AdminController())->indexAction();
                }
            );
        });
    }

}