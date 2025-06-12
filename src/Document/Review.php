<?php
// src/Document/Review.php
declare(strict_types=1);
namespace App\Document;

use DateTimeInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Review
{

    private string $id;

    private ?string $content;

    private int $rating;

    private string $userId;

    private string $carshareId;

    private DateTimeInterface $createdAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCarshareId(): string
    {
        return $this->carshareId;
    }

    public function setCarshareId(string $carshareId): self
    {
        $this->carshareId = $carshareId;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
