<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 03.04.14
 * Time: 21:06
 */

namespace Soy\Bundle\SoyBundle\Entity;

use Soy\Bundle\SoyBundle\Entity\Card;

class Search extends Card
{
//    private $request;
//
//    /**
//     * @param mixed $request
//     */
//    public function setRequest($request)
//    {
//        $this->request = $request;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getRequest()
//    {
//        return $this->request;
//    }

    /**
     * @var string
     */
    private $number;

    private $powerCompare;

    private $toughnessCompare;

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $powerCompare
     */
    public function setPowerCompare($powerCompare)
    {
        $this->powerCompare = $powerCompare;
    }

    /**
     * @return mixed
     */
    public function getPowerCompare()
    {
        return $this->powerCompare;
    }

    /**
     * @param mixed $toughnessCompare
     */
    public function setToughnessCompare($toughnessCompare)
    {
        $this->toughnessCompare = $toughnessCompare;
    }

    /**
     * @return mixed
     */
    public function getToughnessCompare()
    {
        return $this->toughnessCompare;
    }



}