<?php

namespace App\Entity;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Entity\Encaissement\Encaissement;
use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'IdClient')]
    private Collection $factures;

    #[ORM\Column(length: 255)]
    private ?string $typeSociete = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroCompteContribuable = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $remise = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $siege = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $siteInternet = null;

    #[ORM\Column(length: 255)]
    private ?string $regimeFiscal = null;

    #[ORM\Column(length: 255)]
    private ?string $Activite = null;

    #[ORM\ManyToOne(inversedBy: 'Clients')]
    private ?FactureProFormat $factureProFormat = null;

    /**
     * @var Collection<int, FactureProFormat>
     */
    #[ORM\OneToMany(targetEntity: FactureProFormat::class, mappedBy: 'clients')]
    private Collection $factureProFormats;

    /**
     * @var Collection<int, Encaissement>
     */
    #[ORM\OneToMany(targetEntity: Encaissement::class, mappedBy: 'clients')]
    private Collection $encaissements;

    /**
     * @var Collection<int, BanqueClient>
     */
    #[ORM\OneToMany(targetEntity: BanqueClient::class, mappedBy: 'client')]
    private Collection $banqueClients;

    /**
     * @var Collection<int, OffreCommerciale>
     */
    #[ORM\OneToMany(targetEntity: OffreCommerciale::class, mappedBy: 'clients')]
    private Collection $clientsOffre;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
        $this->factureProFormats = new ArrayCollection();
        $this->encaissements = new ArrayCollection();
        $this->banqueClients = new ArrayCollection();
        $this->clientsOffre = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): static
    {
        if (!$this->factures->contains($facture)) {
            $this->factures->add($facture);
            $facture->setIdClient($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getIdClient() === $this) {
                $facture->setIdClient(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getTypeSociete(): ?string
    {
        return $this->typeSociete;
    }

    public function setTypeSociete(string $typeSociete): static
    {
        $this->typeSociete = $typeSociete;

        return $this;
    }

    public function getNumeroCompteContribuable(): ?string
    {
        return $this->numeroCompteContribuable;
    }

    public function setNumeroCompteContribuable(string $numeroCompteContribuable): static
    {
        $this->numeroCompteContribuable = $numeroCompteContribuable;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSiege(): ?string
    {
        return $this->siege;
    }

    public function setSiege(string $siege): static
    {
        $this->siege = $siege;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->siteInternet;
    }

    public function setSiteInternet(string $siteInternet): static
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    public function getRegimeFiscal(): ?string
    {
        return $this->regimeFiscal;
    }

    public function setRegimeFiscal(string $regimeFiscal): static
    {
        $this->regimeFiscal = $regimeFiscal;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->Activite;
    }

    public function setActivite(string $Activite): static
    {
        $this->Activite = $Activite;

        return $this;
    }

    public function getFactureProFormat(): ?FactureProFormat
    {
        return $this->factureProFormat;
    }

    public function setFactureProFormat(?FactureProFormat $factureProFormat): static
    {
        $this->factureProFormat = $factureProFormat;

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
            $factureProFormat->setClients($this);
        }

        return $this;
    }

    public function removeFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if ($this->factureProFormats->removeElement($factureProFormat)) {
            // set the owning side to null (unless already changed)
            if ($factureProFormat->getClients() === $this) {
                $factureProFormat->setClients(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Encaissement>
     */
    public function getEncaissements(): Collection
    {
        return $this->encaissements;
    }

    public function addEncaissement(Encaissement $encaissement): static
    {
        if (!$this->encaissements->contains($encaissement)) {
            $this->encaissements->add($encaissement);
            $encaissement->setClients($this);
        }

        return $this;
    }

    public function removeEncaissement(Encaissement $encaissement): static
    {
        if ($this->encaissements->removeElement($encaissement)) {
            // set the owning side to null (unless already changed)
            if ($encaissement->getClients() === $this) {
                $encaissement->setClients(null);
            }
        }

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
            $banqueClient->setClient($this);
        }

        return $this;
    }

    public function removeBanqueClient(BanqueClient $banqueClient): static
    {
        if ($this->banqueClients->removeElement($banqueClient)) {
            // set the owning side to null (unless already changed)
            if ($banqueClient->getClient() === $this) {
                $banqueClient->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreCommerciale>
     */
    public function getClientsOffre(): Collection
    {
        return $this->clientsOffre;
    }

    public function addClientsOffre(OffreCommerciale $clientsOffre): static
    {
        if (!$this->clientsOffre->contains($clientsOffre)) {
            $this->clientsOffre->add($clientsOffre);
            $clientsOffre->setClients($this);
        }

        return $this;
    }

    public function removeClientsOffre(OffreCommerciale $clientsOffre): static
    {
        if ($this->clientsOffre->removeElement($clientsOffre)) {
            // set the owning side to null (unless already changed)
            if ($clientsOffre->getClients() === $this) {
                $clientsOffre->setClients(null);
            }
        }

        return $this;
    }
   
}
