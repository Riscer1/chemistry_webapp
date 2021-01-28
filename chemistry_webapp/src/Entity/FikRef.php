<?php

namespace App\Entity;

use App\Repository\FikRefRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FikRefRepository::class)
 */
class FikRef
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
    private $ref;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=OscillatorStrength::class, inversedBy="fikRefs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $oscillatorStrength;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getOscillatorStrength(): ?OscillatorStrength
    {
        return $this->oscillatorStrength;
    }

    public function setOscillatorStrength(?OscillatorStrength $oscillatorStrength): self
    {
        $this->oscillatorStrength = $oscillatorStrength;

        return $this;
    }
}
