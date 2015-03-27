<?php
namespace Pe\Model;

use Pe\Entity\Devices;

class DevicesModel
{
    public function  stromFindDevice($dm)
    {
        $data = $dm->getRepository('Pe\Entity\Devices')->findAll();
        foreach ($data as $row) {
                $arr["devices"][] = array(
                "Device_Id" => $row->getDevice_Id(),
                "Device_Loc"=>$row->getDevice_Location()
            );
        }
        $arr=json_encode($arr);
        return $arr;
    }
}