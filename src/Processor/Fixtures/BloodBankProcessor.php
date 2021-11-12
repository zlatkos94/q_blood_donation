<?php

namespace App\Processor\Fixtures;

use App\Entity\BloodBank;
use Fidry\AliceDataFixtures\ProcessorInterface;

class BloodBankProcessor implements ProcessorInterface
{
    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof BloodBank) {
            return;
        }
        $stripSpaces = str_replace(' ', '', $object->getName());
       $email = sprintf('%s%s%s',$stripSpaces,'@',$object->getEmail());

        $object->setEmail($email);

    }

    public function postProcess(string $id, $object): void
    {

    }

}
