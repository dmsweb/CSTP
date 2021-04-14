<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
            
           $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
       $profile1= new Profile();
       $profile1->setLibelle('ROLE_ADMIN');
       $manager->persist($profile1);

       $profile2= new Profile();
       $profile2->setLibelle('ROLE_SECRETAIRE');
       $manager->persist($profile2);

       $profile3= new Profile();
       $profile3->setLibelle('ROLE_EMPLOYE');
       $manager->persist($profile3);

       $manager->flush();

       $user1= new User();
       $user1->setUsername('ousmane881@gmail.com');
       $user1->setProfile($profile1);
       $user1->setIsActive(true);
       $password= $this->encoder->encodePassword($user1, 'admin123');
       $user1->setPassword($password);
       $manager->persist($user1);

       $user= new User();
       $user->setUsername('korrou');
       $user->setProfile($profile2);
       $user->setIsActive(true);
       $password= $this->encoder->encodePassword($user, 'admin123');
       $user->setPassword($password);
       $manager->persist($user);
       $manager->flush();

    }
}
