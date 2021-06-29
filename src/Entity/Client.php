<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer", min="10", max="14")
     * .
     * @Assert\NotBlank
     * @Assert\Length(min=10, max=14)
     * @Assert\Type(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\Date
     */
    private $date_debut_contrat;

    /**
     * @ORM\OneToMany(targetEntity=Consommation::class, mappedBy="client")
     */
    private $charge;

    /**
     * @ORM\OneToOne(targetEntity=Admin::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $admin;

    public function __construct()
    {
        $this->charge = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateDebutContrat(): ?\DateTimeInterface
    {
        return $this->date_debut_contrat;
    }

    public function setDateDebutContrat(\DateTimeInterface $date_debut_contrat): self
    {
        $this->date_debut_contrat = $date_debut_contrat;

        return $this;
    }

    /**
     * @return Collection|Consommation[]
     */
    public function getCharge(): Collection
    {
        return $this->charge;
    }

    public function addCharge(Consommation $charge): self
    {
        if (!$this->charge->contains($charge)) {
            $this->charge[] = $charge;
            $charge->setClient($this);
        }

        return $this;
    }

    public function removeCharge(Consommation $charge): self
    {
        if ($this->charge->removeElement($charge)) {
            // set the owning side to null (unless already changed)
            if ($charge->getClient() === $this) {
                $charge->setClient(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        // unset the owning side of the relation if necessary
        if ($admin === null && $this->admin !== null) {
            $this->admin->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($admin !== null && $admin->getClient() !== $this) {
            $admin->setClient($this);
        }

        $this->admin = $admin;

        return $this;
    }
}
