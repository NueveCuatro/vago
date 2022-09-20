<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use App\Repository\GarageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;

class AppFixtures extends Fixture
{
    public const ELLIOT_GARAGE = 'elliot-garage';

    public function load(ObjectManager $manager)
    {
        $garage = new Garage();
        $manager->persist($garage);

        $manager->flush();
        // Une fois l'instance de Region sauvée en base de données,
        // elle dispose d'un identifiant généré par Doctrine, et peut
        // donc être sauvegardée comme future référence.
        $this->addReference(self::ELLIOT_GARAGE, $garage);


        $car = new Car();
        $car->setGarage($garage);
        //$room->addRegion($region);
        // On peut plutôt faire une référence explicite à la référence
        // enregistrée précédamment, ce qui permet d'éviter de se
        // tromper d'instance de Region :
        $car->$garage->addGarage($this->getReference(self::ELLIOT_GARAGE));   
        $manager->persist($car);

        $manager->flush();
    }
}
