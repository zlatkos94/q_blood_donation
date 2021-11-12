<?php

namespace App\Entity;

use App\Repository\DonorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonorRepository::class)
 */
class Donor
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity=BloodGroup::class, inversedBy="donors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodGroup;

    /**
     * @ORM\OneToMany(targetEntity=DonorDonation::class, mappedBy="donor")
     */
    private $donorDonations;

    public function __construct()
    {
        $this->donorDonations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBloodGroup(): ?BloodGroup
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup(?BloodGroup $bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;

        return $this;
    }

    /**
     * @return Collection|DonorDonation[]
     */
    public function getDonorDonations(): Collection
    {
        return $this->donorDonations;
    }

    public function addDonorDonation(DonorDonation $donorDonation): self
    {
        if (!$this->donorDonations->contains($donorDonation)) {
            $this->donorDonations[] = $donorDonation;
            $donorDonation->setDonor($this);
        }

        return $this;
    }

    public function removeDonorDonation(DonorDonation $donorDonation): self
    {
        if ($this->donorDonations->removeElement($donorDonation)) {
            // set the owning side to null (unless already changed)
            if ($donorDonation->getDonor() === $this) {
                $donorDonation->setDonor(null);
            }
        }

        return $this;
    }

}
