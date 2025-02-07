<?php

namespace App\Entity\Banque\BanqueClient;

use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Entity\Clients;
use App\Entity\DetailModePyement\DetailModePayement;
use App\Repository\Banque\BanqueClient\BanqueClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueClientRepository::class)]
class BanqueClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroCompteBanque = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $rib = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $codeAgent = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $numeroBic = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $gestionnaire = null;



    #[ORM\ManyToOne(inversedBy: 'banqueClients')]
    private ?BanqueOnly $banqueOnly = null;

    /**
     * @var Collection<int, DetailModePayement>
     */
    #[ORM\OneToMany(targetEntity: DetailModePayement::class, mappedBy: 'BanqueClient')]
    private Collection $detailModePayements;

    public function __construct()
    {
        $this->detailModePayements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumeroCompteBanque(): ?string
    {
        return $this->numeroCompteBanque;
    }

    public function setNumeroCompteBanque(string $numeroCompteBanque): static
    {
        $this->numeroCompteBanque = $numeroCompteBanque;

        return $this;
    }

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(string $rib): static
    {
        $this->rib = $rib;

        return $this;
    }

    public function getCodeAgent(): ?string
    {
        return $this->codeAgent;
    }

    public function setCodeAgent(string $codeAgent): static
    {
        $this->codeAgent = $codeAgent;

        return $this;
    }

    public function getNumeroBic(): ?string
    {
        return $this->numeroBic;
    }

    public function setNumeroBic(string $numeroBic): static
    {
        $this->numeroBic = $numeroBic;

        return $this;
    }

    public function getGestionnaire(): ?string
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(string $gestionnaire): static
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }


    public function getBanqueOnly(): ?BanqueOnly
    {
        return $this->banqueOnly;
    }

    public function setBanqueOnly(?BanqueOnly $banqueOnly): static
    {
        $this->banqueOnly = $banqueOnly;

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
            $detailModePayement->setBanqueClient($this);
        }

        return $this;
    }

    public function removeDetailModePayement(DetailModePayement $detailModePayement): static
    {
        if ($this->detailModePayements->removeElement($detailModePayement)) {
            // set the owning side to null (unless already changed)
            if ($detailModePayement->getBanqueClient() === $this) {
                $detailModePayement->setBanqueClient(null);
            }
        }

        return $this;
    }
}
