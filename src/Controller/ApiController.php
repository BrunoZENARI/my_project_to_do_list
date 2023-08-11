<?php

namespace App\Controller;

use App\Entity\Taches;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'app_api_event_edit', methods: ['PUT'])]
    public function majEvent(?Taches $taches, Request $request, EntityManagerInterface $entityManager): Response
    {   
        // récupération des données
        $donnees = json_decode(($request->getContent()));

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            // les données sont complètes
            $code = 200;

            // vérification si l'id existe
            if(!$taches){
                $taches = new Taches;

                $code = 201;
            }

            $taches->setTitle($donnees->title);
            $taches->setDescription($donnees->description);
            // dump($donnees->start, $donnees->end);
            $taches->setStart(new DateTime($donnees->start));
            $taches->setEnd(new DateTime($donnees->end));
            $taches->setBackgroundColor($donnees->backgroundColor);
            $taches->setBorderColor($donnees->borderColor);
            $taches->setTextColor($donnees->textColor);

            
            $entityManager->persist($taches);
            $entityManager->flush();

            return new Response('ok', $code);
        }else {
            // les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
