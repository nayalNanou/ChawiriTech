<?php
namespace App\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class FoodCategory
{
	#[ORM\Groups("food_category")]
	#[ORM\Id]
	#[ORM\GeneratedValue(strategy: 'IDENTITY')]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(name: 'name', type: 'string', nullable: true)]
	private ?string $name = null;

	#[ORM\Column(name: 'image', type: 'string', nullable: true)]
	private ?string $image = null;

	#[ORM\OneToMany(mappedBy: 'foodCategory', targetEntity: Food::class)]
	private Collection $foods;

	public function __construct()
	{
		$this->foods = new ArrayCollection();
	}

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

    /**
     * @return Collection<int, User>
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function addUser(User $food): self
    {
        if (!$this->foods->contains($food)) {
            $this->foods->add($food);
            $food->setFoodCategory($this);
        }

        return $this;
    }

    public function removeUser(User $food): self
    {
        if ($this->foods->removeElement($food)) {
            // set the owning side to null (unless already changed)
            if ($food->getFoodCategory() === $this) {
                $food->setFoodCategory(null);
            }
        }

        return $this;
    }

}