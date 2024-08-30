<?php

namespace App\Entity\Banque\BanqueOnly;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Entity\DetailModePyement\DetailModePayement;
use App\Repository\Banque\BanqueOnly\BanqueOnlyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueOnlyRepository::class)]
class BanqueOnly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeBanque = null;

    /**
     * @var Collection<int, BanqueClient>
     */
    #[ORM\OneToMany(targetEntity: BanqueClient::class, mappedBy: 'banqueOnly')]
    private Collection $banqueClients;

    /**
     * @var Collection<int, DetailModePayement>
     */
    #[ORM\OneToMany(targetEntity: DetailModePayement::class, mappedBy: 'banque')]
    private Collection $detailModePayements;

    public function __construct()
    {
        $this->banqueClients = new ArrayCollection();
        $this->detailModePayements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeBanque(): ?string
    {
        return $this->codeBanque;
    }

    public function setCodeBanque(?string $codeBanque): static
    {
        $this->codeBanque = $codeBanque;

        return $this;
    }

    /**
     * @return Collection<int, BanqueClient>
     */
    public function getBanqueClients(): Collection
    {
        return $this->banqueClients;
    }

    public function addBanqueClient(BanqueClient $banqueClient): static
    {
        if (!$this->banqueClients->contains($banqueClient)) {
            $this->banqueClients->add($banqueClient);
            $banqueClient->setBanqueOnly($this);
        }

        return $this;
    }

    public function removeBanqueClient(BanqueClient $banqueClient): static
    {
        if ($this->banqueClients->removeElement($banqueClient)) {
            // set the owning side to null (unless already changed)
            if ($banqueClient->getBanqueOnly() === $this) {
                $banqueClient->setBanqueOnly(null);
            }
        }

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
            $detailModePayement->setBanque($this);
        }

        return $this;
    }

    public function removeDetailModePayement(DetailModePayement $detailModePayement): static
    {
        if ($this->detailModePayements->removeElement($detailModePayement)) {
            // set the owning side to null (unless already changed)
            if ($detailModePayement->getBanque() === $this) {
                $detailModePayement->setBanque(null);
            }
        }

        return $this;
    }
}
