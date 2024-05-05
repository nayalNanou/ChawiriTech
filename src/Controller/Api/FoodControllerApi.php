<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Food;
use App\Entity\FoodOrder;

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
				"description" => $food->getDescription(),
				"price" => $food->getPrice()
			];
		}

		return new JsonResponse($arrayFoodByCategory);
	}

	#[Route("/add_order", name: "add_order")]
	public function addFoodOrder(Request $request, EntityManagerInterface $entityManager)
	{
 		$requestMethod = $request->server->get('REQUEST_METHOD');
        $foodName = $request->request->get('foodName');
		$foodImage = $request->request->get('foodImage');
		$foodPrice = $request->request->get('foodPrice');

		if ($requestMethod == 'POST' && ($foodName && $foodImage && $foodPrice)) {
			$foodOrder = new FoodOrder();

			$foodOrder->setName($foodName);
			$foodOrder->setImage($foodImage);
			$foodOrder->setPrice($foodPrice);

			$entityManager->persist($foodOrder);
			$entityManager->flush();

			return new JsonResponse("La commande a bien été ajouté");
		} else {
			return new JsonResponse("Il y eu une erreur lors de l'ajout d'une commande");
		}
	}

	#[Route("/order_list", name: "order_list")]
	public function getFoodOrderList(EntityManagerInterface $entityManager)
	{
		$foodOrders = $entityManager->getRepository(FoodOrder::class)->findAll();

		$foodOrdersArray = [];

		foreach ($foodOrders as $foodOrder) {
			$foodOrdersArray[] = [
				"id" => $foodOrder->getId(),
				"name" => $foodOrder->getName(),
				"image" => $foodOrder->getImage(),
				"price" => $foodOrder->getPrice()
			];
		}

		return new JsonResponse($foodOrdersArray);
	}

	#[Route("/delete_all_food_order", name: "delete_all_food_order")]
	public function deleteAllFoodOrder(EntityManagerInterface $entityManager)
	{
		$entityManager->getRepository(FoodOrder::class)->deleteAllFoodOrder();

		return new JsonResponse("Les commandes ont bien été supprimé du panier");
	}
}