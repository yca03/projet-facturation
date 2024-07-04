<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $RaisonSocial = null;

    #[ORM\Column(length: 255)]
    private ?string $FormeJuridique = null;

    #[ORM\Column(length: 255)]
    private ?string $Activite = null;

    #[ORM\Column(length: 255)]
    private ?string $Numero = null;

    #[ORM\Column(length: 255)]
    private ?string $Siege = null;

    #[ORM\Column(length: 255)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $AdressePostal = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $SiteInternet = null;

    #[ORM\Column(length: 255)]
    private ?string $CodeCommercial = null;

    #[ORM\Column(length: 255)]
    private ?string $RegimeFiscal = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->RaisonSocial;
    }

    public function setRaisonSocial(string $RaisonSocial): static
    {
        $this->RaisonSocial = $RaisonSocial;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->FormeJuridique;
    }

    public function setFormeJuridique(string $FormeJuridique): static
    {
        $this->FormeJuridique = $FormeJuridique;

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

    public function getNumero(): ?string
    {
        return $this->Numero;
    }

    public function setNumero(string $Numero): static
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getSiege(): ?string
    {
        return $this->Siege;
    }

    public function setSiege(string $Siege): static
    {
        $this->Siege = $Siege;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

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

    public function getAdressePostal(): ?string
    {
        return $this->AdressePostal;
    }

    public function setAdressePostal(string $AdressePostal): static
    {
        $this->AdressePostal = $AdressePostal;

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

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->SiteInternet;
    }

    public function setSiteInternet(string $SiteInternet): static
    {
        $this->SiteInternet = $SiteInternet;

        return $this;
    }

    public function getCodeCommercial(): ?string
    {
        return $this->CodeCommercial;
    }

    public function setCodeCommercial(string $CodeCommercial): static
    {
        $this->CodeCommercial = $CodeCommercial;

        return $this;
    }

    public function getRegimeFiscal(): ?string
    {
        return $this->RegimeFiscal;
    }

    public function setRegimeFiscal(string $RegimeFiscal): static
    {
        $this->RegimeFiscal = $RegimeFiscal;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

}
