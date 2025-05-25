<?php

namespace App\Repository;

use App\Entity\ShortenedUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ShortenedUrlRepository extends ServiceEntityRepository implements ShortenedUrlRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortenedUrl::class);
    }

    public function persist(ShortenedUrl $shortenedUrl): void
    {
        $this->getEntityManager()->persist($shortenedUrl);
        $this->getEntityManager()->flush();
    }
}
