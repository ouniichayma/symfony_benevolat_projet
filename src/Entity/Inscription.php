<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateInscription;

    #[ORM\ManyToOne(targetEntity: Benevole::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private Benevole $benevole;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private Projet $mission;



    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): DateTimeImmutable
    {
        return $this->dateInscription;
    }

    public function setDateInscription(DateTimeImmutable $dateInscription): self
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    public function getBenevole(): Benevole
    {
        return $this->benevole;
    }

    public function setBenevole(Benevole $benevole): self
    {
        $this->benevole = $benevole;
        return $this;
    }

    public function getMission(): Projet
    {
        return $this->mission;
    }

    public function setMission(Projet $mission): self
    {
        $this->mission = $mission;
        return $this;
    }
}
