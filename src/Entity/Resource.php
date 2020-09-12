<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResourceRepository::class)
 */
class Resource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=ResourceGroup::class, inversedBy="resources")
     */
    private $resourceGroup;

    /**
     * @ORM\OneToMany(targetEntity=ShiftWork::class, mappedBy="resource")
     */
    private $shiftWorks;

    public function __construct()
    {
        $this->resourceGroup = new ArrayCollection();
        $this->shiftWorks = new ArrayCollection();
        $this->organisationUnits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ResourceGroup[]
     */
    public function getResourceGroup(): Collection
    {
        return $this->resourceGroup;
    }

    public function addResourceGroup(ResourceGroup $resourceGroup): self
    {
        if (!$this->resourceGroup->contains($resourceGroup)) {
            $this->resourceGroup[] = $resourceGroup;
        }

        return $this;
    }

    public function removeResourceGroup(ResourceGroup $resourceGroup): self
    {
        if ($this->resourceGroup->contains($resourceGroup)) {
            $this->resourceGroup->removeElement($resourceGroup);
        }

        return $this;
    }

    /**
     * @return Collection|ShiftWork[]
     */
    public function getShiftWorks(): Collection
    {
        return $this->shiftWorks;
    }

    public function addShiftWork(ShiftWork $shiftWork): self
    {
        if (!$this->shiftWorks->contains($shiftWork)) {
            $this->shiftWorks[] = $shiftWork;
            $shiftWork->setResource($this);
        }

        return $this;
    }

    public function removeShiftWork(ShiftWork $shiftWork): self
    {
        if ($this->shiftWorks->contains($shiftWork)) {
            $this->shiftWorks->removeElement($shiftWork);
            // set the owning side to null (unless already changed)
            if ($shiftWork->getResource() === $this) {
                $shiftWork->setResource(null);
            }
        }

        return $this;
    }

}
