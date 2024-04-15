<?php

namespace App\EventSubscriber;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthenticationSuccessSubscriber implements EventSubscriberInterface
{
    private Response $response;
    private array $data;
    private string $jwt;
    private Cookie $cookie;


    public static function getSubscribedEvents() : array
    {
        return [
            'lexik_jwt_authentication.on_authentication_success' => 'onAuthenticationSuccess',
        ];
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event) : void
    {

        $this->response = $event->getResponse();  
        $this->data = $event->getData();
        $this->jwt = $this->data['token']; 

        // Créer un cookie sécurisé HttpOnly qui expire dans 3600 secondes (1 heure)
        $this->cookie = Cookie::create('BEARER')
                        ->withValue($this->jwt)
                        ->withExpires(time() + 3600)
                        ->withPath('/')
                        ->withSecure(true) // true si vous utilisez HTTPS, false sinon
                        ->withHttpOnly(true)
                        ->withSameSite('None'); // ou 'None' si le cookie doit être envoyé dans des contextes cross-site

                        //Todo config à modifier pour le deploiement

        // Ajouter le cookie à l'objet Response
        $this->response->headers->setCookie($this->cookie);
        $event->setData($this->data);
    }
}
