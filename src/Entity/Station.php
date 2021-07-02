<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"listStation"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"listStation"})
     */
    private $nom_station;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"listStation"})
     */
    private $date_mise_en_service;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"listStation"})
     */
    private $Nb_bornes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"listStation"})
     */
    private $adresse_station;

    /**
     * @ORM\Column(type="float", nullable = true)
     */
    private $tarification;

    /**
     * @ORM\Column(type="string", length =255, nullable = true)
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_station;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     * @Groups({"listStation"})
     */
    private $positionx;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     * @Groups({"listStation"})
     */
    private $positiony;

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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
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

    public function getIdStation(): ?string
    {
        return $this->id_station;
    }

    public function setIdStation(string $id_station): self
    {
        $this->id_station = $id_station;

        return $this;
    }

    public function getPositionx(): ?float
    {
        return $this->positionx;
    }

    public function setPositionx(?float $positionx): self
    {
        $this->positionx = $positionx;

        return $this;
    }

    public function getPositiony(): ?float
    {
        return $this->positiony;
    }

    public function setPositiony(?float $positiony): self
    {
        $this->positiony = $positiony;

        return $this;
    }
}
