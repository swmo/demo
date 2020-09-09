<?php

namespace App\Entity;

use App\Repository\ShiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShiftRepository::class)
 */
class Shift
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Dependency::class, mappedBy="shift")
     */
    private $dependencies;

    public function __construct()
    {
        $this->dependencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
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
     * @return Collection|Dependency[]
     */
    public function getDependencies(): Collection
    {
        return $this->dependencies;
    }

    public function addDependency(Dependency $dependency): self
    {
        if (!$this->dependencies->contains($dependency)) {
            $this->dependencies[] = $dependency;
            $dependency->setShift($this);
        }

        return $this;
    }

    public function removeDependency(Dependency $dependency): self
    {
        if ($this->dependencies->contains($dependency)) {
            $this->dependencies->removeElement($dependency);
            // set the owning side to null (unless already changed)
            if ($dependency->getShift() === $this) {
                $dependency->setShift(null);
            }
        }

        return $this;
    }
}
