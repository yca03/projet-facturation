<?php

namespace App\Entity;

use App\Repository\DetailProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: DetailProduitRepository::class)]
class DetailProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'detailProduits',)]
    private ?Produit $produit = null;

    /**
     * @var Collection<int, RelationDetailPSousDetailP>
     */
    #[ORM\OneToMany(targetEntity: RelationDetailPSousDetailP::class, mappedBy: 'detailProduits')]
    private Collection $relationDetailPSousDetailPs;


    public function __construct()
    {
        $this->relationDetailPSousDetailPs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * @return Collection<int, RelationDetailPSousDetailP>
     */
    public function getRelationDetailPSousDetailPs(): Collection
    {
        return $this->relationDetailPSousDetailPs;
    }

    public function addRelationDetailPSousDetailP(RelationDetailPSousDetailP $relationDetailPSousDetailP): static
    {
        if (!$this->relationDetailPSousDetailPs->contains($relationDetailPSousDetailP)) {
            $this->relationDetailPSousDetailPs->add($relationDetailPSousDetailP);
            $relationDetailPSousDetailP->setDetailProduits($this);
        }

        return $this;
    }

    public function removeRelationDetailPSousDetailP(RelationDetailPSousDetailP $relationDetailPSousDetailP): static
    {
        if ($this->relationDetailPSousDetailPs->removeElement($relationDetailPSousDetailP)) {
            // set the owning side to null (unless already changed)
            if ($relationDetailPSousDetailP->getDetailProduits() === $this) {
                $relationDetailPSousDetailP->setDetailProduits(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}