<?php

namespace App\Entity\Encaissement;

use App\Entity\Facture;
use App\Repository\DetatilEncaissement\DetatilEncaissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetatilEncaissementRepository::class)]
class DetatilEncaissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uid = null;

    #[ORM\Column(length: 255)]
    private ?string $solde = null;

    #[ORM\ManyToOne(inversedBy: 'detatilEncaissements')]
    private ?Encaissement $Encaissement = null;

    #[ORM\Column(length: 255 , nullable: true)]
    private ?string $MontantDu = null;

    #[ORM\ManyToOne(inversedBy: 'detatilEncaissements')]
    private ?Facture $facture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $montantVerse = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getEncaissement(): ?Encaissement
    {
        return $this->Encaissement;
    }

    public function setEncaissement(?Encaissement $Encaissement): static
    {
        $this->Encaissement = $Encaissement;

        return $this;
    }

    public function getMontantDu(): ?string
    {
        return $this->MontantDu;
    }

    public function setMontantDu(string $MontantDu): static
    {
        $this->MontantDu = $MontantDu;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): static
    {
        $this->facture = $facture;

        return $this;
    }

    public function getMontantVerse(): ?string
    {
        return $this->montantVerse;
    }

    public function setMontantVerse(?string $montantVerse): static
    {
        $this->montantVerse = $montantVerse;

        return $this;
    }
}
