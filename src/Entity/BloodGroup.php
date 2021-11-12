<?php

namespace App\Entity;

use App\Repository\BloodGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodGroupRepository::class)
 */
class BloodGroup
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
     * @ORM\OneToMany(targetEntity=Donor::class, mappedBy="bloodGroup")
     */
    private $donors;

    public function __construct()
    {
        $this->donors = new ArrayCollection();
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

    /**
     * @return Collection|Donor[]
     */
    public function getDonors(): Collection
    {
        return $this->donors;
    }

    public function addDonor(Donor $donor): self
    {
        if (!$this->donors->contains($donor)) {
            $this->donors[] = $donor;
            $donor->setBloodGroup($this);
        }

        return $this;
    }

    public function removeDonor(Donor $donor): self
    {
        if ($this->donors->removeElement($donor)) {
            // set the owning side to null (unless already changed)
            if ($donor->getBloodGroup() === $this) {
                $donor->setBloodGroup(null);
            }
        }

        return $this;
    }
}
