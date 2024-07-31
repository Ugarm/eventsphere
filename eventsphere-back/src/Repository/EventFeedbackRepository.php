<?php

namespace App\Repository;

use App\Entity\EventFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventFeedback>
 *
 * @method EventFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventFeedback[]    findAll()
 * @method EventFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventFeedback::class);
    }

    //    /**
    //     * @return EventFeedback[] Returns an array of EventFeedback objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EventFeedback
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
