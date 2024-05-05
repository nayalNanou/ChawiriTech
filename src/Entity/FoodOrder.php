<?php
namespace App\Entity;

use Doctrine\ORM\Mapping AS ORM;
use App\Repository\FoodOrderRepository;

#[ORM\Entity(repositoryClass: FoodOrderRepository::class)]
class FoodOrder
{
	#[ORM\Groups("food")]
	#[ORM\Id]
	#[ORM\GeneratedValue(strategy: 'IDENTITY')]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(name: 'name', type: 'string', nullable: true)]
	private ?string $name = null;

	#[ORM\Column(name: 'image', type: 'string', nullable: true)]
	private ?string $image = null;

	#[ORM\Column(name: 'price', type: 'string', nullable: true)]
	private ?string $price = null;

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setName(?string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function setImage(?string $image): self
	{
		$this->image = $image;

		return $this;
	}

	public function setPrice(?string $price): self
	{
		$this->price = $price;

		return $this;
	}
}