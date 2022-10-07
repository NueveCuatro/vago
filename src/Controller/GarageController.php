<?php

namespace App\Controller;

use App\Entity\Garage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class GarageController extends AbstractController
{


    
    
    /**
     * liste des garages
     * 
     * @Route("/liste", name = "Garage_list", methods = "GET") 
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
            //<a href="/garage/'.$garage->getid().'">'.$garage->getName().'</a></li>';
            $url = $this->generateUrl(
                'garage_show',
                ['id' => $garage->getId()]);
                
                $htmlpage .= '<li>
                <a href="'.$url.'">'.$garage->getName().'</a></li>';
            }
            
            $htmlpage .= '</ul>';
            $htmlpage .= '</body></html>';
            
            return new Response(
                $htmlpage,
                Response::HTTP_OK,
                array('content-type' => 'text/html')
            );
        }

        
        /**
         * @Route("/liste", name = "garage_index")
         */
        public function index(){
    
        }


        /**
         * Show a garage
         * 
         * @Route("/garage/{id}", name="garage_show", requirements={"id"="\d+"})
         *    note that the id must be an integer, above
         *    
         * @param Integer $id
         */
    public function show(ManagerRegistry $doctrine, $id)
    {
        $garageRepo = $doctrine->getRepository(Garage::class);
        $garage = $garageRepo->find($id);

        if (!$garage) {
            throw $this->createNotFoundException('The garage does not exist');
        }

        $res = '<!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>garage n° '.$garage->getId().'</title>
            </head>
            <body>
                <h2>garage Details :</h2>
                <ul>
                <dl>';
        
        $res .= '<dt>garage</dt><dd>' . $garage->getName() . '</dd>';
        $res .= '<dt>garage</dt><dd>' . $garage->getPilote() . '</dd>';
        $res .= '<dl/>';
        $res .= '<ul/>';
        $res .= '<p/><a href="' . $this->generateUrl('garage_index') . '">Back</a>';

        return new Response('<html><body>'. $res . '</body></html>');
    }

}
