<?php

namespace App\DataFixtures;

use App\Entity\Dependency;
use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        $resourceGroupDa = new ResourceGroup();
        $resourceGroupDa->setName('Dentalassistentin');
        $resourceGroupDa->setCode('dentalassistant');
        $manager->persist($resourceGroupDa);

        $resourceGroupDh = new ResourceGroup();
        $resourceGroupDh->setName('Dentalhygienikerin');
        $resourceGroupDh->setCode('dentalhygienist');
        $manager->persist($resourceGroupDh);

        $resourceGroupD = new ResourceGroup();
        $resourceGroupD->setName('Zahnarzt');
        $resourceGroupD->setCode('dentist');
        $manager->persist($resourceGroupD);

        $resourceGroupB = new ResourceGroup();
        $resourceGroupB->setName('Behandlungsstuhl');
        $resourceGroupB->setCode('treatmentchair');
        $manager->persist($resourceGroupB);

        $resource = new Resource();
        $resource->setName('C350 left Stuhl');
        $resource->addResourceGroup($resourceGroupB);
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setName('C350 right Stuhl');
        $resource->addResourceGroup($resourceGroupB);
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setName('Behanlder 01');
        $resource->addResourceGroup($resourceGroupD);
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setName('Dentalassistentin 01');
        $resource->addResourceGroup($resourceGroupDa);
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setName('Dentalhygiene 01');
        $resource->addResourceGroup($resourceGroupDh);
        $manager->persist($resource);



        $shift = new Shift();
        $shift->setStart(new DateTime('2020-01-01 08:00'));
        $shift->setEnd(new DateTime('2020-01-01 12:00'));
        $shift->setName('Schicht 02');
        $manager->persist($shift);

        $dependency = new Dependency();
        $dependency->setNumber(2)
        ->setResourceGroup($resourceGroupDa)
        ->setShift($shift);
        $manager->persist($dependency);

        $dependency = new Dependency();
        $dependency->setNumber(1)
        ->setResourceGroup($resourceGroupD)
        ->setShift($shift);
        $manager->persist($dependency);


        $manager->flush();
    }
}
