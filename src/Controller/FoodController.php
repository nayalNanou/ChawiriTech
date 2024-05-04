<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FoodCategory;
use App\Entity\Food;

#[Route("/food", name: "food_")]
class FoodController extends AbstractController
{
	#[Route("/", name: "index")]
	public function index(EntityManagerInterface $entityManager)
	{
		$foodCategories = $entityManager->getRepository(FoodCategory::class)->findAll();

		$foods = $entityManager->getRepository(Food::class)->findAll();

		dump($foodCategories);
		dump($foods);

		return $this->render('food/index.html.twig', [
			'foodCategories' => $foodCategories,
			'foods' => $foods
		]);
	}
}