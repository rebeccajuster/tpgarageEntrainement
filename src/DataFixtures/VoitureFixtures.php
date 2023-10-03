<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Voiture;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VoitureFixtures extends Fixture
{
    //L'injection de cette dépendance permet à cette classe d'accéder aux utilisateurs existants dans la base de données, ce qui peut être utile
    //pour attribuer aléatoirement une voiture à un utilisateur existant


    public function load(ObjectManager $manager): void
    {
        $voitures =[ ["peugeot","C5","2005"],["rang rover","2","2020"],["BMW","3","2021"]];
        // getRepository renvoie un referentiel associe a cette classe qui permet d effectuer des operations de bdd specifique a cette classe qui se trouve dans le repository
        $user = $manager->getRepository(User::class)->findAll();

        foreach ($voitures as $uneVoiture)
        {

            $manager->persist(
                                (new Voiture())
                                ->setMarque($uneVoiture[0])
                                ->setModele($uneVoiture[1])
                                ->setAnnee($uneVoiture[2])
                                    //array_rand permet de fournit une cle aleatoire du tableau $user
                                ->setUser($user[array_rand($user)])
                            );

        }
        $manager->flush();
    }
}
