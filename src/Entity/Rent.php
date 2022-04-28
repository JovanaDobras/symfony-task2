<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
#[ORM\Table("deliverers_vehicles")]

class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Deliverers::class, inversedBy: 'rents')]
    #[ORM\JoinColumn(nullable: false)]
    private $deliverer;

    #[ORM\ManyToOne(targetEntity: Vehicles::class, inversedBy: 'rents')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliverer(): ?Deliverers
    {
        return $this->deliverer;
    }

    public function setDeliverer(?Deliverers $deliverer): self
    {
        $this->deliverer = $deliverer;

        return $this;
    }

    public function getVehicle(): ?Vehicles
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicles $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
