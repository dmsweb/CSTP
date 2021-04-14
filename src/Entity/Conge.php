<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CongeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CongeRepository::class)
 */
class Conge
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
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateReprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeConge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nbrJours;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="conges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateReprise(): ?\DateTimeInterface
    {
        return $this->dateReprise;
    }

    public function setDateReprise(\DateTimeInterface $dateReprise): self
    {
        $this->dateReprise = $dateReprise;

        return $this;
    }

    public function getTypeConge(): ?string
    {
        return $this->typeConge;
    }

    public function setTypeConge(string $typeConge): self
    {
        $this->typeConge = $typeConge;

        return $this;
    }

    public function getNbrJours(): ?string
    {
        return $this->nbrJours;
    }

    public function setNbrJours(string $nbrJours): self
    {
        $this->nbrJours = $nbrJours;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }
}
