<?php
namespace App\Repository;

use App\Entity\FoodOrder;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class FoodOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodOrder::class);
    }

    public function deleteAllFoodOrder()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'TRUNCATE food_order';

        $stmt = $conn->prepare($sql);

        $stmt->executeQuery();
    }
 
}
