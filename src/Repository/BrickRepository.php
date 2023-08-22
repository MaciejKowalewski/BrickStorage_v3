<?php

namespace App\Repository;

use App\Entity\Brick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Brick>
 *
 * @method Brick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brick[]    findAll()
 * @method Brick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrickRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brick::class);
    }

    public function save(Brick $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Brick $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function showFirstNthBricks(int $n, string $sortby='BrickId', string $orderby='ASC'){
        $qb = $this->createQueryBuilder('b');
        $qb->orderBy('b.'.$sortby, $orderby);
        $qb->setMaxResults($n);
        return $qb->getQuery()->execute();
    }

    public function paginateBricks(string $search, string $orderBy, int $offset){
        $qb = $this->createQueryBuilder('b');
        $qb
            ->orWhere('b.BrickId LIKE :search')
            ->orWhere('LOWER(b.Name) LIKE LOWER(:search)')
            ->setParameter('search', '%'.$search.'%');
        switch($orderBy){
            case 'BrickId_ASC':
                $qb->orderBy('b.BrickId', 'ASC');
                break;
            case 'BrickId_DESC':
                $qb->orderBy('b.BrickId', 'DESC');
                break;
            case 'name_ASC':
                $qb->orderBy('b.Name', 'ASC');
                break;
            case 'name_DESC':
                $qb->orderBy('b.Name', 'DESC');
                break;
            case 'color_ASC':
                $qb->orderBy('b.Color', 'ASC');
                break;
            case 'color_DESC':
                $qb->orderBy('b.Color', 'DESC');
                break;
        }
        $qb
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->getQuery();
        
        return new Paginator($qb);
    }

    public function findBrickBy(string $BrickId, string $Color){
        $qb = $this->createQueryBuilder('b');
        $qb
            ->orWhere('b.BrickId LIKE :BrickId')
            ->setParameter('BrickId', '%'.$BrickId.'%')
            ->orWhere('LOWER(b.Color) LIKE LOWER(:Color)')
            ->setParameter('Color', '%'.$Color.'%');
        return $qb->getQuery();
    }

}
