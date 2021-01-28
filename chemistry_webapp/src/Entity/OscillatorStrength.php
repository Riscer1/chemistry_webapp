<?php

namespace App\Entity;

use App\Repository\OscillatorStrengthRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OscillatorStrengthRepository::class)
 */
class OscillatorStrength
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=JonizationLevel::class, inversedBy="oscillatorStrengths")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jonizationLevel;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $transition;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $jJ;

    /**
     * @ORM\Column(type="float")
     */
    private $fik1;

    /**
     * @ORM\Column(type="float")
     */
    private $aki1;

    /**
     * @ORM\Column(type="float")
     */
    private $fik2;

    /**
     * @ORM\Column(type="float")
     */
    private $aki2;

    /**
     * @ORM\Column(type="float")
     */
    private $fik3;

    /**
     * @ORM\Column(type="float")
     */
    private $aki3;

    /**
     * @ORM\Column(type="float")
     */
    private $fik4;

    /**
     * @ORM\Column(type="float")
     */
    private $aki4;

    /**
     * @ORM\Column(type="float")
     */
    private $fik5;

    /**
     * @ORM\Column(type="float")
     */
    private $aki5;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $term;

    /**
     * @ORM\OneToMany(targetEntity=AkiRef::class, mappedBy="oscillatorStrength", orphanRemoval=true)
     */
    private $akiRefs;

    /**
     * @ORM\OneToMany(targetEntity=FikRef::class, mappedBy="oscillatorStrength", orphanRemoval=true)
     */
    private $fikRefs;

    public function __construct()
    {
        $this->akiRefs = new ArrayCollection();
        $this->fikRefs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJonizationLevel(): ?JonizationLevel
    {
        return $this->jonizationLevel;
    }

    public function setJonizationLevel(?JonizationLevel $jonizationLevel): self
    {
        $this->jonizationLevel = $jonizationLevel;

        return $this;
    }

    public function getTransition(): ?string
    {
        return $this->transition;
    }

    public function setTransition(string $transition): self
    {
        $this->transition = $transition;

        return $this;
    }

    public function getJJ(): ?string
    {
        return $this->jJ;
    }

    public function setJJ(string $jJ): self
    {
        $this->jJ = $jJ;

        return $this;
    }

    public function getFik1(): ?float
    {
        return $this->fik1;
    }

    public function setFik1(float $fik1): self
    {
        $this->fik1 = $fik1;

        return $this;
    }

    public function getAki1(): ?float
    {
        return $this->aki1;
    }

    public function setAki1(float $aki1): self
    {
        $this->aki1 = $aki1;

        return $this;
    }

    public function getFik2(): ?float
    {
        return $this->fik2;
    }

    public function setFik2(float $fik2): self
    {
        $this->fik2 = $fik2;

        return $this;
    }

    public function getAki2(): ?float
    {
        return $this->aki2;
    }

    public function setAki2(float $aki2): self
    {
        $this->aki2 = $aki2;

        return $this;
    }

    public function getFik3(): ?float
    {
        return $this->fik3;
    }

    public function setFik3(float $fik3): self
    {
        $this->fik3 = $fik3;

        return $this;
    }

    public function getAki3(): ?float
    {
        return $this->aki3;
    }

    public function setAki3(float $aki3): self
    {
        $this->aki3 = $aki3;

        return $this;
    }

    public function getFik4(): ?float
    {
        return $this->fik4;
    }

    public function setFik4(float $fik4): self
    {
        $this->fik4 = $fik4;

        return $this;
    }

    public function getAki4(): ?float
    {
        return $this->aki4;
    }

    public function setAki4(float $aki4): self
    {
        $this->aki4 = $aki4;

        return $this;
    }

    public function getFik5(): ?float
    {
        return $this->fik5;
    }

    public function setFik5(float $fik5): self
    {
        $this->fik5 = $fik5;

        return $this;
    }

    public function getAki5(): ?float
    {
        return $this->aki5;
    }

    public function setAki5(float $aki5): self
    {
        $this->aki5 = $aki5;

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(string $term): self
    {
        $this->term = $term;

        return $this;
    }

    /**
     * @return Collection|AkiRef[]
     */
    public function getAkiRefs(): Collection
    {
        return $this->akiRefs;
    }

    public function addAkiRef(AkiRef $akiRef): self
    {
        if (!$this->akiRefs->contains($akiRef)) {
            $this->akiRefs[] = $akiRef;
            $akiRef->setOscillatorStrength($this);
        }

        return $this;
    }

    public function removeAkiRef(AkiRef $akiRef): self
    {
        if ($this->akiRefs->removeElement($akiRef)) {
            // set the owning side to null (unless already changed)
            if ($akiRef->getOscillatorStrength() === $this) {
                $akiRef->setOscillatorStrength(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FikRef[]
     */
    public function getFikRefs(): Collection
    {
        return $this->fikRefs;
    }

    public function addFikRef(FikRef $fikRef): self
    {
        if (!$this->fikRefs->contains($fikRef)) {
            $this->fikRefs[] = $fikRef;
            $fikRef->setOscillatorStrength($this);
        }

        return $this;
    }

    public function removeFikRef(FikRef $fikRef): self
    {
        if ($this->fikRefs->removeElement($fikRef)) {
            // set the owning side to null (unless already changed)
            if ($fikRef->getOscillatorStrength() === $this) {
                $fikRef->setOscillatorStrength(null);
            }
        }

        return $this;
    }
}
