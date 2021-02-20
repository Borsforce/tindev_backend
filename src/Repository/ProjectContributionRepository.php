<?php

namespace App\Repository;

use App\Entity\ProjectContribution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectContribution|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectContribution|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectContribution[]    findAll()
 * @method ProjectContribution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectContributionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectContribution::class);
    }

    // /**
    //  * @return ProjectContribution[] Returns an array of ProjectContribution objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectContribution
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
