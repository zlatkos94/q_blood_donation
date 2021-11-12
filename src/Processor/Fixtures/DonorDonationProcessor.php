<?php

namespace App\Processor\Fixtures;

use App\Entity\DonorDonation;
use Fidry\AliceDataFixtures\ProcessorInterface;


class DonorDonationProcessor implements ProcessorInterface
{
    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof DonorDonation) {
            return;
        }
        $object->setCreatedAt(new \DateTime());
        $amount = (float)$object->getAmount();
        $success = $this->donationSuccess($amount);

        $object->setSuccess($success);

    }

    public function postProcess(string $id, $object): void
    {

    }

    public function donationSuccess(float $amount): bool
    {
        return $amount > 0;
    }
}
