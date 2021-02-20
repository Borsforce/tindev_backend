<?php

declare(strict_types=1);

namespace App\Dto;

final class Project
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;


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
}
