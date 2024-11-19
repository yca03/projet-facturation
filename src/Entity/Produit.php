<?php

namespace App\Entity;

use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\HasLifecycleCallbacks ]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateDate = null;

    /**
     * @var Collection<int, DetailFacture>
     */
    #[ORM\OneToMany(targetEntity: DetailFacture::class, mappedBy: 'produit')]
    private Collection $detailFactures;

    #[ORM\Column(length: 255)]
    private ?string $prix = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?TypeProduit $typeProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $tva = null;

    /**
     * @var Collection<int, DetailProduit>
     */
    #[ORM\OneToMany(targetEntity: DetailProduit::class, mappedBy: 'produit')]
    private Collection $detailProduits;

    /**
     * @var Collection<int, OffreCommerciale>
     */
    #[ORM\OneToMany(targetEntity: OffreCommerciale::class, mappedBy: 'produits')]
    private Collection $produitsOffre;

    /**
     * @var Collection<int, OffreCommerciale>
     */
    #[ORM\OneToMany(targetEntity: OffreCommerciale::class, mappedBy: 'produit')]
    private Collection $produits;

    #[ORM\Column(length: 255)]
    private ?string $quantite = null;

    public function __construct()
    {
        $this->detailProduits = new ArrayCollection();
        $this->produitsOffre = new ArrayCollection();
        $this->produits = new ArrayCollection();
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

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(?string $uid): static
    {
        $this->uid = $uid;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    #[ORM\PrePersist]
    public function setDateCreation(): static
    {
        $this->dateCreation = new \DateTime();

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): static
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * @return Collection<int, DetailFacture>
     */
    public function getDetailFactures(): Collection
    {
        return $this->detailFactures;
    }

    public function addDetailFacture(DetailFacture $detailFacture): static
    {
        if (!$this->detailFactures->contains($detailFacture)) {
            $this->detailFactures->add($detailFacture);
            $detailFacture->setProduit($this);
        }

        return $this;
    }

    public function removeDetailFacture(DetailFacture $detailFacture): static
    {
        if ($this->detailFactures->removeElement($detailFacture)) {
            // set the owning side to null (unless already changed)
            if ($detailFacture->getProduit() === $this) {
                $detailFacture->setProduit(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }


    public function __toString()
    {
        return $this->libelle;
    }

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(?TypeProduit $typeProduit): static
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * @return Collection<int, DetailProduit>
     */
    public function getDetailProduits(): Collection
    {
        return $this->detailProduits;
    }

    public function addDetailProduit(DetailProduit $detailProduit): static
    {
        if (!$this->detailProduits->contains($detailProduit)) {
            $this->detailProduits->add($detailProduit);
            $detailProduit->setProduit($this);
        }

        return $this;
    }

    public function removeDetailProduit(DetailProduit $detailProduit): static
    {
        if ($this->detailProduits->removeElement($detailProduit)) {
            // set the owning side to null (unless already changed)
            if ($detailProduit->getProduit() === $this) {
                $detailProduit->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreCommerciale>
     */
    public function getProduitsOffre(): Collection
    {
        return $this->produitsOffre;
    }

    public function addProduitsOffre(OffreCommerciale $produitsOffre): static
    {
        if (!$this->produitsOffre->contains($produitsOffre)) {
            $this->produitsOffre->add($produitsOffre);
            $produitsOffre->setProduits($this);
        }

        return $this;
    }

    public function removeProduitsOffre(OffreCommerciale $produitsOffre): static
    {
        if ($this->produitsOffre->removeElement($produitsOffre)) {
            // set the owning side to null (unless already changed)
            if ($produitsOffre->getProduits() === $this) {
                $produitsOffre->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreCommerciale>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(OffreCommerciale $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setProduit($this);
        }

        return $this;
    }

    public function removeProduit(OffreCommerciale $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getProduit() === $this) {
                $produit->setProduit(null);
            }
        }

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }


}
