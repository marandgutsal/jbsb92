<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VehicleUser extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
//        $valor1 = $this->getUserTypeId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    
    
    public function checkVehicleUser($db2, $log_userId, $vehicle_id1)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            vehicleUser.vehicleUser_id 
            
            FROM vehicleUser 
            
            INNER JOIN vehicle ON vehicle.vehicle_id = vehicleUser.vehicle_id 
            
            INNER JOIN user ON user.user_id = vehicleUser.user_id 
            
            INNER JOIN commercial ON commercial.user_id = vehicleUser.user_id 

            WHERE vehicleUser.vehicle_id = '$vehicle_id1' and 
            commercial.user_id = '$log_userId' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        foreach($cursos2 as $curso)
        {
            $vehicleUser_id = $curso["vehicleUser_id"];
        }
        
        if ($amountRecords == 0)
        {
            $vehicleUser_id = $this->insertVehicleUser($db2, $log_userId, $vehicle_id1);
        }
        
        return $vehicleUser_id;
    }
    
    function insertVehicleUser($db2, $log_userId, $vehicle_id1)
    {
        $query2 = "
            INSERT INTO `vehicleUser`( 
            `vehicle_id`, 
            `user_id`) 
            VALUES (
            '$vehicle_id1',
            '$log_userId')
        ";

        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $query3 = "
            SELECT LAST_INSERT_ID() as inserted 
        ";

        $stmt3 = $db2->prepare($query3);
        $params3 = array();
        $stmt3->execute($params3);

        $cursos3 = $stmt3->fetchAll();
        foreach($cursos3 as $curso)
        {
            $vehicleUser_id = $curso["inserted"];
        }
        
        return $vehicleUser_id;
    }
    
}