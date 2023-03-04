<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Section::class,inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'section_id',referencedColumnName: 'id')]
    private Section $section;

    #[ORM\OneToMany(mappedBy: 'product',targetEntity: Order::class)]
    private Collection $orders;
    /**
     * @param string|null $image
     * @param string|null $name
     * @param Section $section
     */
    public function __construct(?string $image, ?string $name, Section $section)
    {
        $this->image = $image;
        $this->name = $name;
        $this->section = $section;
        $this->orders = new ArrayCollection();
    }

    /**
     * @return Section
     */
    public function getSection(): Section
    {
        return $this->section;
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
