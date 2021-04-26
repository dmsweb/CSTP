<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */

class StatusController extends AbstractController
{
    /**
     * @Route("/status/{id}", name="status", methods={"GET"})
     */
    public function blocStatus($id)
    {  $repo = $this->getDoctrine()->getRepository(User::class);
              $user = $repo->find($id);
              $status = '';
        if($user->getIsActive() === true)
        {
            $status = 'desactivé';
            $user->setIsActive(false);
        }
        else
        {
            $status = 'activé';
            $user->setIsActive(true);
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        $data = [
            'status'=>200,
            'message'=> $user->getUsername().' est '.$status
        ];
        return $this->json($data, 200);

    }
}
