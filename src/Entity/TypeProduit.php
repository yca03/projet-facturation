<?php

namespace App\Entity;

use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Repository\TypeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeProduitRepository::class)]
class TypeProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'typeProduit')]
    private Collection $produits;

    /**
     * @var Collection<int, OffreCommerciale>
     */
    #[ORM\OneToMany(targetEntity: OffreCommerciale::class, mappedBy: 'typeProduit')]
    private Collection $typeProduits;

    public function __construct()
    {
        $this->typeProduits = new ArrayCollection();
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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setTypeProduit($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getTypeProduit() === $this) {
                $produit->setTypeProduit(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
            return $this->libelle;
    }

    /**
     * @return Collection<int, OffreCommerciale>
     */
    public function getTypeProduits(): Collection
    {
        return $this->typeProduits;
    }

    public function addTypeProduit(OffreCommerciale $typeProduit): static
    {
        if (!$this->typeProduits->contains($typeProduit)) {
            $this->typeProduits->add($typeProduit);
            $typeProduit->setTypeProduit($this);
        }

        return $this;
    }

    public function removeTypeProduit(OffreCommerciale $typeProduit): static
    {
        if ($this->typeProduits->removeElement($typeProduit)) {
            // set the owning side to null (unless already changed)
            if ($typeProduit->getTypeProduit() === $this) {
                $typeProduit->setTypeProduit(null);
            }
        }

        return $this;
    }


}
