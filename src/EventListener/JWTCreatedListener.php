<?php

// src/App/EventListener/JWTCreatedListener.php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class JWTCreatedListener
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        /** @var $user \AppBundle\Entity\User */
        $user = $event->getUser();
   if (!$user->getIsActive()) {
       throw new DisabledException('User account is disabled.');
   }
        // merge with existing event data
        $payload = array_merge(
            $event->getData(),
            [
                'password' => $user->getPassword()
            ]
        );

        $event->setData($payload);
    }

    // /**
    //  * @Route("/AfficheUser", name=users_show, methods={"GET"})
    //  */
    // public function listUser(UserRepository $repos)
    // {
    //     $users = new User();
    //     $affiche=$repo->findAll();
    //     // dd($profiles);

    //    $users= $this->tokenStorage->getToken()->getUser();
    //    if ($users->getProfile()->getLibelle() ==='ROLE_SUPER_ADMIN')
    //    {
    //        $affiche= [$this->getDoctrice()->getRepository(User::class)->findByLibelle(array('libelle' =>
    //        'ROLE_ADMIN', 
    //        'ROLE_CAISSIER'
    //     ))];
    //     dd($affiche);
    //     // return $this->json($affiche, 200);
    //    }
    // }
}