<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codeFacture = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?Clients $IdClient = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, DetailFacture>
     */
    #[ORM\OneToMany(targetEntity: DetailFacture::class, mappedBy: 'facture', orphanRemoval: true)]
    private Collection $detailFactures;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?ModePayement $modePayement = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateExpiration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalHT = null;

    #[ORM\Column(length: 255 ,nullable: true)]
    private ?string $totalTVA = null;

    #[ORM\Column(length: 255 ,  nullable: true)]
    private ?string $totalTTC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    public function __construct()
    {
        $this->detailFactures = new ArrayCollection();
    }

    /**
     * @var Collection<int, Clients>
     */
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeFacture(): ?string
    {
        return $this->codeFacture;
    }

    public function setCodeFacture(string $codeFacture): static
    {
        $this->codeFacture = $codeFacture;

        return $this;
    }

    /**
     * @return Collection<int, Clients>
     */

    public function getIdClient(): ?Clients
    {
        return $this->IdClient;
    }

    public function setIdClient(?Clients $IdClient): static
    {
        $this->IdClient = $IdClient;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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
            $detailFacture->setFacture($this);
        }

        return $this;
    }

    public function removeDetailFacture(DetailFacture $detailFacture): static
    {
        if ($this->detailFactures->removeElement($detailFacture)) {
            // set the owning side to null (unless already changed)
            if ($detailFacture->getFacture() === $this) {
                $detailFacture->setFacture(null);
            }
        }

        return $this;
    }

    public function getModePayement(): ?ModePayement
    {
        return $this->modePayement;
    }

    public function setModePayement(?ModePayement $modePayement): static
    {
        $this->modePayement = $modePayement;

        return $this;
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

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): static
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getTotalHT(): ?string
    {
        return $this->totalHT;
    }

    public function setTotalHT(string $totalHT): static
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getTotalTVA(): ?string
    {
        return $this->totalTVA;
    }

    public function setTotalTVA(string $totalTVA): static
    {
        $this->totalTVA = $totalTVA;

        return $this;
    }

    public function getTotalTTC(): ?string
    {
        return $this->totalTTC;
    }

    public function setTotalTTC(string $totalTTC): static
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

}
