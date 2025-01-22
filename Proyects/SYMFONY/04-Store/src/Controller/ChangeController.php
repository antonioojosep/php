<?php

namespace App\Controller;

use App\Entity\Change;
use App\Enum\ChangeType as EnumChangeType;
use App\Form\ChangeType;
use App\Repository\ChangeRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/change')]
final class ChangeController extends AbstractController
{
    #[Route(name: 'app_change_index', methods: ['GET'])]
    public function index(ChangeRepository $changeRepository): Response
    {
        return $this->render('change/index.html.twig', [
            'changes' => $changeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_change_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ChangeRepository $changeRepository): Response
    {
        $change = new Change();
        $form = $this->createForm(ChangeType::class, $change);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->get('type')->getData();
            $product = $form->get('product')->getData();
            $productAmount = $product->getAmount();
            $amount = $product->getNewAmount();

            if ($type == EnumChangeType::OUTPUT && $amount > $productAmount) {
                return $this->render('change/new.html.twig', [
                    'change' => $change,
                    'form' => $form,
                    'error' => 'The amount is greater than the amount in stock',
                ]);
            }
            
            $entityManager->persist($change);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('change/new.html.twig', [
            'change' => $change,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_change_show', methods: ['GET'])]
    public function show(Change $change): Response
    {
        return $this->render('change/show.html.twig', [
            'change' => $change,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_change_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Change $change, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChangeType::class, $change);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_change_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('change/edit.html.twig', [
            'change' => $change,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_change_delete', methods: ['POST'])]
    public function delete(Request $request, Change $change, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$change->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($change);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_change_index', [], Response::HTTP_SEE_OTHER);
    }
}
