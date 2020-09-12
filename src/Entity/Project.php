<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     * @ORM\ManyToMany(targetEntity=OrganisationUnit::class, inversedBy="projects")
     */
    private $organisationUnits;

    /**
     * @ORM\OneToMany(targetEntity=Shift::class, mappedBy="project")
     */
    private $shifts;

    public function __construct()
    {
        $this->organisationUnits = new ArrayCollection();
        $this->shifts = new ArrayCollection();
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
     * @return Collection|OrganisationUnit[]
     */
    public function getOrganisationUnits(): Collection
    {
        return $this->organisationUnits;
    }

    public function addOrganisationUnit(OrganisationUnit $organisationUnit): self
    {
        if (!$this->organisationUnits->contains($organisationUnit)) {
            $this->organisationUnits[] = $organisationUnit;
        }

        return $this;
    }

    public function removeOrganisationUnit(OrganisationUnit $organisationUnit): self
    {
        if ($this->organisationUnits->contains($organisationUnit)) {
            $this->organisationUnits->removeElement($organisationUnit);
        }

        return $this;
    }

    /**
     * @return Collection|Shift[]
     */
    public function getShifts(): Collection
    {
        return $this->shifts;
    }

    public function addShift(Shift $shift): self
    {
        if (!$this->shifts->contains($shift)) {
            $this->shifts[] = $shift;
            $shift->setProject($this);
        }

        return $this;
    }

    public function removeShift(Shift $shift): self
    {
        if ($this->shifts->contains($shift)) {
            $this->shifts->removeElement($shift);
            // set the owning side to null (unless already changed)
            if ($shift->getProject() === $this) {
                $shift->setProject(null);
            }
        }

        return $this;
    }
}
