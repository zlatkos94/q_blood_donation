<?php

namespace App\Processor\Fixtures;

use App\Entity\BloodDonation;
use App\Entity\DonorDonation;
use Doctrine\ORM\EntityManagerInterface;
use Fidry\AliceDataFixtures\ProcessorInterface;

class BloodDonationProcessor implements ProcessorInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function preProcess(string $id, $object): void
    {

    }

    public function postProcess(string $id, $object): void
    {
        if (!$object instanceof BloodDonation) {
            return;
        }

        $id = $object->getId();
        $date = $object->getDate();

        /** @var DonorDonation $donorDonation */
      $donorDonations =  $this->entityManager->getRepository(DonorDonation::class)->findBy(['bloodDonation' => $id]);

      foreach ($donorDonations as $donorDonation)
      {
          $donorDonation->setCreatedAt($date);

          $this->entityManager->persist($donorDonation);

      }

        $this->entityManager->flush();

    }
}