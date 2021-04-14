<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profile;
use App\Controller\ProfileController;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @Route("/api")
 */
class ProfileController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/profile", name="profile", methods={"GET"})
     */
    public function  profileAction(ProfileRepository $repo)
    {
        $user= new User();
        $profil= $repo->findAll();

        $user= $this->tokenStorage->getToken()->getUser();
        if ($user->getRoles()[0] === 'ROLE_ADMIN') {

            $profil= $this->getDoctrine()->getRepository(Profile::class);
            $profile=$profil->findByLibelle(array('libelle' =>

            'ROLE_SECRETAIRE',
            'ROLE_EMPLOYE'
            
        ));
        $datas= array();
        foreach ($profile as $key => $result) {
            $datas[$key]['id'] = $result->getId();
            $datas[$key]['libelle'] = $result->getLibelle();
            
        }
        return new JsonResponse($datas);
            
        }
        elseif ($user->getRoles()[0] === 'ROLE_SECRETAIRE') 
        {
            $profil= $this->getDoctrine()->getRepository(Profile::class);
            $profile1=$profil->findByLibelle(array('libelle' =>

            'ROLE_EMPLOYE'
            
        ));
        $data= array();
        foreach ($profile1 as $key => $result){
            $data[$key]['id'] = $result->getId();
            $data[$key]['libelle'] = $result->getLibelle();
        }
        return new JsonResponse($data);
            
        }
    }
}
