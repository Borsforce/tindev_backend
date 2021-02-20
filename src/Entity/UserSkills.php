<?php

namespace App\Entity;

use App\Repository\UserSkillsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserSkillsRepository::class)
 */
class UserSkills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Skill")
     * @ORM\JoinColumn(name="skill_id", referencedColumnName="id")
     */
    private $skillId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTop;

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

    public function getSkillId(): ?int
    {
        return $this->skillId;
    }

    public function setSkillId(int $skillId): self
    {
        $this->skillId = $skillId;

        return $this;
    }

    public function getIsTop(): ?bool
    {
        return $this->isTop;
    }

    public function setIsTop(bool $isTop): self
    {
        $this->isTop = $isTop;

        return $this;
    }
}
