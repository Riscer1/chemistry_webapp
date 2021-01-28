<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity=Atom::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $atom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getAtom(): ?Atom
    {
        return $this->atom;
    }

    public function setAtom(?Atom $atom): self
    {
        $this->atom = $atom;

        return $this;
    }
}
