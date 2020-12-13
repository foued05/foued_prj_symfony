<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $carburant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

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

    public function getDatemiseencirculation(): ?\DateTimeInterface
    {
        return $this->datemiseencirculation;
    }

    public function setDatemiseencirculation(\DateTimeInterface $datemiseencirculation): self
    {
        $this->datemiseencirculation = $datemiseencirculation;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
    public function getNbrplaces(): ?int
    {
        return $this->nbrplaces;
    }

    public function setNbrplaces(int $nbrplaces): self
    {
        $this->nbrplaces = $nbrplaces;

        return $this;
    }

    /**
     * @Route("/createVoiture", name="create_voiture")
     */
    public function createVoiture(): Response
    {
        $entityMnager=$this->getDoctrine()->getManager();

        $voiture=new Voiture();
        $voiture->setMatricule('200TU1500');
        $voiture->setMarque('BMW');
        $voiture->setDescription('voiture luxe');
        $voiture->setCouleur('noir');
        $voiture->setCarburant('gazoil');
        $date= new \DateTime('2019-06-05 12:15:30');
        $voiture->setDatemiseencirculation($date);
        $voiture->setDisponibilite(1);
        $voiture->setNbrplace(5);

        $entityMnager->presist($voiture);

        $entityMnager->flush();

        return new Response('nouvelle voiture ajoute avec la matricule numere '.$voiture->getMatricule());
    }
}
