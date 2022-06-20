<?php 

namespace App\Security;

use App\Entity\User;
use App\Entity\UserAuthentication;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\Routing\RouterInterface;
use League\OAuth2\Client\Provider\FacebookUser;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;

abstract class ServiceAuthenticator extends OAuth2Authenticator
{

    public function __construct(
        protected ClientRegistry $clientRegistry,
        protected EntityManagerInterface $entityManager,
        protected RouterInterface $router
    )
    {}

    protected function getDBUser(string $serviceName, GoogleUser|FacebookUser $externalUser)
    {
        $email = $externalUser->getEmail();

        // have they logged in with this account
        /** @var ?UserAuthentication $existingUserAuthentication */
        $existingUserAuthentication = $this->entityManager->getRepository(UserAuthentication::class)->findOneBy([
            'authService' => $serviceName,
            'externalId' => $externalUser->getId(),
        ]);

        if ($existingUserAuthentication) {
            return $existingUserAuthentication->getUser();
        }

        // save user authentication first
        $userAuthentication = new UserAuthentication;
        $userAuthentication->setAuthService($serviceName);
        $userAuthentication->setExternalId($externalUser->getId());
        switch ($serviceName) {
            case 'google': 
                $userAuthentication->setPicture($externalUser->getAvatar());
                break;
            case 'facebook': 
                $userAuthentication->setPicture($externalUser->getPictureUrl());
                break;    
        }
        $this->entityManager->persist($userAuthentication);

        // check id user exist by email
        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $email,
        ]);

        //User doesnt exist, we create it !
        if (!$existingUser) {
            $existingUser = new User();
            $existingUser->setEmail($email);
            $this->entityManager->persist($existingUser);                     
        }
        // add user authentication
        $existingUser->addUserAuthentication($userAuthentication);
        
        $this->entityManager->flush();

        return $existingUser;
    }
}