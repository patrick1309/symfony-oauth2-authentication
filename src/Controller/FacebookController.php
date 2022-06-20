<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacebookController extends AbstractController
{
    #[Route('/connect/facebook', name: 'connect_facebook')]
    public function connect(ClientRegistry $clientRegistry)
    {
        //Redirect to facebook
        return $clientRegistry->getClient('facebook')->redirect([], []);
    }

    /**
     * After going to Facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/facebook/check', name: 'connect_facebook_check')]
    public function connectCheck(Request $request)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
    }
}
