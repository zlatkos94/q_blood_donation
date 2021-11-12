<?php

namespace App\Repository;

use App\Entity\DonorDonation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonorDonation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonorDonation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonorDonation[]    findAll()
 * @method DonorDonation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonorDonationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonorDonation::class);
    }

    // /**
    //  * @return DonorDonation[] Returns an array of DonorDonation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DonorDonation
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
