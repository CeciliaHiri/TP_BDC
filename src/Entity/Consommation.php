<?php

namespace App\Entity;

use App\Repository\ConsommationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsommationRepository::class)
 */
class Consommation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut_contrat;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_heure_connexion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_heure_deconnexion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_station_local;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class, inversedBy="utilise")
     */
    private $station;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="charge")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="facture")
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateHeureConnexion(): ?\DateTimeInterface
    {
        return $this->date_heure_connexion;
    }

    public function setDateHeureConnexion(\DateTimeInterface $date_heure_connexion): self
    {
        $this->date_heure_connexion = $date_heure_connexion;

        return $this;
    }

    public function getDateHeureDeconnexion(): ?\DateTimeInterface
    {
        return $this->date_heure_deconnexion;
    }

    public function setDateHeureDeconnexion(\DateTimeInterface $date_heure_deconnexion): self
    {
        $this->date_heure_deconnexion = $date_heure_deconnexion;

        return $this;
    }

    public function getIdStationLocal(): ?string
    {
        return $this->id_station_local;
    }

    public function setIdStationLocal(string $id_station_local): self
    {
        $this->id_station_local = $id_station_local;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
