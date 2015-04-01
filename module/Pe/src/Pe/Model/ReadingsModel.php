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
        $query ="select u from Pe\\Entity\\Readings u where u.Device_Id = ".$data["device"];
        if($param['fdate']!='')
        { $query .= ' and u.read_Date >= \''. date('Y-m-d',strtotime($param['fdate'])).'\'';}
        if($param['tdate']!='')
        { $query .=' and u.read_Date <= \''. date(' Y-m-d',strtotime($param['tdate'])).'\'';}
        $data=$dm->createQuery($query)->setFirstResult($data["offset"])->setMaxResults($data["limit"])->getResult();
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
        if($data==null){
            $arr["data"]=301;
        }
        $arr["tableName"]="Readings";
        $arr["columns"]=array("Shed Name","Date & Time","Temperature","Humidity");
        $arr=json_encode($arr);
        return $arr;
    }



    public function  stromEdit($dm, $data)
    {

    }

    public function  stromDelete($dm, $data)
    {

    }
    public function  stromLiveCharts($dm,$data)
    {
        $param =$data;
        $query ="select u from Pe\\Entity\\Readings u where u.Device_Id = ".$data["device"];
        if($param["live"]=='false'){
            $query .= ' order by u.Id desc';
            $limit=1000;
        }
        if($param["live"]=='true'){
            $query .= ' order by u.Id desc';
            $limit=1;
        }
        $query = " select u from Pe\\Entity\\Readings u where u.Device_Id='2' order by u.Id desc";
        $data=$dm->createQuery($query)->setMaxResults($limit)->getResult();
        foreach ($data as $row) {
            $d=strtotime($row->getread_DateTime()->format('Y/m/d H:i:s')) * 1000;
            $arr["humid"][] = array(
                $d,$row->getHumidity()
            );
            $arr["temp"][] = array(
                $d,$row->getTemperature(),
            );
        }
        $arr=json_encode($arr);
        return $arr;
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