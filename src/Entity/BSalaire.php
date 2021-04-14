<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BSalaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BSalaireRepository::class)
 */
class BSalaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $mois;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salaireBase;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salaireBrut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surSalaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMois(): ?\DateTimeInterface
    {
        return $this->mois;
    }

    public function setMois(\DateTimeInterface $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getSalaireBase(): ?string
    {
        return $this->salaireBase;
    }

    public function setSalaireBase(string $salaireBase): self
    {
        $this->salaireBase = $salaireBase;

        return $this;
    }

    public function getSalaireBrut(): ?string
    {
        return $this->salaireBrut;
    }

    public function setSalaireBrut(string $salaireBrut): self
    {
        $this->salaireBrut = $salaireBrut;

        return $this;
    }

    public function getSurSalaire(): ?string
    {
        return $this->surSalaire;
    }

    public function setSurSalaire(string $surSalaire): self
    {
        $this->surSalaire = $surSalaire;

        return $this;
    }
}
