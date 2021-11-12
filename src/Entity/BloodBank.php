<?php

namespace App\Entity;

use App\Repository\BloodBankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodBankRepository::class)
 */
class BloodBank
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=BloodDonation::class, mappedBy="bloodBank")
     */
    private $bloodDonations;

    public function __construct()
    {
        $this->bloodDonations = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|BloodDonation[]
     */
    public function getBloodDonations(): Collection
    {
        return $this->bloodDonations;
    }

    public function addBloodDonation(BloodDonation $bloodDonation): self
    {
        if (!$this->bloodDonations->contains($bloodDonation)) {
            $this->bloodDonations[] = $bloodDonation;
            $bloodDonation->setBloodBank($this);
        }

        return $this;
    }

    public function removeBloodDonation(BloodDonation $bloodDonation): self
    {
        if ($this->bloodDonations->removeElement($bloodDonation)) {
            // set the owning side to null (unless already changed)
            if ($bloodDonation->getBloodBank() === $this) {
                $bloodDonation->setBloodBank(null);
            }
        }

        return $this;
    }
}
