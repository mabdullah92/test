<?php
namespace Pe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Readings.
 * @ORM\Table(name="readings")
 * @ORM\Entity
 */
class Readings
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $Id;

    /** @ORM\Column(type="integer") */
    private $Device_Id;

    /** @ORM\Column(type="float") */
    private $Temperature;

    /** @ORM\Column(type="float") */
    private $Humidity;

    /** @ORM\Column(type="datetime") */
    private $read_DateTime;

    /** @ORM\Column(type="date") */
    private $read_Date;

    /** @ORM\Column(type="time") */
    private $read_Time;

    /**
     *
     * @return the $Id
     *
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     *
     * @param field_type $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     *
     * @return the $Device_Id
     *
     */
    public function getDevice_Id()
    {
        return $this->Device_Id;
    }

    /**
     *
     * @param field_type $Device_Id
     */
    public function setDevice_Id($Device_Id)
    {
        $this->Device_Id = $Device_Id;
    }


    /**
     *
     * @return the $Temperature
     *
     */
    public function getTemperature()
    {
        return $this->Temperature;
    }

    /**
     *
     * @param field_type $Temperature
     */
    public function setTemperature($Temperature)
    {
        $this->Temperature = $Temperature;
    }


    /**
     *
     * @return the $Humidity
     *
     */
    public function getHumidity()
    {
        return $this->Humidity;
    }

    /**
     *
     * @param field_type $Humidity
     */
    public function setHumidity($Humidity)
    {
        $this->Humidity = $Humidity;
    }


    /**
     *
     * @return the $read_DateTime
     *
     */
    public function getread_DateTime()
    {
        return $this->read_DateTime;
    }

    /**
     *
     * @param field_type $read_DateTime
     */
    public function setread_DateTime($read_DateTime)
    {
        $this->read_DateTime = $read_DateTime;
    }


    /**
     *
     * @return the $read_Date
     *
     */
    public function getread_Date()
    {
        return $this->read_Date;
    }

    /**
     *
     * @param field_type $
     */
    public function setread_Date($read_Date)
    {
        $this->read_Date = $read_Date;
    }


    /**
     *
     * @return the $read_Time
     *
     */
    public function getread_Time()
    {
        return $this->read_Time;
    }

    /**
     *
     * @param field_type $
     */
    public function setread_Time($read_Time)
    {
        $this->read_Time = $read_Time;
    }

}