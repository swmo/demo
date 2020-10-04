<?php

namespace App\DataFixtures;

use App\Entity\Dependency;
use App\Entity\Event;
use App\Entity\OrganisationUnit;
use App\Entity\Project;
use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
use App\Entity\ShiftWork;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Studentenkurs');
        $manager->persist($organisationUnit);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Klinik CH');
        $manager->persist($organisationUnit);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Klinik PA');
        $manager->persist($organisationUnit);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Klinik RG');
        $manager->persist($organisationUnit);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Klinik KO');
        $manager->persist($organisationUnit);

        $organisationUnit = new OrganisationUnit();
        $organisationUnit->setName('Klinik ZE');
        $manager->persist($organisationUnit);





        $resourceGroupDa = new ResourceGroup();
        $resourceGroupDa->setName('Dentalassistentin');
        $resourceGroupDa->setCode('dentalassistant');
        $manager->persist($resourceGroupDa);

        $event = new Event();
        $event->setStarttime(new DateTime('2020-01-01 07:00'));
        $event->setEndtime(new DateTime('2020-01-01 19:00'));
       // $event

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

        $resourceC350left = new Resource();
        $resourceC350left->setName('C350 left Stuhl');
        $resourceC350left->addResourceGroup($resourceGroupB);
        $resourceC350left->addOrganisationUnit($organisationUnit);
        $manager->persist($resourceC350left);

        $resourceC350right = new Resource();
        $resourceC350right->setName('C350 right Stuhl');
        $resourceC350right->addResourceGroup($resourceGroupB);
        $manager->persist($resourceC350right);

        $resourceBehandler01 = new Resource();
        $resourceBehandler01->setName('Behanlder 01');
        $resourceBehandler01->addResourceGroup($resourceGroupD);
        $manager->persist($resourceBehandler01);

        $resourceDentalassistentin01 = new Resource();
        $resourceDentalassistentin01->setName('Dentalassistentin 01');
        $resourceDentalassistentin01->addResourceGroup($resourceGroupDa);
        $manager->persist($resourceDentalassistentin01);


        $resourceDentalassistentin02 = new Resource();
        $resourceDentalassistentin02->setName('Dentalassistentin 02');
        $resourceDentalassistentin02->addResourceGroup($resourceGroupDa);
        $manager->persist($resourceDentalassistentin02);

        $resourceDentalhygiene02 = new Resource();
        $resourceDentalhygiene02->setName('Dentalhygiene 02');
        $resourceDentalhygiene02->addResourceGroup($resourceGroupDh);
        $manager->persist($resourceDentalhygiene02);

        $resourceDentalhygiene01 = new Resource();
        $resourceDentalhygiene01->setName('Dentalhygiene 01');
        $resourceDentalhygiene01->addResourceGroup($resourceGroupDh);
        $manager->persist($resourceDentalhygiene01);

        $shift = new Shift();
        $shift->setStart(new DateTime('2020-01-01 07:00'));
        $shift->setEnd(new DateTime('2020-01-01 12:00'));
        $shift->setName('Schicht 01');
        $manager->persist($shift);

        $shift03 = new Shift();
        $shift03->setStart(new DateTime('2020-01-01 13:00'));
        $shift03->setEnd(new DateTime('2020-01-01 17:00'));
        $shift03->setName('Schicht 02 Nachmittag');
        $manager->persist($shift03);

        $shift2 = new Shift();
        $shift2->setStart(new DateTime('2020-01-01 08:00'));
        $shift2->setEnd(new DateTime('2020-01-01 12:00'));
        $shift2->setName('Schicht 02');
        $manager->persist($shift2);

        $project01 = new Project();
        $project01
            ->setName('Testprojekt 01')
            ->addOrganisationUnit($organisationUnit)
            ->addShift($shift)
            ->addShift($shift03)
            ->addProjectResource($resourceC350right)
            ->addProjectResource($resourceC350left);
        $manager->persist($project01);


        $project02 = new Project();
        $project02
            ->setName('Testprojekt 02')
            ->addOrganisationUnit($organisationUnit)
            ->addShift($shift2);
        $manager->persist($project02);

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

        $dependency = new Dependency();
        $dependency->setNumber(3)
        ->setResourceGroup($resourceGroupDh)
        ->setShift($shift);
        $manager->persist($dependency);


        $dependency = new Dependency();
        $dependency->setNumber(1)
        ->setResourceGroup($resourceGroupB)
        ->setShift($shift);
        $manager->persist($dependency);


        $dependency = new Dependency();
        $dependency->setNumber(1)
        ->setResourceGroup($resourceGroupB)
        ->setShift($shift2);
        $manager->persist($dependency);


        $dependency = new Dependency();
        $dependency->setNumber(1)
        ->setResourceGroup($resourceGroupB)
        ->setShift($shift03);
        $manager->persist($dependency);

        $shiftWork = new ShiftWork();
        $shiftWork->setShift($shift);
        $shiftWork->setResource($resourceDentalhygiene01);
        $shiftWork->setResourceGroup($resourceDentalhygiene01->getResourceGroups()[0]);
        $manager->persist($shiftWork);

        /*
        $shiftWork = new ShiftWork();
        $shiftWork->setShift($shift);
        $shiftWork->setResource($resourceDentalhygiene02);
        $shiftWork->setResourceGroup($resourceDentalhygiene02->getResourceGroups()[0]);
        $manager->persist($shiftWork);
        */
        
        $shiftWork = new ShiftWork();
        $shiftWork->setShift($shift);
        $shiftWork->setResource($resourceC350right);
        $shiftWork->setResourceGroup($resourceC350right->getResourceGroups()[0]);
        $manager->persist($shiftWork);


        
        $shiftWork = new ShiftWork();
        $shiftWork->setShift($shift03);
        $shiftWork->setResource($resourceC350right);
        $shiftWork->setResourceGroup($resourceC350right->getResourceGroups()[0]);
        $manager->persist($shiftWork);
        /*
        $shiftWork = new ShiftWork();
        $shiftWork->setShift($shift);
        $shiftWork->setResource($resourceBehandler01);
        $shiftWork->setResourceGroup($resourceBehandler01->getResourceGroups()[0]);
        $manager->persist($shiftWork);
        */

        $manager->flush();
    }
}
