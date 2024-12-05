<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "utilisateur")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "role", type: "string")]
#[ORM\DiscriminatorMap(["ROLE_BENEVOLE" => Benevole::class, "ROLE_ASSOCIATION" => Association::class])]
class Utilisateur implements UserInterface,PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private string $numtel;

    #[ORM\Column(type: 'string', length: 255)]
    private string $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    public string $email;

    #[ORM\Column(type: 'string', length: 255)]
    public string $motPasse;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }





    public function getNumtel(): string
    {
        return $this->numtel;
    }

    public function setNumtel(string $numtel): self
    {
        $this->numtel = $numtel;
        return $this;
    }





    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }






    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getMotPasse(): string
    {
        return $this->motPasse;
    }

    public function setMotPasse(string $motPasse): self
    {
        $this->motPasse = $motPasse;
        return $this;
    }

    public function getRole(): string
    {
        return $this::class; // Retourne le nom de la classe qui correspond au rôle
    }

    public function getRoles(): array
    {
        return [$this->getRole()]; // Retourne un tableau contenant le rôle
    }

    public function getPassword(): string
    {
        return $this->motPasse;
    }

    public function getSalt()
    {

    }


    public function getUserIdentifier(): string
    {
        return $this->email; // Use the email or any unique identifier
    }

    public function eraseCredentials(): void
    {
        // Clear sensitive data if necessary (e.g., plain password), otherwise leave empty
    }

}
