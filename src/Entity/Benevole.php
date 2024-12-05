<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "benevole")]
class Benevole extends Utilisateur
{

    #[ORM\Column(type: 'string', length: 255)]
    public string $prenom;
    #[ORM\Column(type: 'string', length: 255)]
    public string $dateNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    public string $experience ;
    #[ORM\Column(type: 'string', length: 255)]
    public string $skills ;




    #[ORM\OneToMany(mappedBy: 'benevole', targetEntity: Notification::class)]
    private Collection $notifications;


    #[ORM\OneToMany(mappedBy: 'benevole', targetEntity: Inscription::class)]
    private Collection $inscriptions;



    public function getMissions(): Collection
    {
        return $this->missions;
    }


    public function __construct()
    {

        $this->notifications = new ArrayCollection();

    }



    public function getRoles(): array
    {
        return ['ROLE_BENEVOLE']; // Vous pouvez ajouter d'autres rôles si nécessaire
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




    // Getters and Setters...







    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setBenevole($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            if ($notification->getBenevole() === $this) {
                $notification->setBenevole(null);
            }
        }

        return $this;
    }



    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setBenevole($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            if ($inscription->getBenevole() === $this) {
                $inscription->setBenevole(null);
            }
        }

        return $this;
    }



}
