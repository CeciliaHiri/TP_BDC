<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 */
class Station
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
    private $nom_station;

    /**
     * @ORM\Column(type="date")
     */
    private $date_mise_en_service;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nb_bornes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_station;

    /**
     * @ORM\Column(type="float")
     */
    private $tarification;

    /**
     * @ORM\Column(type="float")
     */
    private $localisation;

    /**
     * @ORM\ManyToOne(targetEntity=Operateur::class, inversedBy="possede")
     */
    private $operateur;

    /**
     * @ORM\OneToMany(targetEntity=Consommation::class, mappedBy="station")
     */
    private $utilise;

    public function __construct()
    {
        $this->utilise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStation(): ?string
    {
        return $this->nom_station;
    }

    public function setNomStation(string $nom_station): self
    {
        $this->nom_station = $nom_station;

        return $this;
    }

    public function getDateMiseEnService(): ?\DateTimeInterface
    {
        return $this->date_mise_en_service;
    }

    public function setDateMiseEnService(\DateTimeInterface $date_mise_en_service): self
    {
        $this->date_mise_en_service = $date_mise_en_service;

        return $this;
    }

    public function getNbBornes(): ?int
    {
        return $this->Nb_bornes;
    }

    public function setNbBornes(int $Nb_bornes): self
    {
        $this->Nb_bornes = $Nb_bornes;

        return $this;
    }

    public function getAdresseStation(): ?string
    {
        return $this->adresse_station;
    }

    public function setAdresseStation(string $adresse_station): self
    {
        $this->adresse_station = $adresse_station;

        return $this;
    }

    public function getTarification(): ?float
    {
        return $this->tarification;
    }

    public function setTarification(float $tarification): self
    {
        $this->tarification = $tarification;

        return $this;
    }

    public function getLocalisation(): ?float
    {
        return $this->localisation;
    }

    public function setLocalisation(float $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getOperateur(): ?Operateur
    {
        return $this->operateur;
    }

    public function setOperateur(?Operateur $operateur): self
    {
        $this->operateur = $operateur;

        return $this;
    }

    /**
     * @return Collection|Consommation[]
     */
    public function getUtilise(): Collection
    {
        return $this->utilise;
    }

    public function addUtilise(Consommation $utilise): self
    {
        if (!$this->utilise->contains($utilise)) {
            $this->utilise[] = $utilise;
            $utilise->setStation($this);
        }

        return $this;
    }

    public function removeUtilise(Consommation $utilise): self
    {
        if ($this->utilise->removeElement($utilise)) {
            // set the owning side to null (unless already changed)
            if ($utilise->getStation() === $this) {
                $utilise->setStation(null);
            }
        }

        return $this;
    }
}
