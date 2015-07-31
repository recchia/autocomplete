<?php
/**
 * Created by PhpStorm.
 * User: recchia
 * Date: 30/07/15
 * Time: 01:33 AM
 */

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PersonRepository extends EntityRepository
{
    public function findLikeFullname($fullname)
    {
        return $this->createQueryBuilder('person_repository')
            ->where('person_repository.fullname LIKE :name')
            ->setParameter('name', '%' . $fullname . '%')
            ->getQuery()
            ->getResult();
    }

    public function findLikeFullnameArray($fullname)
    {
        return $this->createQueryBuilder('person_repository')
            ->where('person_repository.fullname LIKE :name')
            ->setParameter('name', '%' . $fullname . '%')
            ->getQuery()
            ->getArrayResult();
    }
}