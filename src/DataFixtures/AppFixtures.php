<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Garage;
use App\Entity\Brand;
use App\Entity\Pilote;
use App\Entity\Gallery;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Laminas\Code\Generator\EnumGenerator\Name;

class AppFixtures extends Fixture
{
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
    /**
     * Generates initialization data for pilote : [name, garage, description]
     * @return \\Generator
     */
    private static function piloteDataGenerator()
    {
        yield ["elliot", "elliot's garage", "je suis fan de F1"];
        yield ["baba", "baba's garage", "j'adore les voiures"];
        yield ["zougheb", "zougheb's garage", "conduire, c est mon dada"];
    }

    /**
     * Generates initialization data for car:
     *  [car_name, garage_name, subBrand(modele)]
     * @return \\Generator
     */
    private static function carDataGenerator()
    {
        yield ["lamborgini-urus", "elliot's garage", "urus"];
        yield ["mercedes-GLE","elliot's garage", "GLE"];
        yield ["porshe-911 spider","elliot's garage", "911 spider"];
        yield ["nissan-almera1990","elliot's garage", "almera1990"];
        yield ["tesla-modelX","baba's garage", "modelX"];
        yield ["BMW-m4","baba's garage", "m4"];
        yield ["BMW-i8","baba's garage", "i8"];
        yield ["mercedes-G64","zougheb's garage", "G64"];
        yield ["nissan-almera1990","zougheb's garage", "almera1990"];
        yield ["rolce royce","zougheb's garage", "fantom"];
    }

    /**
     * Generates initialization data for garage : [name]
     * @return \\Generator
     */
    private static function garageDataGenerator()
    {
        yield ["elliot's garage"];
        yield ["baba's garage"];
        yield ["zougheb's garage"];
    }

    /**
     * Generates initialization data for gallery : [description, published, createur]
     * @return \\Generator
     */
    private static function galleryDataGenerator()
    {
        yield ["elliot's 1rst gallery", "false", "elliot"];
        yield ["baba's 1rst gallery", "false", "baba"];
        yield ["zougheb's 1rst gallery", "false", "zougheb"];
    }

    /**
     * Generates initialization data for car's brand :
     *  [brand]
     * 
     * then
     * [brand, subbrand]
     * 
     * @return \\Generator
     */
    private static function carMainBrandDataGenerator()
    {
        yield ["mercedes"];
        yield ["BMW"];
        yield ["tesla"];
        yield ["nissan"];
        yield ["rolce royce"];
        yield ["porshe"];
        yield ["lamborgini"];
    }

    private static function carSubBrandDataGenerator()
    {
        yield ["mercedes", "GLE"];
        yield ["mercedes", "G64"];
        yield ["BMW", "m4"];
        yield ["BMW", "i8"];
        yield ["tesla", "modelX"];
        yield ["nissan", "almera1990"];
        yield ["porshe", "911 spider"];
        yield ["lamborgini", "urus"];
        yield ["rolce royce", "fantom"];
    }

    public function load(ObjectManager $manager)
    {
        $garageRepo = $manager->getRepository(Garage::class);
        $careRepo = $manager->getRepository(Car::class);
        $brandRepo = $manager->getRepository(Brand::class);
        $piloteRepo = $manager->getRepository(Pilote::class);

        foreach (self::garageDataGenerator() as [$name]){
            $garage = new Garage();
            $garage->setName($name);
            $manager->persist($garage);
        }
        $manager->flush();
        
        foreach (self::piloteDataGenerator() as [$name, $garage, $description]){
            $garage = $garageRepo->findOneBy(['name' => $garage]);
            $pilote = new pilote();
            $pilote->setName($name)
                    ->setGarage($garage)
                    ->setDescription($description);
            $manager->persist($pilote);
        }
        $manager->flush();
        
        
        foreach (self::galleryDataGenerator() as [$description, $published, $createur]){
            $createur = $piloteRepo->findOneBy(['name' => $createur]);
            $gallery = new gallery();
            $gallery->setDescription($description)
            ->setPublished($published)
            ->setCreateur($createur);
            $manager->persist($gallery);
        }
        $manager->flush();
        
        foreach (self::carMainBrandDataGenerator() as [$brand]){
            $mainbrand = new brand();
            $mainbrand->setName($brand);
            $manager->persist($mainbrand);
        }
        $manager->flush();
        
        foreach (self::carSubBrandDataGenerator() as [$mainBrand, $subBrand]){
            $mainBrand = $brandRepo->findOneBy(['name' => $mainBrand]);
            $subbBrand = new Brand();
            $subbBrand->setName($subBrand)
                    ->setParent($mainBrand);
            $manager->persist($subbBrand);
        }
        $manager->flush();

        foreach (self::carDataGenerator() as [$name, $garage, $brand]){
            $garage = $garageRepo->findOneBy(['name' => $garage]);
            $brand = $brandRepo->findOneBy(['name' => $brand]);
            $car = new car();
            $car->setName($name)
                ->setGarage($garage)
               ->addBrand($brand);
            $manager->persist($car);
        }
        $manager->flush();
    }
    
}