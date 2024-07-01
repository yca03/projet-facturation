<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $Forme = null;

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

    /**
     * @var Collection<int, User>
     */






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

    public function getForme(): ?string
    {
        return $this->Forme;
    }

    public function setForme(string $Forme): static
    {
        $this->Forme = $Forme;

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

    public function getRelation(): ?User
    {
        return $this->relation;
    }

    /**
     * @return Collection<int, User>
     */

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

}
