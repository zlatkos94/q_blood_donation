<?php

namespace App\Entity;

use App\Repository\BloodDonationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodDonationRepository::class)
 */
class BloodDonation
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
    private $location;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=BloodBank::class, inversedBy="bloodDonations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bloodBank;

    /**
     * @ORM\OneToMany(targetEntity=DonorDonation::class, mappedBy="bloodDonation")
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBloodBank(): ?BloodBank
    {
        return $this->bloodBank;
    }

    public function setBloodBank(?BloodBank $bloodBank): self
    {
        $this->bloodBank = $bloodBank;

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
            $donorDonation->setBloodDonation($this);
        }

        return $this;
    }

    public function removeDonorDonation(DonorDonation $donorDonation): self
    {
        if ($this->donorDonations->removeElement($donorDonation)) {
            // set the owning side to null (unless already changed)
            if ($donorDonation->getBloodDonation() === $this) {
                $donorDonation->setBloodDonation(null);
            }
        }

        return $this;
    }
}
