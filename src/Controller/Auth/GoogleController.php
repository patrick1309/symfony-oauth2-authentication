<?php

namespace App\Controller\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GoogleController extends AbstractController
{
    #[Route('/connect/google', name: 'connect_google')]
    public function connect(ClientRegistry $clientRegistry)
    {
        //Redirect to google
        return $clientRegistry->getClient('google')->redirect([], []);
    }

    /**
     * After going to Google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectCheck(Request $request)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
    }
}
