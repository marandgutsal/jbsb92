<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Reach_1_nodes extends Controller {
    
    public $global_topicId = 0;
    
    public function getShipping_nodes($db2, $price, $departure, $delivery, $departure_size, $delivery_size, $departure_parent, $delivery_parent)
    {
        $query_a = $this->get_where_condition($departure_parent, $delivery_parent, $price);
        
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            trajectory2.trajectory2_id, 
            trajectory2.node_initial, 
            trajectory2.node_1, 
            trajectory2.node_2, 
            trajectory2.node_3, 
            trajectory2.node_4, 
            trajectory2.node_5, 
            trajectory2.node_6, 
            trajectory2.node_7, 
            trajectory2.node_8, 
            trajectory2.node_9, 
            trajectory2.node_10, 
            trajectory2.node_final, 
            shippingUser.shippingUser_id 
            
            FROM trajectory2 
            
            INNER JOIN shipping as shipping_departure ON shipping_departure.shipping_id = trajectory2.node_initial 
            INNER JOIN reach as reach_departure ON reach_departure.reach_id = shipping_departure.reach_id 
            INNER JOIN branch as branch_departure ON branch_departure.branch_id = reach_departure.delivery_id 
            INNER JOIN location as location_departure ON location_departure.location_id = branch_departure.location_id 
            
            INNER JOIN shipping as shipping_delivery ON shipping_delivery.shipping_id = trajectory2.node_final 
            INNER JOIN reach as reach_delivery ON reach_delivery.reach_id = shipping_delivery.reach_id 
            INNER JOIN branch as branch_delivery ON branch_delivery.branch_id = reach_delivery.departure_id 
            INNER JOIN location as location_delivery ON location_delivery.location_id = branch_delivery.location_id 
            
            INNER JOIN maximumLoad as maximumLoad_1 ON maximumLoad_1.maximumLoad_id = shipping_departure.shipping_capacity 
            INNER JOIN price as price_1 ON price_1.price_id = maximumLoad_1.maximumLoad_rate 
            INNER JOIN currency as currency_1 ON currency_1.currency_id = price_1.currency 
            
            INNER JOIN maximumLoad as maximumLoad_10 ON maximumLoad_10.maximumLoad_id = shipping_delivery.shipping_capacity 
            INNER JOIN price as price_10 ON price_10.price_id = maximumLoad_10.maximumLoad_rate 
            INNER JOIN currency as currency_10 ON currency_10.currency_id = price_10.currency 
            
            INNER JOIN shippingUser ON shippingUser.trajectory_id = trajectory2.trajectory2_id 
            INNER JOIN branch ON branch.branch_id = shippingUser.user_id 
            INNER JOIN commercial ON commercial.commercial_id = branch.commercial_id 
            
            INNER JOIN price as price_5392 ON price_5392.price_id = commercial.commercial_funding 
            INNER JOIN currency as currency_5392 ON currency_5392.currency_id = price_5392.currency 
            
            WHERE 
            
            $query_a 
            
            ( 
                ( 
                currency_1.currency_value * price_1.amount >= $price and 
                currency_10.currency_value * price_10.amount >= $price 
                ) or 
                currency_5392.currency_value * price_5392.amount >= $price 
            ) 
            GROUP BY trajectory2.trajectory2_id 
            ORDER BY trajectory2.trajectory2_id ASC 
        ";
        
//            location_departure.location_id = $departure 
//            and 
//            location_delivery.location_id = $delivery 
//            and 
//            reach_departure.departure_id IS NULL and 
//            reach_delivery.delivery_id IS NULL 
        
//            reach_departure.delivery_id = $departure and 
//            reach_delivery.departure_id = $delivery and 
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $trajectory2_id = $curso["trajectory2_id"];
            $node_initial = $curso["node_initial"];
            $node_1 = $curso["node_1"];
            $node_2 = $curso["node_2"];
            $node_3 = $curso["node_3"];
            $node_4 = $curso["node_4"];
            $node_5 = $curso["node_5"];
            $node_6 = $curso["node_6"];
            $node_7 = $curso["node_7"];
            $node_8 = $curso["node_8"];
            $node_9 = $curso["node_9"];
            $node_10 = $curso["node_10"];
            $node_final = $curso["node_final"];
            $shippingUser_id = $curso["shippingUser_id"];
            
            $locationData[$i] = array(
                'trajectory2_id' => $trajectory2_id, 
                'node_initial' => $node_initial, 
                'node_1' => $node_1, 
                'node_2' => $node_2, 
                'node_3' => $node_3, 
                'node_4' => $node_4, 
                'node_5' => $node_5, 
                'node_6' => $node_6, 
                'node_7' => $node_7, 
                'node_8' => $node_8, 
                'node_9' => $node_9, 
                'node_10' => $node_10, 
                'node_final' => $node_final, 
                'departure_size' => $departure_size, 
                'delivery_size' => $delivery_size, 
                'departure_parent' => $departure_parent, 
                'delivery_parent' => $delivery_parent, 
                'shippingUser_id' => $shippingUser_id, 
                'amountRecords' => $amountRecords 
            );

            $i++;
        }

        if ($amountRecords == 0)
        {
            $locationData[] = array(
                'trajectory2_id' => 0, 
                'node_initial' => 0, 
                'node_1' => 0, 
                'node_2' => 0, 
                'node_3' => 0, 
                'node_4' => 0, 
                'node_5' => 0, 
                'node_6' => 0, 
                'node_7' => 0, 
                'node_8' => 0, 
                'node_9' => 0, 
                'node_10' => 0, 
                'node_final' => 0, 
                'departure_size' => $departure_size, 
                'delivery_size' => $delivery_size, 
                'departure_parent' => $departure_parent, 
                'delivery_parent' => $delivery_parent, 
                'shippingUser_id' => 0, 
                'amountRecords' => 0
            );
        }
        
        return $locationData;
    }
    
    public function get_where_condition($departure_parent, $delivery_parent, $price)
    {
        $departure_size = sizeof($departure_parent);
        $delivery_size = sizeof($delivery_parent);
        
        $string_d_1 = "";
        for ($i=0; $i<$departure_size; $i++)
        {
            for ($j=0; $j<$delivery_size; $j++)
            {
                $departure = $departure_parent[$i];
                $delivery = $delivery_parent[$j];
//                $departure = 1;
//                $delivery = 1;
                $string_d_1 .= 
                "
                    location_departure.location_id = $departure 
                    and 
                    location_delivery.location_id = $delivery 
                    and 
                    reach_departure.departure_id IS NULL and 
                    reach_delivery.delivery_id IS NULL 
                ";
                
                if ($j == $delivery_size-1)
                {
                    $string_d_1 .= 
                    "
                        and 
                    ";
                } else {
                    $string_d_1 .= 
                    "
                        or 
                    ";
                }
            }
        }
        return $string_d_1;
    }
    
    public function getParent($db2, $location, $location_position, $location_parent)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            parent.location_id as location_parent 
            
            FROM location 
            
            INNER JOIN location as parent ON parent.location_id = location.location_parent 
            
            WHERE location.location_id = $location 
            
            GROUP BY location.location_id 
            ORDER BY location.location_id ASC 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $bdf = $location_position + 1;
        
        foreach($cursos2 as $curso)
        {
            $location_parent[$bdf] = $curso["location_parent"];
        }
        
        if ($amountRecords == 0)
        {
            $location_parent[$bdf] = 1;
        }
        
        if ($location_parent[0] == 0)
        {
            $location_parent[0] = $location;
        }
        
        if ($location_parent[$bdf] == 1)
        {
            
        } else
        {
            $location_parent = $this->getParent($db2, $location_parent[$bdf], $bdf, $location_parent);
        }
        
        return $location_parent;
    }
}