<?php

namespace App\Entity\Encaissement;

use App\Entity\Clients;
use App\Entity\DetailModePyement\DetailModePayement;
use App\Entity\ModePayement;
use App\Repository\Encaissement\EncaissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncaissementRepository::class)]
class Encaissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'encaissements')]
    private ?ModePayement $modePayement = null;

    /**
     * @var Collection<int, DetatilEncaissement>
     */
    #[ORM\OneToMany(targetEntity: DetatilEncaissement::class, mappedBy: 'Encaissement', cascade: ['persist'], orphanRemoval: true)]
    private Collection $detatilEncaissements;

    #[ORM\ManyToOne(targetEntity: Clients::class, inversedBy: 'encaissements')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private ?Clients $clients = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    /**
     * @var Collection<int, DetailModePayement>
     */
    #[ORM\OneToMany(targetEntity: DetailModePayement::class, mappedBy: 'encaissement')]
    private Collection $detailModePayements;

    public function __construct()
    {
        $this->detatilEncaissements = new ArrayCollection();
        $this->detailModePayements = new ArrayCollection();
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



    public function getModePayement(): ?ModePayement
    {
        return $this->modePayement;
    }

    public function setModePayement(?ModePayement $modePayement): static
    {
        $this->modePayement = $modePayement;

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
            $detatilEncaissement->setEncaissement($this);
        }

        return $this;
    }

    public function removeDetatilEncaissement(DetatilEncaissement $detatilEncaissement): static
    {
        if ($this->detatilEncaissements->removeElement($detatilEncaissement)) {
            // set the owning side to null (unless already changed)
            if ($detatilEncaissement->getEncaissement() === $this) {
                $detatilEncaissement->setEncaissement(null);
            }
        }

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): static
    {
        $this->clients = $clients;

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
     * @return Collection<int, DetailModePayement>
     */
    public function getDetailModePayements(): Collection
    {
        return $this->detailModePayements;
    }

    public function addDetailModePayement(DetailModePayement $detailModePayement): static
    {
        if (!$this->detailModePayements->contains($detailModePayement)) {
            $this->detailModePayements->add($detailModePayement);
            $detailModePayement->setEncaissement($this);
        }

        return $this;
    }

    public function removeDetailModePayement(DetailModePayement $detailModePayement): static
    {
        if ($this->detailModePayements->removeElement($detailModePayement)) {
            // set the owning side to null (unless already changed)
            if ($detailModePayement->getEncaissement() === $this) {
                $detailModePayement->setEncaissement(null);
            }
        }

        return $this;
    }
}
