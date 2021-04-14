<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PermissionRepository::class)
 */
class Permission
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
    private $dateDu;

    /**
     * @ORM\Column(type="date")
     */
    private $Audate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="permissions")
     */
    private $employers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDu(): ?\DateTimeInterface
    {
        return $this->dateDu;
    }

    public function setDateDu(\DateTimeInterface $dateDu): self
    {
        $this->dateDu = $dateDu;

        return $this;
    }

    public function getAudate(): ?\DateTimeInterface
    {
        return $this->Audate;
    }

    public function setAudate(\DateTimeInterface $Audate): self
    {
        $this->Audate = $Audate;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmployers(): ?Employe
    {
        return $this->employers;
    }

    public function setEmployers(?Employe $employers): self
    {
        $this->employers = $employers;

        return $this;
    }
}
