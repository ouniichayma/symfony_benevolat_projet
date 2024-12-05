<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "association")]
class Association extends Utilisateur
{

    #[ORM\Column(type: 'string', length: 255)]
    private string $secteurActivite;
    #[ORM\Column(type: 'string', length: 255)]
    private string $statutJuridique;

    #[ORM\Column(type: 'string', length: 255)]
    private string $siteWeb ;


    #[ORM\OneToMany(mappedBy: 'association', targetEntity: Projet::class)]
    private Collection $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    // Getters and Setters...

    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setAssociation($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            if ($projet->getAssociation() === $this) {
                $projet->setAssociation(null);
            }
        }

        return $this;
    }





    public function getRoles(): array
    {
        return ['ROLE_ASSOCIATION']; // Vous pouvez ajouter d'autres rôles si nécessaire
    }




    public function getPassword(): string // Implémenter la méthode getPassword() de PasswordAuthenticatedUserInterface
    {
        return $this->motPasse;
    }

    public function setPassword(string $password): self
    {
        $this->motPasse = $password;
        return $this;
    }

    public function getStatutJuridique(): string
    {
        return $this->statutJuridique;
    }

    public function setStatutJuridique(string $statutJuridique): void
    {
        $this->statutJuridique = $statutJuridique;
    }

    public function getSecteurActivite(): string
    {
        return $this->secteurActivite;
    }

    public function setSecteurActivite(string $secteurActivite): void
    {
        $this->secteurActivite = $secteurActivite;
    }

    public function getSiteWeb(): string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(string $siteWeb): void
    {
        $this->siteWeb = $siteWeb;
    }






}
