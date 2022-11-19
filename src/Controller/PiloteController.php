<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Form\PiloteType;
use App\Repository\PiloteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pilote')]
class PiloteController extends AbstractController
{
    #[Route('/', name: 'app_pilote_index', methods: ['GET'])]
    public function index(PiloteRepository $piloteRepository): Response
    {
        return $this->render('pilote/index.html.twig', [
            'pilotes' => $piloteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pilote_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PiloteRepository $piloteRepository): Response
    {
        $pilote = new Pilote();
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $piloteRepository->add($pilote, true);

            return $this->redirectToRoute('app_pilote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pilote/new.html.twig', [
            'pilote' => $pilote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pilote_show', methods: ['GET'])]
    public function show(Pilote $pilote): Response
    {
        return $this->render('pilote/show.html.twig', [
            'pilote' => $pilote,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pilote_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pilote $pilote, PiloteRepository $piloteRepository): Response
    {
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $piloteRepository->add($pilote, true);

            return $this->redirectToRoute('app_pilote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pilote/edit.html.twig', [
            'pilote' => $pilote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pilote_delete', methods: ['POST'])]
    public function delete(Request $request, Pilote $pilote, PiloteRepository $piloteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pilote->getId(), $request->request->get('_token'))) {
            $piloteRepository->remove($pilote, true);
        }

        return $this->redirectToRoute('app_pilote_index', [], Response::HTTP_SEE_OTHER);
    }
}
