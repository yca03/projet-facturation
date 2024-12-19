<?php

namespace App\Entity;

use App\Entity\Encaissement\DetatilEncaissement;
use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
    #[ORM\OneToMany(targetEntity: DetailFacture::class, mappedBy: 'facture', cascade: ['persist'], orphanRemoval: true)]
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

    /**
     * @var Collection<int, FactureProFormat>
     */
    #[ORM\OneToMany(targetEntity: FactureProFormat::class, mappedBy: 'convertir')]
    private Collection $factureProFormats;

    /**
     * @var Collection<int, DetatilEncaissement>
     */
    #[ORM\OneToMany(targetEntity: DetatilEncaissement::class, mappedBy: 'facture')]
    private Collection $detatilEncaissements;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $StatutPaye = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reste = null;

    /**
     * @var Collection<int, Notify>
     */
    #[ORM\OneToMany(targetEntity: Notify::class, mappedBy: 'Facture')]
    private Collection $notifies;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $remise = null;



    public function __construct()
    {
        $this->detailFactures = new ArrayCollection();
        $this->factureProFormats = new ArrayCollection();
        $this->detatilEncaissements = new ArrayCollection();
        $this->notifies = new ArrayCollection();
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

    /**
     * @return Collection<int, FactureProFormat>
     */
    public function getFactureProFormats(): Collection
    {
        return $this->factureProFormats;
    }

    public function addFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if (!$this->factureProFormats->contains($factureProFormat)) {
            $this->factureProFormats->add($factureProFormat);
            $factureProFormat->setConvertir($this);
        }

        return $this;
    }

    public function removeFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if ($this->factureProFormats->removeElement($factureProFormat)) {
            // set the owning side to null (unless already changed)
            if ($factureProFormat->getConvertir() === $this) {
                $factureProFormat->setConvertir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetatilEncaissement>
     */
    public function getDetatilEncaissements(): Collection
    {
        return $this->detatilEncaissements;
    }

    public function addDetatilEncaissement(DetatilEncaissement $detatilEncaissement): static
    {
        if (!$this->detatilEncaissements->contains($detatilEncaissement)) {
            $this->detatilEncaissements->add($detatilEncaissement);
            $detatilEncaissement->setFacture($this);
        }

        return $this;
    }

    public function removeDetatilEncaissement(DetatilEncaissement $detatilEncaissement): static
    {
        if ($this->detatilEncaissements->removeElement($detatilEncaissement)) {
            // set the owning side to null (unless already changed)
            if ($detatilEncaissement->getFacture() === $this) {
                $detatilEncaissement->setFacture(null);
            }
        }

        return $this;
    }

    public function getStatutPaye(): ?string
    {
        return $this->StatutPaye;
    }

    public function setStatutPaye(?string $StatutPaye): static
    {
        $this->StatutPaye = $StatutPaye;

        return $this;
    }

    public function getReste(): ?string
    {
        return $this->reste;
    }

    public function setReste(?string $reste): static
    {
        $this->reste = $reste;

        return $this;
    }

    /**
     * @return Collection<int, Notify>
     */
    public function getNotifies(): Collection
    {
        return $this->notifies;
    }

    public function addNotify(Notify $notify): static
    {
        if (!$this->notifies->contains($notify)) {
            $this->notifies->add($notify);
            $notify->setFacture($this);
        }

        return $this;
    }

    public function removeNotify(Notify $notify): static
    {
        if ($this->notifies->removeElement($notify)) {
            // set the owning side to null (unless already changed)
            if ($notify->getFacture() === $this) {
                $notify->setFacture(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): static
    {
        $this->remise = $remise;

        return $this;
    }


}
