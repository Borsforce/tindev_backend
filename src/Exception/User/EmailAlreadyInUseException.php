<?php

namespace App\Exception\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EmailAlreadyInUseException extends HttpException
{
    public function __construct()
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, 'error.user.email_already_in_use');
    }
}
