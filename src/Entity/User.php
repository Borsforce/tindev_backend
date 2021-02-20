<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @Assert\NotBlank()
     * @Assert\NotCompromisedPassword()
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private ?string $contactNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $location;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="projectAttendees")
     */
    private ?Project $projectsAttending;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="createdBy")
     */
    private ?Project $projectsCreated;

    /**
     * @ORM\OneToMany(targetEntity=ProjectContribution::class, mappedBy="createdBy")
     */
    private ?ProjectContribution $projectContributions;

    public function __construct()
    {
        $this->projectsAttending = new ArrayCollection();
        $this->projectsCreated = new ArrayCollection();
        $this->projectContributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getRealUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'roles' => $this->roles
        ];
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(?string $contactNumber): self
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjectsAttending(): Collection
    {
        return $this->projectsAttending;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projectsAttending->contains($project)) {
            $this->projectsAttending[] = $project;
            $project->addProjectAttendee($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projectsAttending->removeElement($project)) {
            $project->removeProjectAttendee($this);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjectsCreated(): Collection
    {
        return $this->projectsCreated;
    }

    public function addProjectsCreated(Project $projectsCreated): self
    {
        if (!$this->projectsCreated->contains($projectsCreated)) {
            $this->projectsCreated[] = $projectsCreated;
            $projectsCreated->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProjectsCreated(Project $projectsCreated): self
    {
        if ($this->projectsCreated->removeElement($projectsCreated)) {
            // set the owning side to null (unless already changed)
            if ($projectsCreated->getCreatedBy() === $this) {
                $projectsCreated->setCreatedBy(null);
            }
        }

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
            $projectContribution->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProjectContribution(ProjectContribution $projectContribution): self
    {
        if ($this->projectContributions->removeElement($projectContribution)) {
            // set the owning side to null (unless already changed)
            if ($projectContribution->getCreatedBy() === $this) {
                $projectContribution->setCreatedBy(null);
            }
        }

        return $this;
    }
}
