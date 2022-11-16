<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use App\Repository\GarageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Gallery;
use App\Entity\Pilote;

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
        
        //====pilote
        $pilote =new Pilote();
        $pilote->setName('elliot');
        $manager->persist($pilote);
        $manager->flush();

        //====garage
        $garage = new Garage();
        $garage->setName("elliot's garage");
        $manager->persist($garage);
        $garage->setPilote($pilote);

        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);
        
        //===Brand
        $brand = new Brand();
        $brand->setParent($brands)
              ->setName("lamborgini");
        
        $manager->persist($brand);
        $manager->flush();
        
        //====1rst car
        $car = new Car();
        $car->setName('1erVago');
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
        $car->setName('2emVago');
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();

        //====gallery

        $gallery = new Gallery();
        $gallery->setDescription('1er gallery')
                ->setPublished('false')
                ->setCreateur($pilote);
        $gallery->addCar($car);
        $manager->persist($gallery);
        $manager->flush();
        
        
        //baba's garage =========================================================
        
        //====pilote
        $pilote =new Pilote();
        $pilote->setName('baba');
        $manager->persist($pilote);
        $manager->flush();

        //====garage 
        $garage = new Garage();
        $garage->setName("baba's garage");
        $garage->setPilote($pilote);
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);
        
        $brand = new Brand();
        $brand -> setParent($brands)
                -> setName("BMW");
        $manager->persist($brand);
        $manager->flush();
        
        $car = new Car();
        $car->setName('CmonCharrr');
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();

        //====gallery

        $gallery = new Gallery();
        $gallery->setDescription('ma gallery')
                ->setPublished('false')
                ->setCreateur($pilote);
        $gallery->addCar($car);
        $manager->persist($gallery);
        $manager->flush();

        //mateo's garage ======================================================
        //====pilote
        $pilote =new Pilote();
        $pilote->setName('zougheb');
        $manager->persist($pilote);
        $manager->flush();

        //====garage 
        $garage = new Garage();
        $garage->setName("mateo's garage");
        $garage->setPilote($pilote);
        $manager->persist($garage);
        $manager->flush();
        $this->setReference(self::ELLIOT_GARAGE, $garage);

        //====Brand
        $brand = new Brand();
        $brand -> setParent($brands)
                -> setName("BMW");
        $manager->persist($brand);
        $manager->flush();
        
        //===1srt car
        $car = new Car();
        $car->setName('la bagnole');
        $car->setGarage($this->getReference(self::ELLIOT_GARAGE));
        $car->addBrand($brand);

        $manager->persist($car);
        $manager->flush();

        //====gallery
        $gallery = new Gallery();
        $gallery->setDescription('hehe gallery')
                ->setPublished('false')
                ->setCreateur($pilote);
        $gallery->addCar($car);
        $manager->persist($gallery);
        $manager->flush();

    }
}
