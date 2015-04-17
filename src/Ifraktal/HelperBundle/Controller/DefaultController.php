<?php

namespace Ifraktal\HelperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 *
 * @package Ifraktal\HelperBundle\Controller
 * @author David Amigo <davamigo@gmail.com>
 * @Route("/helper")
 */
class DefaultController extends Controller
{
    /**
     * Shows examples of sortCollection()
     *
     * @Route("/examples")
     * @Template("@IfraktalHelper/Default/examples.html.twig")
     */
    public function examplesAction()
    {
        $source = array(
            array(
                'name'  => 'name1',
                'attr'  => array(
                    'price' => 15.67,
                    'size'  => 100
                )
            ),
            array(
                'name'  => 'name2',
                'attr'  => array(
                    'price' => 12.12,
                    'size'  => 30
                )
            ),
            array(
                'name'  => 'name3',
                'attr'  => array(
                    'price' => 13.87,
                    'size'  => 30
                )
            )
        );

        return array(
            'source' => $source
        );
    }
}
