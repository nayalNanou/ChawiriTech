<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Food;

#[Route("/api/food", name: "api_food_")]
class FoodControllerApi extends AbstractController
{
	#[Route("/category/{categoryId}", name: "index")]
	public function getFoodByCategory(?int $categoryId, EntityManagerInterface $entityManager)
	{
		$foods = $entityManager->getRepository(Food::class)->findBy(
			["foodCategory" => $categoryId]
		);

		$arrayFoodByCategory = [];

		foreach ($foods as $food) {
			$arrayFoodByCategory[] = [
				"name" => $food->getName(),
				"image" => $food->getImage(),
				"description" => $food->getDescription()
			];
		}

		return new JsonResponse($arrayFoodByCategory);
	}
}