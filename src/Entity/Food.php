<?php
namespace App\Entity;

use Doctrine\ORM\Mapping AS ORM;

#[ORM\Entity]
class Food
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

	#[ORM\Column(name: 'description', type: 'text', nullable: true)]
	private ?string $description = null;

	#[ORM\ManyToOne(inversedBy: 'foods', targetEntity: FoodCategory::class)]
	#[ORM\JoinColumn(name: 'food_category_id', referencedColumnName: 'id')]
	private ?FoodCategory $foodCategory = null;

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

	public function getDescription()
	{
		return $this->description;
	}

	public function getFoodCategory()
	{
		return $this->foodCategory;
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

	public function setDescription(?string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function setFoodCategory(?FoodCategory $foodCategory): self
	{
		$this->foodCategory = $foodCategory;

		return $this;
	}
}