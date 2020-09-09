<?php

namespace App\Entity;

use App\Repository\DependencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DependencyRepository::class)
 */
class Dependency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Shift::class, inversedBy="dependencies")
     */
    private $shift;

    /**
     * @ORM\ManyToOne(targetEntity=ResourceGroup::class, inversedBy="dependencies")
     */
    private $resourceGroup;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

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

    public function getResourceGroup(): ?ResourceGroup
    {
        return $this->resourceGroup;
    }

    public function setResourceGroup(?ResourceGroup $resourceGroup): self
    {
        $this->resourceGroup = $resourceGroup;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
