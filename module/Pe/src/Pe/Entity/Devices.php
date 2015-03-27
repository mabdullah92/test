<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/26/2015
 * Time: 6:30 PM
 */

namespace Pe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devices.
 * @ORM\Table(name="devices")
 * @ORM\Entity
 */
class Devices
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $Device_Id;

    /** @ORM\Column(type="string") */
    private $Device_Type;

    /** @ORM\Column(type="string") */
    private $Device_Location;

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
     * @return the $Device_Location
     *
     */
    public function getDevice_Location()
    {
        return $this->Device_Location;
    }

    /**
     *
     * @param field_type $Device_Location
     */
    public function setDevice_Location($Device_Location)
    {
        $this->Device_Location = $Device_Location;
    }


    /**
     *
     * @return the $Device_Type
     *
     */
    public function getDevice_Type()
    {
        return $this->Device_Type;
    }

    /**
     *
     * @param field_type $Device_Type
     */
    public function setDevice_Type($Device_Type)
    {
        $this->Device_Type = $Device_Type;
    }

}