<?php

namespace App\Entity;

use App\Repository\RelationDetailPSousDetailPRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


#[ORM\Entity(repositoryClass: RelationDetailPSousDetailPRepository::class)]
#[ORM\HasLifecycleCallbacks]
class RelationDetailPSousDetailP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $uuid = null;

    #[ORM\ManyToOne(inversedBy: 'relationDetailPSousDetailPs')]
    private ?DetailProduit $detailProduits = null;

    /**
     * @var Collection<int, SousDetailProduit>
     */
    #[ORM\OneToMany(targetEntity: SousDetailProduit::class, mappedBy: 'relationDetailPSousDetailP', cascade: ['persist'])]
    private Collection $sousDetailProduit;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    public function __construct()
    {
        $this->sousDetailProduit = new ArrayCollection();
    }

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
        $this->uuid = Uuid::v4();

        return $this;
    }

    public function getDetailProduits(): ?DetailProduit
    {
        return $this->detailProduits;
    }

    public function setDetailProduits(?DetailProduit $detailProduits): static
    {
        $this->detailProduits = $detailProduits;

        return $this;
    }

    /**
     * @return Collection<int, SousDetailProduit>
     */
    public function getSousDetailProduit(): Collection
    {
        return $this->sousDetailProduit;
    }

    public function addSousDetailProduit(SousDetailProduit $sousDetailProduit): static
    {
        if (!$this->sousDetailProduit->contains($sousDetailProduit)) {
            $this->sousDetailProduit->add($sousDetailProduit);
            $sousDetailProduit->setRelationDetailPSousDetailP($this);
        }

        return $this;
    }

    public function removeSousDetailProduit(SousDetailProduit $sousDetailProduit): static
    {
        if ($this->sousDetailProduit->removeElement($sousDetailProduit)) {
            // set the owning side to null (unless already changed)
            if ($sousDetailProduit->getRelationDetailPSousDetailP() === $this) {
                $sousDetailProduit->setRelationDetailPSousDetailP(null);
            }
        }

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }
}
