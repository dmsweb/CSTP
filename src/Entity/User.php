<?php

namespace App\Entity;

use App\Entity\Employe;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ApiResource( 
 *   collectionOperations={
 *          "get",
 *          "post"={  
 *  "access_control"="is_granted('POST', object)",
*}
 *     }
 * )
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read","write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"read","write"})
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit contenir minimum 8 caractères")
     * @Groups({"write"})
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read","write"})
     */
    private $isActive;

 
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Employe", mappedBy="idUser")
     * @Groups({"read","write"})
     */
    private $employes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="users", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read","write"})
     */
    private $profile;

     
    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->isActive = true;
        $this->profile=   new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [strtoupper($this->profile->getLibelle())];
    }

    
    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Employe[]
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmployes(Employe $employes): self
    {
        if (!$this->employes->contains($employes)) {
            $this->employes[] = $employes;
            $employes->setIdUser($this);
        }

        return $this;
    }

    public function removeEmployes(Employe $employes): self
    {
        if ($this->employes->removeElement($employes)) {
            // set the owning side to null (unless already changed)
            if ($employes->getIdUser() === $this) {
                $employes->setIdUser(null);
            }
        }

        return $this;
    }  
}
