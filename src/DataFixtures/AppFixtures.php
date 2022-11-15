<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use App\Repository\GarageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;
use App\Entity\Brand;

class AppFixtures extends Fixture
{
    public const ELLIOT_GARAGE = 'elliot-garage';
    
    public function load(ObjectManager $manager)
    {
        
        $brands = new Brand();
        $brands -> setName("brands");
        $manager->persist($brands);
        $manager->flush();
        
        
        //elliot's garage ======================================================
        
        $garage = new Garage();
        $garage->setName("elliot's garage");
        $manager->persist($garage);

        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);
        
        //====1rst car
        $brand = new Brand();
        $brand -> setParent($brands)
                -> setName("lamborgini");

        $manager->persist($brand);
        $manager->flush();
        
        $car = new Car();
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();

        //====2nd car
        $brand = new Brand();
        $brand -> setParent($brands)
                -> setName("nissan almera");

        $manager->persist($brand);
        $manager->flush();

        $car = new Car();
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();
        
        //baba's garage =========================================================
        
        $garage = new Garage();
        $garage->setName("baba's garage");
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);
        
        $brand = new Brand();
        $brand -> setParent($brands)
                -> setName("BMW");
        $manager->persist($brand);
        $manager->flush();
        
        $car = new Car();
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();

        //mateo's garage ======================================================
        
        $garage = new Garage();
        $garage->setName("mateo's garage");
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);

    }
}
