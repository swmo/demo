<?php

namespace App\Service;

use App\Entity\Resource;
use App\Entity\Shift;
use App\Repository\ShiftRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlannerManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getManagedShifts($from = null, $to = null){
        $shifts = $this->em->getRepository(Shift::class)->findAll();

        $managedShifts = array();

        foreach($shifts as $shift){

            $managedShifts[] = new ShiftManager($shift,$this->em->getRepository(Shift::class),$this->em);
        }
        return $managedShifts;
    }
   
}


class ShiftManager {


    protected $shift;
    protected $repo;
    protected $em;

    public function __construct(Shift $shift, ShiftRepository $repo, EntityManagerInterface $em)
    {
        $this->shift = $shift;
        $this->repo = $repo;
        $this->em = $em;
    }

    public function getShift(){
        return $this->shift;
    }

    public function getSuccessfullDepenendcies(){
        $array = array();
        foreach($this->getMap() as $nm){
            if($nm['openNumber'] == 0){
                $array[] = ($nm);
            }
        }
        return $array;
    }


    public function getBooked(){
        $array = array();
        foreach($this->getMap() as $nm){
            if($nm['shiftWorks'] > 0 && $nm['openNumber'] >= 0 ){
                $array[] = ($nm);
            }
        }
        return $array;
    }



    public function getOpen(){
        $array = array();
        foreach($this->getMap() as $nm){
            if($nm['openNumber'] > 0){
                $array[] = ($nm);
            }
        }
        return $array;
    }

    /*
    returns an array map:
    */
    protected function getMap(){

        $necessaryMap = array();
        foreach($this->shift->getDependencies() as $dependency){
            $necessaryMap[$dependency->getResourceGroup()->getCode()]['resourceGroup'] = $dependency->getResourceGroup();
            $necessaryMap[$dependency->getResourceGroup()->getCode()]['openNumber'] = $dependency->getNumber();
            $necessaryMap[$dependency->getResourceGroup()->getCode()]['dependency'] = $dependency;
            $necessaryMap[$dependency->getResourceGroup()->getCode()]['shiftWorks'] = array();
            $necessaryMap[$dependency->getResourceGroup()->getCode()]['shift'] = $this->shift;
        }

        foreach($this->shift->getShiftWorks() as $shiftWork){

            if(!isset($necessaryMap[$shiftWork->getResourceGroup()->getCode()])){
                $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['resourceGroup'] = $shiftWork->getResourceGroup();
                $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['openNumber'] = 0;
                $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['dependency'] = null;
                $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['shift'] = $this->shift;
            }

            $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['shiftWorks'][] = $shiftWork;
            $necessaryMap[$shiftWork->getResourceGroup()->getCode()]['openNumber'] = ($necessaryMap[$shiftWork->getResourceGroup()->getCode()]['openNumber']) -1;
        }

        return ($necessaryMap);
    }


    public function isWrongBooked(){
        if(count($this->getWrongBooked()) > 0){
            return true;
        }
        return false;
    }

    public function getWrongBooked(){
        $array = array();
        foreach ($this->getMap() as $nm){
            if($nm['openNumber'] < 0){
                $array[] =  $nm;
            }
        }
        return $array;
    }

    public function searchBookableRessource(){
        $opens = $this->getOpen();

        $array = array();

        $resourceGroups=array();

        foreach($opens as $open){
         //  echo $open['resourceGroup']->getCode() . ' ';

            $resourceGroups[] = $open['resourceGroup'];
        }

        return $this->em->getRepository(Resource::class)->findByResourceGroupAndTimeframe($resourceGroups);

        //findByResourceGroupAndShiftAvaiable
  

       // exit;
       // dd($open);
    }






}