<?php

namespace App\Entity;

use App\Repository\OperateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperateurRepository::class)
 */
class Operateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $numSiren;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $tarif;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin_contrat;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut_contrat;

    /**
     * @ORM\OneToMany(targetEntity=Station::class, mappedBy="operateur")
     */
    private $possede;

    public function __construct()
    {
        $this->possede = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumSiren(): ?int
    {
        return $this->numSiren;
    }

    public function setNumSiren(int $numSiren): self
    {
        $this->numSiren = $numSiren;

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

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getDateFinContrat(): ?\DateTimeInterface
    {
        return $this->date_fin_contrat;
    }

    public function setDateFinContrat(\DateTimeInterface $date_fin_contrat): self
    {
        $this->date_fin_contrat = $date_fin_contrat;

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
     * @return Collection|Station[]
     */
    public function getPossede(): Collection
    {
        return $this->possede;
    }

    public function addPossede(Station $possede): self
    {
        if (!$this->possede->contains($possede)) {
            $this->possede[] = $possede;
            $possede->setOperateur($this);
        }

        return $this;
    }

    public function removePossede(Station $possede): self
    {
        if ($this->possede->removeElement($possede)) {
            // set the owning side to null (unless already changed)
            if ($possede->getOperateur() === $this) {
                $possede->setOperateur(null);
            }
        }

        return $this;
    }
}
