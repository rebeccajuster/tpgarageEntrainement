<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    //le constructeur est appelé lorsqu'une nvl instance est cree
    //UserPaawordHasherInterface  sert a crypte les mdp
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    //methode pour charger des donnees fictives dans la bdd
    //objet $manager de type ObjectManager qui permets de gerer les entites et la persistance des donne dans la bdd
    public function load(ObjectManager $manager): void
    {
        $data = [["rebeccajuster@hotmail.fr",["ROLE_ADMIN"],"rebecca","rebecca","juster"],["ut1@gmail.com",["ROLE_USER"],"ut1","utilisateur","1"],["ut2@gmail.com",["ROLE_USER"],"ut2","utilisateur","2"]];

        foreach ($data as $oneUser)
        {

                $user = new User();
                $user->setEmail($oneUser[0]);
                $user->setRoles($oneUser[1]);
                //methode hasPassword du service qui se trouve dans UserPasswordHasherInterface prends
                    // en compte deux arguments $oneUser objet sur lequel je veux hasher mon mdp,$oneUser[1] mdp que je veux haxher
                $user->setPassword($this->hasher->hashPassword($user,$oneUser[2]));
                $user->setPrenom($oneUser[3]);
                $user->setNom($oneUser[4]);

                $manager->persist($user);



        }
        // $product = new Product();
        // ;

        $manager->flush();
    }
}
