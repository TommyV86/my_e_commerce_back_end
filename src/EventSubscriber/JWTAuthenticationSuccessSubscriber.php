<?php

namespace App\EventSubscriber;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JWTAuthenticationSuccessSubscriber implements EventSubscriberInterface
{

    private $userProvider;
    private $jwtManager;

    public function __construct(
        UserProviderInterface $userProvider, // Assurez-vous que votre UserProvider est injecté ici
        JWTTokenManagerInterface $jwtManager
    ) {
        $this->userProvider = $userProvider;
        $this->jwtManager = $jwtManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            'lexik_jwt_authentication.on_authentication_success' => 'onAuthenticationSuccess',
        ];
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {

        // $user = $event->getUser();

        // if (!$user instanceof UserInterface) {
        //     return;
        // }

        $response = $event->getResponse();
        $data = $event->getData();
        $jwt = $data['token']; // Assurez-vous que c'est la clé correcte pour votre token

        // Créer un cookie sécurisé HttpOnly qui expire dans 3600 secondes (1 heure)
        $cookie = Cookie::create('BEARER')
                        ->withValue($jwt)
                        ->withExpires(time() + 3600)
                        ->withPath('/')
                        ->withSecure(true) // true si vous utilisez HTTPS, false sinon
                        ->withHttpOnly(true)
                        ->withSameSite('Lax'); // ou 'None' si le cookie doit être envoyé dans des contextes cross-site

                        //Todo config à modifier pour le deploiement

        // Ajouter le cookie à l'objet Response
        $response->headers->setCookie($cookie);
        $event->setData($data);
    }

    
}
