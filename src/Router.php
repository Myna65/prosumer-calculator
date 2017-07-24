<?php


namespace Myna65\ProsumerCalculator;


use Myna65\ProsumerCalculator\Controller\AdminController;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class Router extends ContainerAware {

    public static function registerAdminRoutes() {

        add_action('admin_menu', function() {
            add_menu_page(
                'Prosumer Calculator',
                'Prosumer',
                'manage_options',
                'prosumer_calculator',
                function() {
                    (new AdminController())->indexAction(Request::createFromGlobals());
                }
            );
        });

    }

}