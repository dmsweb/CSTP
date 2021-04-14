<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employe;
use App\Entity\Profile;
use App\Repository\UserRepository;
use App\Repository\EmployeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @Route("/api")
 */
class SecurityController extends AbstractController
{
   public function register(Request $request, UserPasswordEncoderInterface $encoder)
   {
       $em= $this->getDoctrine()->getManager();

       $username= $request->request->get('username');
       $password= $request->request->get('password');
       $roles   = $request->request->get('roles');

       if (!$roles)
       {
           $roles= json_encode([]);
       }

       $user= new User($username);
       $user->setPassword($encoder->encodPassword($user, $password));
       $user->setRoles($roles);
       $em->persist($user);
       $em->flush();

       return new Response(sprintf('Utilisateur est creer', $user->getUsername()));
   }
   private $tokenStorage;
   public function __construct(TokenStorageInterface $tokenStorage)
   {
       $this->tokenStorage = $tokenStorage;
       
   }
   /**
    * @Route("/ListeUser", name="ListeUser", methods={"GET"})
    */
    public function listerUser(UserRepository $repos )
    {
            $users= new User();
            $list= $repos->findAll();

            // dd($list);
            $list= $this->getDoctrine()->getRepository(User::class);
            $liste= $list->findAll();

            $data= [];
            $i=0;
            $users= $this->tokenStorage->getToken()->getUser();
            $profile= $users->getRoles()[0];

            if ($profile === 'ROLE_ADMIN') 
            {
                foreach ($liste as $user)
                {
                    if ($user->getProfile()->getLibelle() === 'ROLE_SECRETAIRE' ||
                        $user->getProfile()->getLibelle() === 'ROLE_EMPLOYE')
                        {
                        $data[$i]=$user;
                        $i++;

                    }
                }
            }
            elseif($profile=== 'ROLE_SECRETAIRE')
            {
                foreach($liste as $user)
                {
                    if ($user->getProfile()->getLibelle() === 'ROLE_EMPLOYE') 
                    {
                        $data[$i]=$user;
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
