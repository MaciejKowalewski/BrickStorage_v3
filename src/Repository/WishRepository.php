<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\WishlistProvider;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Wish>
 *
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    const PAGINATOR_PER_PAGE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function save(Wish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Wish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function paginateWishes(string $search, string $orderBy, int $offset){
        $qb = $this->createQueryBuilder('w');
        $qb
            ->orWhere('w.SetId LIKE :search')
            ->orWhere('LOWER(w.Name) LIKE LOWER(:search)')
            ->setParameter('search', '%'.$search.'%');
        switch($orderBy){
            case 'SetId_ASC':
                $qb->orderBy('w.SetId', 'ASC');
                break;
            case 'SetId_DESC':
                $qb->orderBy('w.SetId', 'DESC');
                break;
            case 'name_ASC':
                $qb->orderBy('w.Name', 'ASC');
                break;
            case 'name_DESC':
                $qb->orderBy('w.Name', 'DESC');
                break;
        }
        $qb
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->getQuery();
        
        return new Paginator($qb);
    }
}
