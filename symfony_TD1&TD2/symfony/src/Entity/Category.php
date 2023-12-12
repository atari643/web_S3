<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id] 
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Message::class, inversedBy: 'categories')]
    private Collection $linkMessage;

    public function __construct()
    {
        $this->linkMessage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getLinkMessage(): Collection
    {
        return $this->linkMessage;
    }

    public function addLinkMessage(Message $linkMessage): static
    {
        if (!$this->linkMessage->contains($linkMessage)) {
            $this->linkMessage->add($linkMessage);
        }

        return $this;
    }

    public function removeLinkMessage(Message $linkMessage): static
    {
        $this->linkMessage->removeElement($linkMessage);

        return $this;
    }
}
