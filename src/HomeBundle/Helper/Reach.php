<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Reach extends Controller {

    public $global_topicId = 0;
    
//    $reach_1 = $this->get('app.reach');
//    $reach_id = $reach_1->isValid($db2, $origin, $destiny);
    
    public function isValid($db2, $origin, $destiny)
    {
        $valor1 = $this->get_reach($db2, $origin, $destiny);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function get_reach($db2, $origin, $destiny)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            reach.reach_id 
            
            FROM reach 
            
            INNER JOIN location as departure ON departure.location_id = reach.departure_id 
            INNER JOIN location as delivery ON delivery.location_id = reach.delivery_id 
            
            WHERE departure.location_id = '$origin' and delivery.location_id = '$destiny' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $reach_id = $curso["reach_id"];
        }
        
        if ($amountRecords == 0)
        {
            $query2 = "
                INSERT INTO `reach`(
                `departure_id`, 
                `delivery_id`) 
                VALUES (
                '$origin',
                '$destiny')
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
                $reach_id = $curso["inserted"];
            }
        }
        return $reach_id;
    }
}