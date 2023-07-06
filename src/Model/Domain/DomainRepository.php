<?php declare(strict_types=1);

namespace App\Model\Domain;

use App\Entity\Domain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DomainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Domain::class);
    }

    public function save(Domain $domain): void
    {
        $em = $this->getEntityManager();
        $em->persist($domain);
        $em->flush();
    }
}
