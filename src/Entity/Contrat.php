<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $natureContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dureeContrat;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNatureContrat(): ?string
    {
        return $this->natureContrat;
    }

    public function setNatureContrat(string $natureContrat): self
    {
        $this->natureContrat = $natureContrat;

        return $this;
    }

    public function getDureeContrat(): ?string
    {
        return $this->dureeContrat;
    }

    public function setDureeContrat(string $dureeContrat): self
    {
        $this->dureeContrat = $dureeContrat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }
}
