<?php


namespace Myna65\ProsumerCalculator\Controller;


use Doctrine\ORM\EntityManager;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;
use Myna65\ProsumerCalculator\Entity\City;

class AdminController extends ContainerAware {

    public function indexAction() {
        if(!current_user_can('manage_options')) {
            return;
        }

        /** @var \Twig_Environment $twig */
        $twig = $this->get('twig');
        /** @var EntityManager $entityManager */
        $entityManager = $this->get('entityManager');

        $cities = $entityManager->getRepository(City::class)->findAll();

        echo $twig->render('main_admin_menu.html.twig',[
            'cities' => $cities
        ]);
    }

}