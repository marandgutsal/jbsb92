<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReachMessenger extends Controller {

    public $global_topicId = 0;
    
    public function isValid($db2, $reach_id, $userId)
    {
        $valor1 = $this->get_reachMessenger($db2, $reach_id, $userId);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function get_reachMessenger($db2, $reach_id, $userId)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            reachMessenger.reachMessenger_id 
            
            FROM reachMessenger 
            
            INNER JOIN reach ON reachMessenger.reach_id = reach.reach_id 
            INNER JOIN branch as messenger ON reachMessenger.messenger_id = messenger.branch_id 
            INNER JOIN commercial ON commercial.commercial_id = messenger.commercial_id 
            INNER JOIN user ON user.user_id = commercial.user_id 
            
            WHERE reach.reach_id = '$reach_id' and user.user_id = '$userId' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $reachMessenger_id = $curso["reachMessenger_id"];
        }
        
        if ($amountRecords == 0)
        {
            $query2 = "
                INSERT INTO `reachMessenger`(
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
        return $reachMessenger_id;
    }
    
    public function get_reachMessenger_list($db2, $userId)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            reach.reach_id, 
            Departure.location_id as origin_id, 
            Delivery.location_id as destiny_id, 
            Departure.location_name as origin_name, 
            Delivery.location_name as destiny_name, 
            k_departure.keyword_content as origin_territoriality, 
            k_delivery.keyword_content as destiny_territoriality 

            FROM reach 

            INNER JOIN reachMessenger ON reachMessenger.reach_id = reach.reach_id 

            INNER JOIN Branch ON Branch.branch_id = reachMessenger.messenger_id 
            INNER JOIN Commercial ON Commercial.commercial_id = Branch.commercial_id 
            INNER JOIN User ON Commercial.user_id = User.user_id 

            INNER JOIN Location as Departure ON Departure.location_id = reach.departure_id 
            INNER JOIN Territoriality as t_departure ON t_departure.territoriality_id = Departure.territoriality 
            INNER JOIN keywordTerritoriality as kt_departure ON kt_departure.territoriality_id = t_departure.territoriality_id 
            INNER JOIN keyword as k_departure ON k_departure.keyword_id = kt_departure.keyword_id 

            INNER JOIN Location as Delivery ON Delivery.location_id = reach.delivery_id 
            INNER JOIN Territoriality as t_delivery ON t_delivery.territoriality_id = Delivery.territoriality 
            INNER JOIN keywordTerritoriality as kt_delivery ON kt_delivery.territoriality_id = t_delivery.territoriality_id 
            INNER JOIN keyword as k_delivery ON k_delivery.keyword_id = kt_delivery.keyword_id 

            WHERE User.user_id = '$userId' 
            GROUP BY reach.reach_id 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        $i = 0;

        foreach($cursos2 as $curso)
        {
            $sendata[$i] = array(
                'reach_id' => $curso["reach_id"],
                'origin_id' => $curso["origin_id"],
                'destiny_id' => $curso["destiny_id"],
                'origin_name' => $curso["origin_name"],
                'destiny_name' => $curso["destiny_name"],
                'origin_territoriality' => $curso["origin_territoriality"],
                'destiny_territoriality' => $curso["destiny_territoriality"],
                'amountRecords' => $amountRecords
            );
            $i++;
        }

        if ($i == 0)
        {
            $sendata[0] = array(
                'reach_id' => 0,
                'origin_id' => 0,
                'destiny_id' => 0,
                'origin_name' => 0,
                'destiny_name' => 0,
                'origin_territoriality' => 0,
                'destiny_territoriality' => 0,
                'amountRecords' => 0
            );
        }
        return $sendata;
    }
}