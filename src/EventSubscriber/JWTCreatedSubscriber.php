<?php

namespace App\EventSubscriber;

use App\Entity\Person;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTCreatedSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onJWTCreated',
        ];
    }

    
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        // Récupérer les données du payload actuel
        $payload = $event->getData();
        $user = $event->getUser();

        // Ajouter l'ID de l'utilisateur si c'est une instance de UserInterface
        if ($user instanceof Person) {
            $payload['id'] = $user->getId(); // Ajout de l'ID de l'utilisateur
            error_log('Utilisateur détecté comme Person avec ID : ' . $user->getId());
        } else {
            error_log('Type d’utilisateur inattendu : ' . get_class($user));
        }
        // Mettre à jour le payload avec les nouvelles données
        $event->setData($payload);
    }
}
