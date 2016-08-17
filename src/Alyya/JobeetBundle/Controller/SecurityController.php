<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 16/08/16
 * Time: 11:37
 */

namespace Alyya\JobeetBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request){
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                'username' => $lastUsername,
                'error' => $error,
            )
        );
    }

}