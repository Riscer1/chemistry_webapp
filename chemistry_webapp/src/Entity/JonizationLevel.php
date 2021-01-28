<?php

namespace App\Entity;

use App\Repository\JonizationLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JonizationLevelRepository::class)
 */
class JonizationLevel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Atom::class, inversedBy="jonizationLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $atom;

    /**
     * @ORM\OneToMany(targetEntity=EnergyLevel::class, mappedBy="jonizationLevel", orphanRemoval=true)
     */
    private $energyLevels;

    /**
     * @ORM\OneToMany(targetEntity=OscillatorStrength::class, mappedBy="jonizationLevel", orphanRemoval=true)
     */
    private $oscillatorStrengths;

    public function __construct()
    {
        $this->energyLevels = new ArrayCollection();
        $this->oscillatorStrengths = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|EnergyLevel[]
     */
    public function getEnergyLevels(): Collection
    {
        return $this->energyLevels;
    }

    public function addEnergyLevel(EnergyLevel $energyLevel): self
    {
        if (!$this->energyLevels->contains($energyLevel)) {
            $this->energyLevels[] = $energyLevel;
            $energyLevel->setJonizationLevel($this);
        }

        return $this;
    }

    public function removeEnergyLevel(EnergyLevel $energyLevel): self
    {
        if ($this->energyLevels->removeElement($energyLevel)) {
            // set the owning side to null (unless already changed)
            if ($energyLevel->getJonizationLevel() === $this) {
                $energyLevel->setJonizationLevel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OscillatorStrength[]
     */
    public function getOscillatorStrengths(): Collection
    {
        return $this->oscillatorStrengths;
    }

    public function addOscillatorStrength(OscillatorStrength $oscillatorStrength): self
    {
        if (!$this->oscillatorStrengths->contains($oscillatorStrength)) {
            $this->oscillatorStrengths[] = $oscillatorStrength;
            $oscillatorStrength->setJonizationLevel($this);
        }

        return $this;
    }

    public function removeOscillatorStrength(OscillatorStrength $oscillatorStrength): self
    {
        if ($this->oscillatorStrengths->removeElement($oscillatorStrength)) {
            // set the owning side to null (unless already changed)
            if ($oscillatorStrength->getJonizationLevel() === $this) {
                $oscillatorStrength->setJonizationLevel(null);
            }
        }

        return $this;
    }
}
