<?php

namespace App\Entity;

use App\Repository\CarshareRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarshareRepository::class)]
class Carshare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $departure_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $deaprture_hour = null;

    #[ORM\Column(length: 45)]
    private ?string $departure_location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $arrival_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $arrival_hour = null;

    #[ORM\Column(length: 45)]
    private ?string $arrival_location = null;

    #[ORM\Column(length: 45)]
    private ?string $status = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $available_seats = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departure_date;
    }

    public function setDepartureDate(\DateTimeInterface $departure_date): static
    {
        $this->departure_date = $departure_date;

        return $this;
    }

    public function getDeaprtureHour(): ?\DateTimeInterface
    {
        return $this->deaprture_hour;
    }

    public function setDeaprtureHour(\DateTimeInterface $deaprture_hour): static
    {
        $this->deaprture_hour = $deaprture_hour;

        return $this;
    }

    public function getDepartureLocation(): ?string
    {
        return $this->departure_location;
    }

    public function setDepartureLocation(string $departure_location): static
    {
        $this->departure_location = $departure_location;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): static
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getArrivalHour(): ?\DateTimeInterface
    {
        return $this->arrival_hour;
    }

    public function setArrivalHour(\DateTimeInterface $arrival_hour): static
    {
        $this->arrival_hour = $arrival_hour;

        return $this;
    }

    public function getArrivalLocation(): ?string
    {
        return $this->arrival_location;
    }

    public function setArrivalLocation(string $arrival_location): static
    {
        $this->arrival_location = $arrival_location;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAvailableSeats(): ?int
    {
        return $this->available_seats;
    }

    public function setAvailableSeats(int $available_seats): static
    {
        $this->available_seats = $available_seats;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
