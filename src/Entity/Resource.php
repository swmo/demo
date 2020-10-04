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
    private $resourceGroups;

    /**
     * @ORM\OneToMany(targetEntity=ShiftWork::class, mappedBy="resource")
     */
    private $shiftWorks;

    /**
     * @ORM\ManyToMany(targetEntity=OrganisationUnit::class, mappedBy="resources")
     */
    private $organisationUnits;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="projectResources")
     */
    private $projects;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="resources")
     */
    private $events;


    public function __construct()
    {
        $this->resourceGroups = new ArrayCollection();
        $this->shiftWorks = new ArrayCollection();
        $this->organisationUnits = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->events = new ArrayCollection();
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
    public function getResourceGroups(): Collection
    {
        return $this->resourceGroups;
    }

    public function addResourceGroup(ResourceGroup $resourceGroup): self
    {
        if (!$this->resourceGroups->contains($resourceGroup)) {
            $this->resourceGroups[] = $resourceGroup;
        }

        return $this;
    }

    public function removeResourceGroup(ResourceGroup $resourceGroup): self
    {
        if ($this->resourceGroups->contains($resourceGroup)) {
            $this->resourceGroups->removeElement($resourceGroup);
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
            $organisationUnit->addResource($this);
        }

        return $this;
    }


    public function removeOrganisationUnit(OrganisationUnit $organisationUnit): self
    {
        if ($this->organisationUnits->contains($organisationUnit)) {
            $this->organisationUnits->removeElement($organisationUnit);
            $organisationUnit->removeResource($this);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addProjectResource($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeProjectResource($this);
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addResource($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeResource($this);
        }

        return $this;
    }




}
