<?php

namespace Pe\Model;

use Pe\Entity\Readings;

class ReadingsModel
{
    public  function __construct (){
    }

    public function  stromSelectAll($dm,$data)
    {

        $param=$data;
        echo $param["fdate"]." - ".$param["tdate"];
        $query="select u from Pe\\Entity\\Readings u where u.read_Date >=";

        if($param['fdate']!=null)
        { $query .= '\''. date('Y-m-d',strtotime($param['fdate'])).'\'';}
        $query.=" and u.read_Date <= ";
        if($param['tdate']!=null)
        { $query .='\''. date(' Y-m-d',strtotime($param['tdate'])).'\'';}
        $data=$dm->createQuery($query)->getResult();
   //     $data=$data->getResult();

//        $to='12-12-2010';
//        $from='12-12-2019';
//        $data = $dm->getRepository('Pe\Entity\Readings')->createQueryBuilder('c')->findBy('Id=186')
//            ->getQuery()
//            ->execute();
        foreach ($data as $row) {
           $d=$row->getread_DateTime()->format('Y/m/d H:i:s');
            $arr["data"][] = array(
                "Id" => $row->getId(),
                "Device_Id" => $row->getDevice_Id(),
                "Temperature" => $row->getTemperature(),
                "Humidity" => $row->getHumidity(),
                "read_DateTime" =>  $d,
                "read_Date" => $row->getread_Date(),
                "read_Time" => $row->getread_Time()
            );
        }
        $arr["tableName"]="Readings";
        $arr["columns"]=array("Shed Name","Date & Time","Temperature","Humidity");
        $arr=json_encode($arr);
       return $arr;
    }

    public function  stromFind($dm, $data)
    {
        $param = $data;
        $data = $dm->getRepository('Pe\Entity\Readings')->findBy(array("id" => $param));
        foreach ($data as $row) {
            $arr["data"][] = array(
                "Id" => $row->getId(),
                "Device_Id" => $row->getDevice_Id(),
                "Temperature" => $row->getTemperature(),
                "Humidity" => $row->getHumidity(),
                "read_DateTime" => $row->getread_DateTime(),
                "read_Date" => $row->getread_Date(),
                "read_Time" => $row->getread_Time()
            );
        }
        $arr["tableName"]="Readings";
        $arr["columns"]=array("Shed Name","Date & Time","Temperature","Humidity");
        return $arr;
    }

    public function  stromEdit($dm, $data)
    {

    }

    public function  stromDelete($dm, $data)
    {

    }

    public function  stromCreate($dm,$data)
    {
        date_default_timezone_set('Asia/Karachi');
        $insert = new Readings();
        $date=date("Y-m-d");
        $time=date("H:i:s");
        $dt=date("Y-m-d H:i:s");
        $readings = new Readings();
        $readings ->setDevice_Id($data["Device_Id"]);
        $readings ->setTemperature($data["Temperature"]);
        $readings ->setHumidity($data["Humidity"]);
        $readings ->setread_Date(new \DateTime($date));
        $readings ->setread_Time(new \DateTime($time));
        $readings ->setread_DateTime(new \DateTime($dt));
        $dm->persist($readings);
        $dm->flush();
        return true;
    }
}