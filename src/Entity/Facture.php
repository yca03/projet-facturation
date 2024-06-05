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

}
