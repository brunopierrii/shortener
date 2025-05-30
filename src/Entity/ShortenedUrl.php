<?php

namespace App\Entity;

use App\Repository\ShortenedUrlRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShortenedUrlRepository::class)]
class ShortenedUrl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id' ,type: 'integer')]
    private int $id;
    #[ORM\Column(name: 'short_url', type: 'string', length: 255)]
    private string $shortUrl;
    #[ORM\Column(name: 'original_url', type: 'string', length: 255)]
    private string $originalUrl;
    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;
    #[ORM\Column(name: 'clicks', type: 'integer', nullable: true)]
    private ?int $clicks = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

    public function setShortUrl(string $shortUrl): void
    {
        $this->shortUrl = $shortUrl;
    }

    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(?int $clicks): void
    {
        $this->clicks = $clicks;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}
