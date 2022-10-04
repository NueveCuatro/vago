<?php

namespace App\Controller;

use App\Entity\Garage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class GarageController extends AbstractController
{
    #[Route('/garage', name: 'app_garage')]
    public function index(): Response
    {
        return $this->render('garage/index.html.twig', [
            'controller_name' => 'GarageController',
        ]);
    }

    /**
     * liste des garages
     * 
     * @route("/liste, name = 'Garage_list, methods = "GET") 
     */
    public function listGarage(ManagerRegistry $doctrine)
    {
        $htmlpage = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>garages list!</title>
    </head>
    <body>
        <h1>garages list</h1>
        <p>Here are all your garages:</p>
        <ul>';
        
        $entityManager= $doctrine->getManager();
        $garages = $entityManager->getRepository(Garage::class)->findAll();
        foreach($garages as $garage) {
           $htmlpage .= '<li>
            <a href="/garage/'.$garage->getid().'">'.$garage->getTitle().'</a></li>';
         }
        $htmlpage .= '</ul>';

        $htmlpage .= '</body></html>';
        
        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
            );
    }

}
