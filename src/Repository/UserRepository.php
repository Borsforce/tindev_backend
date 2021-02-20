<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\User\EmailAlreadyInUseException;
use App\Exception\User\UsernameAlreadyInUseException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function checkUniquenessOfUser(string $username, string $email)
    {
        $query = $this->createQueryBuilder('u');

        /** @var User|null $user */
        $user = $query->select('u')
            ->where('u.username = :username')
            ->orWhere('u.email = :email')
            ->setParameter(':username', $username)
            ->setParameter(':email', $email)
            ->getQuery()
            ->getOneOrNullResult();

        if ($user === null) {
            return;
        }

        if ($user->getEmail() === $email) {
            throw new EmailAlreadyInUseException();
        }

        if ($user->getRealUsername() === $username) {
            throw new UsernameAlreadyInUseException();
        }
    }
}
