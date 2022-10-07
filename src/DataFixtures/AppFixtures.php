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
        //elliot's garage

        $garage = new Garage();
        $garage->setName("elliot's garage");
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);

        $car = new Car();
        $car->setBrand("mercedes");
        $car->setModel("gle");
        $car->setColor("black");
        $manager->persist($car);
        $manager->flush();
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));   

        //baba's garage 

        $garage = new Garage();
        $garage->setName("baba's garage");
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);

        $car = new Car();
        $car->setBrand("porsche");
        $car->setModel("918 spider");
        $car->setColor("grey");
        $manager->persist($car);
        $manager->flush();
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));   

        //mateo's garage

        $garage = new Garage();
        $garage->setName("mateo's garage");
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);

    }
}
