<?php


namespace Myna65\ProsumerCalculator\Service;


use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;

class FormFactoryBuilder {

    /**
     * @param \Twig_Environment $twig
     *
     * @return FormFactoryInterface
     */
    public static function build($twig) {

        $defaultFormTheme = 'form_div_layout.html.twig';

        $formEngine = new TwigRendererEngine([$defaultFormTheme], $twig);
        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader([
            TwigRenderer::class => function () use ($formEngine) {
            return new TwigRenderer($formEngine);
            }
        ]));

        $twig->addExtension(new FormExtension());

        return Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();
    }

}