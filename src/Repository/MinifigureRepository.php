<?php

namespace App\Repository;

use App\Entity\Minifigure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Minifigure>
 *
 * @method Minifigure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minifigure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minifigure[]    findAll()
 * @method Minifigure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinifigureRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minifigure::class);
    }

    public function save(Minifigure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Minifigure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function showFirstNthMinifigures(int $n, string $sortby='minifigId', string $orderby='ASC'){
        $qb = $this->createQueryBuilder('m');
        $qb->orderBy('m.'.$sortby, $orderby);
        $qb->setMaxResults($n);
        return $qb->getQuery()->execute();
    }

    public function paginateMinifigures(string $search, string $orderBy, int $offset){
        $qb = $this->createQueryBuilder('m');
        $qb
            ->orWhere('m.minifigId LIKE :search')
            ->orWhere('LOWER(m.name) LIKE LOWER(:search)')
            ->setParameter('search', '%'.$search.'%');
        switch($orderBy){
            case 'MinifigureId_ASC':
                $qb->orderBy('m.minifigId', 'ASC');
                break;
            case 'MinifigureId_DESC':
                $qb->orderBy('m.minifigId', 'DESC');
                break;
            case 'name_ASC':
                $qb->orderBy('m.name', 'ASC');
                break;
            case 'name_DESC':
                $qb->orderBy('m.name', 'DESC');
                break;
        }
        $qb
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->getQuery();
        
        return new Paginator($qb);
    }

    public function findMinifigureBy(string $MinifigureId, string $Color){
        $qb = $this->createQueryBuilder('m');
        $qb
            ->orWhere('m.minifigId LIKE :minifigureId')
            ->setParameter('minifigId', '%'.$MinifigureId.'%')
            ->orWhere('LOWER(m.Color) LIKE LOWER(:Color)')
            ->setParameter('Color', '%'.$Color.'%');
        return $qb->getQuery();
    }
}
