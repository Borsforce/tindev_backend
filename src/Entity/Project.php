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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dueDate;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="projectsAttending")
     */
    private $projectAttendees;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projectsCreated")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=ProjectContribution::class, mappedBy="project")
     */
    private $projectContributions;

    public function __construct()
    {
        $this->projectAttendees = new ArrayCollection();
        $this->projectContributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getProjectAttendees(): Collection
    {
        return $this->projectAttendees;
    }

    public function addProjectAttendee(User $projectAttendee): self
    {
        if (!$this->projectAttendees->contains($projectAttendee)) {
            $this->projectAttendees[] = $projectAttendee;
        }

        return $this;
    }

    public function removeProjectAttendee(User $projectAttendee): self
    {
        $this->projectAttendees->removeElement($projectAttendee);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|ProjectContribution[]
     */
    public function getProjectContributions(): Collection
    {
        return $this->projectContributions;
    }

    public function addProjectContribution(ProjectContribution $projectContribution): self
    {
        if (!$this->projectContributions->contains($projectContribution)) {
            $this->projectContributions[] = $projectContribution;
            $projectContribution->setProject($this);
        }

        return $this;
    }

    public function removeProjectContribution(ProjectContribution $projectContribution): self
    {
        if ($this->projectContributions->removeElement($projectContribution)) {
            // set the owning side to null (unless already changed)
            if ($projectContribution->getProject() === $this) {
                $projectContribution->setProject(null);
            }
        }

        return $this;
    }
}
