<?php


namespace Myna65\ProsumerCalculator\Controller;


use Doctrine\ORM\EntityManager;
use Myna65\ProsumerCalculator\DependencyInjection\ContainerAware;
use Myna65\ProsumerCalculator\Entity\City;
use Myna65\ProsumerCalculator\Entity\DNO;
use Myna65\ProsumerCalculator\Form\Import;
use Myna65\ProsumerCalculator\Form\ImportType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends ContainerAware {

    public function indexAction(Request $request) {
        if(!current_user_can('manage_options')) {
            return;
        }

        /** @var \Twig_Environment $twig */
        $twig = $this->get('twig');
        /** @var EntityManager $entityManager */
        $entityManager = $this->get('entityManager');

        $formFactory = $this->get('formFactory');

        $import = new Import();
        /** @var Form $form */
        $form = $formFactory->create(ImportType::class, $import);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            /** @var UploadedFile $file */
            $file = $import->getFile();

            $serialized = file_get_contents($file->getRealPath());

            $serializer = $this->get('dnoSerializer');

            $dnos = $serializer->deserialize($serialized, DNO::class.'[]', 'json');

            /** @var DNO $dno */
            foreach ($dnos as $dno) {
                $entityManager->persist($dno);

                foreach ($dno->getCities() as $city) {
                    $city->setDno($dno);
                    $entityManager->persist($city);
                }
            }

            $entityManager->flush();
        }

        $dnos = $entityManager->getRepository(DNO::class)->findAll();
        $cities = $entityManager->getRepository(City::class)->findAll();



        echo $twig->render('index.html.twig',[
            'import_allowed' => (!count($dnos) && !count($cities)),
            'import_form' => $form->createView(),
            'dnos' => $dnos,
            'cities' => $cities
        ]);
    }

}