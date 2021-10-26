<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Vehicle extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
//        $valor1 = $this->getUserTypeId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
//    $userLogged_vehicleOwner_id
    
    public function checkVehicle($db2, $userLogged_vehicleOwner_id, $vehicle_plate, $vehicleType_id1)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            vehicle.vehicle_id 
            
            FROM vehicle 
            
            INNER JOIN commercial as ownerCommercial ON ownerCommercial.commercial_id = vehicle.user_id 
            
            WHERE vehicle.vehicle_plate = '$vehicle_plate' and 
            vehicle.vehicleType_id = '$vehicleType_id1' and 
            ownerCommercial.commercial_id = '$userLogged_vehicleOwner_id' 
        ";
        
//            INNER JOIN user ON user.user_id = vehicle.user_id 
//            
//            INNER JOIN vehicleType ON vehicleType.vehicleType_id = vehicle.vehicleType_id 
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        $i = 0;
        foreach($cursos2 as $curso)
        {
            $vehicle_id = $curso["vehicle_id"];
            $i++;
        }
        
        if ($amountRecords == 0)
        {
//            $vehicle_id = 10;
            $vehicle_id = $this->insertVehicle($db2, $userLogged_vehicleOwner_id, $vehicle_plate, $vehicleType_id1);
        }
        
        return $vehicle_id;
    }
    
    public function insertVehicle($db2, $userLogged_vehicleOwner_id, $vehicle_plate, $vehicleType_id1)
    {
        $query4 = "
            INSERT INTO `vehicle`( 
            `user_id`, 
            `vehicle_plate`, 
            `vehicleType_id`) 
            VALUES (
            '$userLogged_vehicleOwner_id',
            '$vehicle_plate',
            '$vehicleType_id1')
        ";

        $stmt4 = $db2->prepare($query4);
        $params4 = array();
        $stmt4->execute($params4);
        

        $query3 = "
            SELECT LAST_INSERT_ID() as inserted 
        ";

        $stmt3 = $db2->prepare($query3);
        $params3 = array();
        $stmt3->execute($params3);

        $cursos3 = $stmt3->fetchAll();
        foreach($cursos3 as $curso)
        {
            $vehicle_id = $curso["inserted"];
        }
        
        return $vehicle_id;
    }
    
}