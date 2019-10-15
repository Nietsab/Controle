<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 *  @ORM\HasLifecycleCallbacks
 * 
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $libelle;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     *@Assert\Range(min=0, max=50, minMessage="Le libelle  ne peut pas être inférieur à 5.", maxMessage="Le libellé ne peut pas être supérieur à 50.")
     */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Range(min=0, max=50, minMessage="Le prix ne peut pas être inférieur à 0.", maxMessage="Le prix ne peut pas être supérieur à 500.")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *@Assert\Range(min=0, max=50, minMessage="La description ne peut pas être inférieur à 10.", maxMessage="La description ne peut pas être supérieur à 200 .")
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function removeArticle(Article $Article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);

        }

        return $this;
    }

}
