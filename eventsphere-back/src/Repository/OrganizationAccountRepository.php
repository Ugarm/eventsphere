<?php

namespace App\Repository;

use App\Entity\OrganizationAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrganizationAccount>
 *
 * @method OrganizationAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrganizationAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrganizationAccount[]    findAll()
 * @method OrganizationAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganizationAccount::class);
    }

    //    /**
    //     * @return OrganizationAccount[] Returns an array of OrganizationAccount objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrganizationAccount
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
