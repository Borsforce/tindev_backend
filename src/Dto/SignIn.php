<?php

declare(strict_types=1);

namespace App\Dto;

final class SignIn {
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * SignIn constructor.
     *
     * @param string $token
     */
    public function __construct(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param string
     * 
     * @return SignIn
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string
     * 
     * @return SignIn
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
