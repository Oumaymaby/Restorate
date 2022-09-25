<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home_restaurant', methods: ['GET'])]
    public function index(RestaurantRepository $restRepository): Response
    {
        return $this->render('home.html.twig', [
            'rest' => $restRepository->findAll(),
        ]);
    }

    #[Route('/rest', name: 'home_rest', methods: ['GET'])]
    public function rest(RestaurantRepository $restRepository): Response
    {
        return $this->render('blogresto.html.twig', [
            'rest' => $restRepository->findAll(),
        ]);
    }

    #[Route('/detail/{id}', name: 'details_review', methods: ['GET', 'POST'])]
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

}
