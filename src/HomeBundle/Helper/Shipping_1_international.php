<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Shipping_1_international extends Controller {

    public $global_topicId = 0;
    
    public function isValid($db2, $location_id)
    {
        $valor1 = $this->getShippingInternational($db2, $location_id);
        
        return $valor1;
    }
    
    public function getShippingInternational($db2, $location_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                shipping.shipping_id, 
                reach.reach_id 
                
                FROM shipping 
                
                INNER JOIN reach ON shipping.reach_id = reach.reach_id 
                
                INNER JOIN location as l_departure ON l_departure.location_id = reach.departure_id 
                
                INNER JOIN Location as aditional_store ON aditional_store.location_id = l_departure.location_id 
                INNER JOIN Location as domiciled_store ON domiciled_store.location_id = aditional_store.location_parent 
                INNER JOIN Location as residential_store ON residential_store.location_id = domiciled_store.location_parent 
                INNER JOIN Location as local_store ON local_store.location_id = residential_store.location_parent 
                INNER JOIN Location as communal_store ON communal_store.location_id = local_store.location_parent 
                INNER JOIN Location as municipal_store ON municipal_store.location_id = communal_store.location_parent 
                INNER JOIN Location as departamental_store ON departamental_store.location_id = municipal_store.location_parent 
                INNER JOIN Location as national_store ON national_store.location_id = departamental_store.location_parent 
                INNER JOIN Location as continental_store ON continental_store.location_id = national_store.location_parent 
                INNER JOIN Location as international_store ON international_store.location_id = continental_store.location_parent 
                
                
                
                INNER JOIN location as l_delivery ON l_delivery.location_id = reach.delivery_id 
                
                INNER JOIN Location as aditional_customer ON aditional_customer.location_id = l_delivery.location_id 
                INNER JOIN Location as domiciled_customer ON domiciled_customer.location_id = aditional_customer.location_parent 
                INNER JOIN Location as residential_customer ON residential_customer.location_id = domiciled_customer.location_parent 
                INNER JOIN Location as local_customer ON local_customer.location_id = residential_customer.location_parent 
                INNER JOIN Location as communal_customer ON communal_customer.location_id = local_customer.location_parent 
                INNER JOIN Location as municipal_customer ON municipal_customer.location_id = communal_customer.location_parent 
                INNER JOIN Location as departamental_customer ON departamental_customer.location_id = municipal_customer.location_parent 
                INNER JOIN Location as national_customer ON national_customer.location_id = departamental_customer.location_parent 
                INNER JOIN Location as continental_customer ON continental_customer.location_id = national_customer.location_parent 
                INNER JOIN Location as international_customer ON international_customer.location_id = continental_customer.location_parent 
                
                WHERE international_store.location_id = international_customer.location_id and 
                international_customer.location_id = '$location_id' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        $i = 0;
        
        foreach($cursos2 as $curso)
        {
            $trajectory[$i] = array(
                'shipping_id' => $curso["shipping_id"],
                'reach_id' => $curso["reach_id"],
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($i==0)
        {
            $trajectory[] = array(
                'shipping_id' => 0,
                'reach_id' => 0,
                'amountRecords' => $amountRecords
            );
        }
        
        return $trajectory;
    }
    
    
    
}