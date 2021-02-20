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
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profile_image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $header_image;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $job_status;

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
    private $portfilo_link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $twitter_handle;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $job_title;

    /**
     * @ORM\Column(type="integer")
     */
    private $earned_coins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profile_image;
    }

    public function setProfileImage(?string $profile_image): self
    {
        $this->profile_image = $profile_image;

        return $this;
    }

    public function getHeaderImage(): ?string
    {
        return $this->header_image;
    }

    public function setHeaderImage(?string $header_image): self
    {
        $this->header_image = $header_image;

        return $this;
    }

    public function getJobStatus(): ?string
    {
        return $this->job_status;
    }

    public function setJobStatus(?string $job_status): self
    {
        $this->job_status = $job_status;

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
        return $this->portfilo_link;
    }

    public function setPortfiloLink(?string $portfilo_link): self
    {
        $this->portfilo_link = $portfilo_link;

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
        return $this->twitter_handle;
    }

    public function setTwitterHandle(?string $twitter_handle): self
    {
        $this->twitter_handle = $twitter_handle;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(?string $job_title): self
    {
        $this->job_title = $job_title;

        return $this;
    }

    public function getEarnedCoins(): ?int
    {
        return $this->earned_coins;
    }

    public function setEarnedCoins(int $earned_coins): self
    {
        $this->earned_coins = $earned_coins;

        return $this;
    }
}
