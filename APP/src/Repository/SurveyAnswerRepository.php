<?php

namespace App\Repository;

use App\Entity\SurveyAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveyAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyAnswer[]    findAll()
 * @method SurveyAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyAnswerRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, SurveyAnswer::class);
    }

    /**
     * @return SurveyAnswer[] Returns an array of SurveyAnswer objects
     */
    public function findByExampleField($sort, $field, $page) {
        $qb = $this->createQueryBuilder('s');
        if ($field == 'name') {
            $qb->orderBy('s.lastName', $sort);
        } else {
            $qb->orderBy('s.dob', $sort);
        }
        $qb->setMaxResults(10)
                ->setFirstResult(10*$page)
                ->getQuery();

        return $qb->getQuery()->execute();
    }
    /**
     * @return SurveyAnswer[] Returns an array of SurveyAnswer objects
     */
    public function findSortedBy($sort, $field, $page) {
        $qb = $this->createQueryBuilder('s');
        if ($field == 'name') {
            $qb->orderBy('s.lastName', $sort);
        } else {
            $qb->orderBy('s.dob', $sort);
        }
        $qb->setMaxResults(10)
                ->setFirstResult(10*$page)
                ->getQuery();

        return $qb->getQuery();
    }
    /*
      public function findOneBySomeField($value): ?SurveyAnswer
      {
      return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
