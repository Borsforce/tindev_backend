<?php

namespace App\Entity;

use App\Repository\DevRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeveloperRepository::class)
 */
class Developer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profileImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $headerImage;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $jobStatus;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $cv = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $portfiloLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $twitterHandle;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $jobTitle;

    /**
     * @ORM\Column(type="integer")
     */
    private $earnedCoins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(?string $profileImage): self
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    public function getHeaderImage(): ?string
    {
        return $this->headerImage;
    }

    public function setHeaderImage(?string $headerImage): self
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    public function getJobStatus(): ?string
    {
        return $this->jobStatus;
    }

    public function setJobStatus(?string $jobStatus): self
    {
        $this->jobStatus = $jobStatus;

        return $this;
    }

    public function getCv(): ?array
    {
        return $this->cv;
    }

    public function setCv(?array $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPortfiloLink(): ?string
    {
        return $this->portfiloLink;
    }

    public function setPortfiloLink(?string $portfiloLink): self
    {
        $this->portfiloLink = $portfiloLink;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getTwitterHandle(): ?string
    {
        return $this->twitterHandle;
    }

    public function setTwitterHandle(?string $twitterHandle): self
    {
        $this->twitterHandle = $twitterHandle;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getEarnedCoins(): ?int
    {
        return $this->earnedCoins;
    }

    public function setEarnedCoins(int $earnedCoins): self
    {
        $this->earnedCoins = $earnedCoins;

        return $this;
    }
}
