<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employe;
use App\Entity\Profile;
use App\Entity\Service;
use App\Entity\Fonction;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @Route("/api")
 */
class EmployerController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/Employer", name="employer", methods={"POST"})
     */
    public function AjouterEmployer(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $value= json_decode($request->getContent());
        if (isset($value->noms,$value->naissance,$value->adresse,$value->tel,$value->cin,$value->genre,$value->familiale,$value->idService,$value->username,$value->password,$value->profile,$value->fonction))
         {
            $daterecrut= new \DateTime();
            $dateEmb=    new  \DateTime();
            $service= new Service();
         
            ## User
            $user=    new User();
            $roleRepo= $this->getDoctrine()->getRepository(Profile::class);
            $role= $roleRepo->find($value->profile);
            // dd($role);
            $user->setUsername($value->username);
            $user->setPassword($userPasswordEncoder->encodePassword($user, $value->password));
            $user->setProfile($role);
            $entityManager->persist($user);
            // dd($user);
            
                  
            #La longueur total du matricule = 8 ex =CSTP00001

            $kods = rand(1000, 9999);
            $num= "CSTP";
           
            $matricule = $num.$kods;
           
             # les données de l'employé
             $employe= new Employe();

            $reposService=$this->getDoctrine()->getRepository(Service::class);
            $service= $reposService->find($value->idService);

            $repposFonction= $this->getDoctrine()->getRepository(Fonction::class);
            $fonction= $repposFonction->find($value->fonction);
            // dd($service);

            $employe->setMatricule($matricule);
            $employe->setNoms($value->noms);
            $employe->setNaissance($value->naissance);
            $employe->setAdresse($value->adresse);
            $employe->setTelephone($value->tel);
            $employe->setCin($value->cin);
            $employe->setGenre($value->genre);
            $employe->setSfamiliale($value->familiale);
            $employe->setIdUser($user);
            $employe->setIdService($service);
            $employe->setDateRecrut($daterecrut);
            $employe->setDateEmbauche($dateEmb);
            $employe->setFonction($fonction);

            $entityManager->persist($employe);
            $entityManager->flush();
            // dd($employe);


            $data = [
                'status' => 201,
                'message' => 'employe est bien cree: '
            ];
            return new JsonResponse($data, 201); 
        }else
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner tous les champs ?'
        ];
        return new JsonResponse($data, 500);
        
    }


              ### c'est l'affichage des employers 

    /**
    * @Route("/listeEmployes", name="liste", methods={"GET"})
    */
    public function listerEmploye(Request $request, EmployeRepository $ripos )
    {
            $employe= new Employe();
            
            $page = $request->query->get('page');
            if (is_null($page) || $page < 1 ) {
               $page= 1;
               
            }
            $limite=4;
            $list= $this->getDoctrine()->getRepository(Employe::class);
            $liste= $ripos->findAllEmploye($page, $limite);

            $data= [];
            $i=0;
            $users= $this->tokenStorage->getToken()->getUser();
            $profile= $users->getRoles()[0];

            if ($profile === 'ROLE_ADMIN') 
            {
                foreach ($liste as $employe)
                {
                    if ($employe->getIdUser()->getProfile()->getLibelle() === 'ROLE_SECRETAIRE' ||
                        $employe->getIdUser()->getProfile()->getLibelle() === 'ROLE_EMPLOYE')
                        {
                        $data[$i]=$employe;
                        $i++;

                    }
                }
            }
            elseif($profile=== 'ROLE_SECRETAIRE')
            {
                foreach($liste as $employe)
                {
                    if ($employe->getIdUser()->getProfile()->getLibelle() === 'ROLE_EMPLOYE') 
                    {
                        $data[$i]=$employe;
                        $i++;

                    }
                }
            }
            else {
                $data = [
                    'status' => 401,
                    'message' => 'Désolé access non autorisé !!!'
                    ];
                
            }
            return $this->json($data, 200);
    }
}
