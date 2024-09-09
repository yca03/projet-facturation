<?php

namespace App\Entity;

use App\Repository\FactureProFormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureProFormatRepository::class)]
class FactureProformat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column ]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroFacturePro = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEcheance = null;

    /**
     * @var Collection<int, DetailFacture>
     */
    #[ORM\OneToMany(targetEntity: DetailFacture::class, mappedBy: 'factureProformat', cascade: ['persist'], orphanRemoval: true)]
    private Collection $detailFacture;

    #[ORM\ManyToOne(inversedBy: 'factureProFormats')]
    private ?Clients $clients = null;

    #[ORM\ManyToOne(inversedBy: 'factureProFormats')]
    private ?ModePayement $modePayement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalHT = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalTVA = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalTTC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'factureProFormats')]
    private ?Facture $convertir = null;



    public function __construct()
    {
        $this->detailFacture = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getNumeroFacturePro(): ?string
    {
        return $this->numeroFacturePro;
    }

    public function setNumeroFacturePro(string $numeroFacturePro): static
    {
        $this->numeroFacturePro = $numeroFacturePro;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->dateEcheance;
    }

    public function setDateEcheance(\DateTimeInterface $dateEcheance): static
    {
        $this->dateEcheance = $dateEcheance;

        return $this;
    }

    /**
     * @return Collection<int, DetailFacture>
     */
    public function getDetailFacture(): Collection
    {
        return $this->detailFacture;
    }

    public function addDetailFacture(DetailFacture $detailFacture): static
    {
        if (!$this->detailFacture->contains($detailFacture)) {
            $this->detailFacture->add($detailFacture);
            $detailFacture->setFactureProformat($this);
        }

        return $this;
    }

    public function removeDetailFacture(DetailFacture $detailFacture): static
    {
        if ($this->detailFacture->removeElement($detailFacture)) {
            // set the owning side to null (unless already changed)
            if ($detailFacture->getFactureProformat() === $this) {
                $detailFacture->setFactureProformat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Clients>
     */


    /**
     * @return Collection<int, ModePayement>
     */

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): static
    {
        $this->clients = $clients;

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

    public function getTotalHT(): ?string
    {
        return $this->totalHT;
    }

    public function setTotalHT(?string $totalHT): static
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getTotalTVA(): ?string
    {
        return $this->totalTVA;
    }

    public function setTotalTVA(?string $totalTVA): static
    {
        $this->totalTVA = $totalTVA;

        return $this;
    }

    public function getTotalTTC(): ?string
    {
        return $this->totalTTC;
    }

    public function setTotalTTC(?string $totalTTC): static
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

    public function getConvertir(): ?Facture
    {
        return $this->convertir;
    }

    public function setConvertir(?Facture $convertir): static
    {
        $this->convertir = $convertir;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }

}
