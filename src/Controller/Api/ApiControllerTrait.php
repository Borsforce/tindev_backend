<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

trait ApiControllerTrait
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /** @var SerializerInterface */
    private SerializerInterface $serializer;

    /**
     * ApiControllerTrait constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface    $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
}
