<?php

namespace App\Entity;

use App\Repository\EnergyLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnergyLevelRepository::class)
 */
class EnergyLevel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $configuration;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $term;

    /**
     * @ORM\Column(type="integer")
     */
    private $j;

    /**
     * @ORM\Column(type="float")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity=JonizationLevel::class, inversedBy="energyLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jonizationLevel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConfiguration(): ?string
    {
        return $this->configuration;
    }

    public function setConfiguration(string $configuration): self
    {
        $this->configuration = $configuration;

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

    public function getJ(): ?int
    {
        return $this->j;
    }

    public function setJ(int $j): self
    {
        $this->j = $j;

        return $this;
    }

    public function getLevel(): ?float
    {
        return $this->level;
    }

    public function setLevel(float $level): self
    {
        $this->level = $level;

        return $this;
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
}
