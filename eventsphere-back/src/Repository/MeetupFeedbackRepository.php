<?php

namespace App\Repository;

use App\Entity\MeetupFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MeetupFeedback>
 *
 * @method MeetupFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeetupFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeetupFeedback[]    findAll()
 * @method MeetupFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetupFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeetupFeedback::class);
    }

    //    /**
    //     * @return MeetupFeedback[] Returns an array of MeetupFeedback objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MeetupFeedback
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
