<?php

namespace App\Controller;

use App\Entity\Garage;
use App\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class GarageController extends AbstractController
{

    /**
     * home page
     * 
     * @Route("/", name = "home", methods = "GET")
     */
    public function home(){
        return $this->render("garage/home.html.twig");
    }
    
    
    /**
     * liste des garages
     * 
     * @Route("/garage/list", name = "garage_list", methods = "GET") 
     */
    public function listGarage(ManagerRegistry $doctrine)
    {
        $entityManager= $doctrine->getManager();
        $garages = $entityManager->getRepository(Garage::class)->findAll();
        
        dump($garages);

        return $this->render("garage/index.html.twig",
        ["garages" => $garages]);
        }


        /**
         * Show a garage
         * 
         * @Route("/garage/{id}", name="garage_show", requirements={"id"="\d+"})
         *    note that the id must be an integer, above
         *    
         * @param Integer $id
         */
    public function showGarage(Garage $garage, Brand $brand)
    {
        return $this->render("garage/show_garage.html.twig",[
            "garage" => $garage,
        ]);
    }

}
