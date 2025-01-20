<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Game;
use App\Entity\User;
use App\Form\GameType;
use App\Repository\CardRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/game')]
final class GameController extends AbstractController
{
    #[Route(name: 'app_game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAllowGames($this->getUser()),
            'winGames' => $gameRepository->findWinGames($this->getUser()),
        ]);
    }

    #[Route('/new/{cardId}/{playerId}', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $entityManager, CardRepository $cardRepository, UserRepository $userRepository, int $cardId, int $playerId): Response
    {
        $card = $cardRepository->find($cardId);
        $player = $userRepository->find($playerId);
        if (!$card || !$player) {
            throw $this->createNotFoundException('Card or Player not found');
        }

        $game = new Game();
        $game->setCard1($card); // Asigna la carta seleccionada al nuevo juego
        $game->setPlayer1($player); // Asigna el jugador seleccionado al nuevo juego
        $game->setStatus(false);
        $entityManager->persist($game);
        $entityManager->flush();
        return $this->redirectToRoute('app_game_index');
    }

    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/edit/{id}/{cardId}/{playerId}', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(EntityManagerInterface $entityManager, GameRepository $gameRepository, CardRepository $cardRepository, UserRepository $userRepository, int $id, int $cardId, int $playerId): Response
    {
        $game = $gameRepository->find($id);
        $card = $cardRepository->find($cardId);
        $player = $userRepository->find($playerId);
        if (!$game || !$card || !$player) {
            throw $this->createNotFoundException('Game, Card or Player not found');
        }

        $game->setCard2($card); // Actualiza la carta seleccionada en el juego
        $game->setPlayer2($player); // Actualiza el jugador seleccionado en el juego
        $game->setStatus(true);
        $entityManager->persist($game);
        $entityManager->flush();
        $status = '';

        if ($game->getCard1()->getPalo() == $game->getCard2()->getPalo() ) {
            if ($game->getCard1()->getNumber() > $game->getCard2()->getNumber()) {
                $game->setWinner($game->getPlayer1());
                $status = 'Perdido';
    
            }else {
                $game->setWinner($game->getPlayer2());
                $status = 'Ganado';
            }
        }else {
            switch ($game->getCard2()->getPalo()) {
                case 'Oros':
                    $game->setWinner($game->getPlayer2());
                    $status = 'Ganado';
                
                case 'Copas':
                    if ($game->getCard1()->getPalo() == 'Oros') {
                        $game->setWinner($game->getPlayer1());
                        $status = 'Perdido';
                    }else {
                        $game->setWinner($game->getPlayer2());
                        $status = 'Ganado';
                    }
                    
                case 'Espadas':
                    if ($game->getCard1()->getPalo() == 'Oros' || $game->getCard1()->getPalo() == 'Copas') {
                        $game->setWinner($game->getPlayer1());
                        $status = 'Perdido';
                    }else {
                        $game->setWinner($game->getPlayer2());
                        $status = 'Ganado';
                    }
                
                case 'Bastos':
                    if ($game->getCard1()->getPalo() == 'Oros' || $game->getCard1()->getPalo() == 'Copas' || $game->getCard1()->getPalo() == 'Espadas') {
                        $game->setWinner($game->getPlayer1());
                        $status = 'Perdido';
                    }else {
                        $game->setWinner($game->getPlayer2());
                        $status = 'Ganado';
                    }
                
            }
        }

        $entityManager->persist($game);
        $entityManager->flush();
        return $this->render('game/status.html.twig', [
            'status' => $status
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }
}
