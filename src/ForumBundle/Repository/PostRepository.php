<?php
/**
 * Created by PhpStorm.
 * User: GiO
 * Date: 24/08/2018
 * Time: 22:26
 */

namespace ForumBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function getAllPosts()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a, COUNT(c) as numberOfSubPosts')
            ->orderBy('a.createdAt', 'DESC')
            ->join('a.subPost', 'c')
            ->groupBy('a.id');

        return $qb->getQuery()->getResult();
    }

    public function getLastPosts($numberOfPosts)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
            ->where("a.subPost != null")
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults($numberOfPosts);

        return $qb->getQuery()->getResult();
    }

    public function getMostPopularPosts($numberOfPosts)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a.id, a.title,a.slug, COUNT(c) as nbOfSubPosts')
            ->innerJoin('a.subPost', 'c')
            ->groupBy('a.id')
            ->orderBy('nbOfSubPosts', 'DESC')
            ->setMaxResults($numberOfPosts);

        return $qb->getQuery()->getResult();
    }

    public function getPostCount()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('COUNT(a)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getPostsPaginated($page, $nbOfElementPerPage)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
            ->setMaxResults($nbOfElementPerPage)
            ->setFirstResult(($page - 1) * $nbOfElementPerPage)
            ->orderBy('a.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }
}