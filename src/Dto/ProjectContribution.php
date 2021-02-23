<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Project;

final class ProjectContribution
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var array
     */
    private $contributions;

    /**
     * @var int
     */
    private $status;

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getContributions(): ?array
    {
        return $this->contributions;
    }

    public function setContributions(array $contributions): self
    {
        $this->contributions = $contributions;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
