<?php

namespace App\Entity\DetailModePyement;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Entity\Encaissement\Encaissement;
use App\Repository\DetailModePayement\DetailModePayementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailModePayementRepository::class)]
class DetailModePayement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $montant = null;

    #[ORM\ManyToOne(inversedBy: 'detailModePayements')]
    private ?Encaissement $encaissement = null;

    #[ORM\ManyToOne(inversedBy: 'detailModePayements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?BanqueClient $BanqueClient = null;

    #[ORM\ManyToOne(inversedBy: 'detailModePayements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?BanqueOnly $banque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getEncaissement(): ?Encaissement
    {
        return $this->encaissement;
    }

    public function setEncaissement(?Encaissement $encaissement): static
    {
        $this->encaissement = $encaissement;

        return $this;
    }

    public function getBanqueClient(): ?BanqueClient
    {
        return $this->BanqueClient;
    }

    public function setBanqueClient(?BanqueClient $BanqueClient): static
    {
        $this->BanqueClient = $BanqueClient;

        return $this;
    }

    public function getBanque(): ?BanqueOnly
    {
        return $this->banque;
    }

    public function setBanque(?BanqueOnly $banque): static
    {
        $this->banque = $banque;

        return $this;
    }
}
