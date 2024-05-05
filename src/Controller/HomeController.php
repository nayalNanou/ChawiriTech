<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Food;
use App\Entity\FoodCategory;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route("/", name: "index")]
    public function index(EntityManagerInterface $entityManager)
    {
        $foods = $entityManager->getRepository(Food::class)->findBy([], null, 7);

        $foodCategories = $entityManager->getRepository(FoodCategory::class)->findBy([], null, 6);

        return $this->render('home/index.html.twig', [
            'foods' => $foods,
            'foodCategories' => $foodCategories
        ]);
    }
}
