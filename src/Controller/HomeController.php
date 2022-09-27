<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\Date;

class HomeController extends AbstractController
{
   
    #[Route('/', name: 'home_rest', methods: ['GET'])]
    public function rest(RestaurantRepository $restRepository): Response
    {
        return $this->render('blogresto.html.twig', [
            'rest' => $restRepository->findAll(),
        ]);
    }

    #[Route('/detail/{id}', name: 'details_review', methods: ['GET', 'POST'])]
    public function show(Restaurant $restaurant,ReviewRepository $reviewRepository,Request $request,): Response
    {
        $review = new review();
        $review->setCreateAt();
        $form = $this->createFormBuilder($review)
            ->add('message')
            ->add('restaurant')
            ->getForm();
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $reviewRepository->add($review, true);

            return $this->render('detail.html.twig', [
                'restaurant' => $restaurant,
                'form' => $form->createView(),
            ]);
        } 
    }   
}
