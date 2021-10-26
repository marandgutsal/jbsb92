<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Shipping extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
//        $valor1 = $this->getUserTypeId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function checkShipping($db2, $reach_id, $driver_id, $vehicle_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            shipping.shipping_id 
            
            FROM shipping 
            
            INNER JOIN commercial ON commercial.commercial_id = shipping.driver_id 
            
            INNER JOIN vehicle ON vehicle.vehicle_id = shipping.vehicle_id 
            
            INNER JOIN reach ON reach.reach_id = reach.reach_id 
            
            WHERE commercial.commercial_id = '$driver_id' and 
            vehicle.vehicle_id = '$vehicle_id' and 
            reach.reach_id = '$reach_id' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        foreach($cursos2 as $curso)
        {
            $shipping_id = $curso["shipping_id"];
        }
        
        if ($amountRecords == 0)
        {
            $shipping_id = $this->insertShipping($db2, $reach_id, $driver_id, $vehicle_id);
//            $shipping_id = 31;
        }
        
        return $shipping_id;
    }
    
    function insertShipping($db2, $reach_id, $driver_id, $vehicle_id)
    {
        $query2 = "
            INSERT INTO `shipping`( 
            `driver_id`, 
            `vehicle_id`, 
            `reach_id`) 
            VALUES (
            '$driver_id',
            '$vehicle_id',
            '$reach_id')
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
            $shipping_id = $curso["inserted"];
        }
        
        return $shipping_id;
    }
    
//    $shipping_1 = $this->get('app.shipping');
//    $shipping_id = $shipping_1->isValid($db2, $reach_id, $driver_id, $vehicle_id);
    
}