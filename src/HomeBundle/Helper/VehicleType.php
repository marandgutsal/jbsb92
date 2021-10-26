<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VehicleType extends Controller {

    public $global_topicId = 0;
    
//    public function isValid($em, $usertypeClass)
//    {
//        return $valor1;
//    }
    
    public function checkVehicleType($db2, $keywordId_1)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            vehicleType.vehicleType_id 
            
            FROM vehicleType 
            
            INNER JOIN keywordVehicleType ON keywordVehicleType.vehicleType_id = vehicleType.vehicleType_id 
            
            INNER JOIN keyword ON keyword.keyword_id = keywordVehicleType.keyword_id 
            
            WHERE keyword.keyword_id = '$keywordId_1' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        $i = 0;
        foreach($cursos2 as $curso)
        {
            $vehicleType_id = $curso["vehicleType_id"];
            
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $vehicleType_id = $this->insertVehicleType($db2);
            
            $this->insertVehicleTypeKeyword($db2, $vehicleType_id, $keywordId_1);
        }
        
        return $vehicleType_id;
    }
    
    public function insertVehicleType($db2)
    {
        $query2 = "
            INSERT INTO `vehicleType`( 
            `vehicleType_name`) 
            VALUES (
            '')
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
            $vehicleType_id = $curso["inserted"];
        }
        
        return $vehicleType_id;
    }
    
    public function insertVehicleTypeKeyword($db2, $vehicleType_id, $keywordId_1)
    {
        $query4 = "
            INSERT INTO `keywordVehicleType`( 
            `keyword_id`, 
            `vehicleType_id`, 
            `language_id`) 
            VALUES (
            '$keywordId_1',
            '$vehicleType_id',
            '1')
        ";

        $stmt4 = $db2->prepare($query4);
        $params4 = array();
        $stmt4->execute($params4);
    }
    
}