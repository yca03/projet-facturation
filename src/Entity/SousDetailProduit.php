<?php

namespace App\Entity;

use App\Repository\SousDetailProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SousDetailProduitRepository::class)]
#[ORM\HasLifecycleCallbacks]
class SousDetailProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\ManyToOne(inversedBy: 'sousDetailProduit')]
    private ?RelationDetailPSousDetailP $relationDetailPSousDetailP = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }
    #[ORM\PrePersist]
    public function setUuid(): static
    {
        $this->uuid = Uuid::v4()->toBase32();

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }
    #[ORM\PrePersist]
    public function setDateDebut(): self
    {
        $this->dateDebut = new \DateTimeImmutable();

        return $this;
    }

    public function getRelationDetailPSousDetailP(): ?RelationDetailPSousDetailP
    {
        return $this->relationDetailPSousDetailP;
    }

    public function setRelationDetailPSousDetailP(?RelationDetailPSousDetailP $relationDetailPSousDetailP): static
    {
        $this->relationDetailPSousDetailP = $relationDetailPSousDetailP;

        return $this;
    }
}
