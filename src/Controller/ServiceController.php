<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Fonction;
use App\Controller\ServiceController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/api")
 */
class ServiceController extends AbstractController
{

    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/service", name="service", methods={"POST"})
     */
    public function AjouterService(Request $request, EntityManagerInterface $entityManager )
    {
       $value= json_decode($request->getContent());
       if (isset($value->nomService)) 
       {
              # Service
           $service= new Service();
           $service->setNomService($value->nomService);
        //    dd($service);


           $entityManager->persist($service);
           $entityManager->flush();
           
           $data = [
            'status' => 201,
            'message' => 'Le Service est bien cree: '
        ];
        return new JsonResponse($data, 201); 

       }else
       $data = [
           'status' => 500,
           'message' => 'Vous devez renseigner tous les champs ?'
       ];
       return new JsonResponse($data, 500);
    }

     /**
     * @Route("/fonctions", name="fonction", methods={"POST"})
     */
    public function AjouterFonction(Request $request, EntityManagerInterface $entityManager )
    {
       $value= json_decode($request->getContent());
       if (isset($value->nomService, $value->nomFonction)) 
       {
             
      //        # Fonction

           $fonction= new Fonction();

           $repo= $this->getDoctrine()->getRepository(Service::class);
           $services= $repo->find($value->nomService);
         //   dd($services);

           $fonction->setNomFonction($value->nomFonction);
           $fonction->setService($services);
           $entityManager->persist($fonction);
        //    dd($fonction);

           $entityManager->flush();
           
           $data = [
            'status' => 201,
            'message' => 'La Fonction est bien cree: '
        ];
        return new JsonResponse($data, 201); 

       }else
       $data = [
           'status' => 500,
           'message' => 'Vous devez renseigner tous les champs ?'
       ];
       return new JsonResponse($data, 500);
    }
}
