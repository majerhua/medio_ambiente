<?php

namespace MedioAmbienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use SudJuvenilesBundle\Component\Security\Authentication\authenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SudJuvenilesBundle\Entity\Usuarios;

class DefaultController extends Controller
{

    /**
     * @Route("/",name="landing")
     */
    public function landingAction(Request $request)
    {
        return $this->render('MedioAmbienteBundle:Default:landing.html.twig');
    }

    /**
     * @Route("/panel",name="panel")
     */
    public function panelAction(Request $request)
    {
        return $this->render('MedioAmbienteBundle:Default:panel.html.twig');
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
    	$authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render(
            'MedioAmbienteBundle:Default:login.html.twig', array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));
    }

}
