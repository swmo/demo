<?php

namespace App\Entity;

use App\Repository\ShiftWorkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShiftWorkRepository::class)
 */
class ShiftWork
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Shift::class, inversedBy="shiftWorks")
     */
    private $shift;

    /**
     * @ORM\ManyToOne(targetEntity=Resource::class, inversedBy="shiftWorks")
     */
    private $resource;

    /**
     * @ORM\ManyToOne(targetEntity=ResourceGroup::class, inversedBy="shiftWorks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resourceGroup;

    /**
     * @ORM\Column(type="json", nullable=true)
     * draft, registred, accepted
     */
    private $currentPlace = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShift(): ?Shift
    {
        return $this->shift;
    }

    public function setShift(?Shift $shift): self
    {
        $this->shift = $shift;

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function getResourceGroup(): ?ResourceGroup
    {
        return $this->resourceGroup;
    }

    public function setResourceGroup(?ResourceGroup $resourceGroup): self
    {
        $this->resourceGroup = $resourceGroup;

        return $this;
    }

    public function getCurrentPlace(): ?array
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace(?array $currentPlace): self
    {
        $this->currentPlace = $currentPlace;

        return $this;
    }
}
