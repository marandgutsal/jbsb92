<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Reach_10_aditional extends Controller {

    public $global_topicId = 0;
    
    public function isValid($db2, $location_id)
    {
        $valor1 = $this->getShipmentAditional($db2, $location_id);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function getShipmentAditional($db2, $location_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                saleDetail.saleDetail_id, 
                aditional_store.location_id as store_location, 
                aditional_customer.location_id as customer_location 
                
                FROM saleDetail 
                
                INNER JOIN Sale ON Sale.sale_id = saleDetail.sale_id 
                
                INNER JOIN Branch as Store ON Store.branch_id = saleDetail.store_id 
                
                INNER JOIN Location as aditional_store ON aditional_store.location_id = Store.location_id 
                
                
                INNER JOIN Branch as Customer ON Customer.branch_id = Sale.customer_id 
                
                INNER JOIN Location as aditional_customer ON aditional_customer.location_id = Customer.location_id 
                
                WHERE aditional_store.location_id = aditional_customer.location_id and 
                aditional_customer.location_id = '$location_id' 
        ";


        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;







        foreach($cursos2 as $curso)
        {
            $trajectory[$i] = array(
                'saleDetail_id' => $curso["saleDetail_id"],
                'store_location' => $curso["store_location"],
                'customer_location' => $curso["customer_location"],
                'records_amount' => 4
            );
            $i++;
        }
        
        if ($i==0)
        {
            $trajectory[] = array(
                'saleDetail_id' => "",
                'store_location' => "",
                'custome_location' => "",
                'records_amount' => 0
            );
        }
        
        return $trajectory;
    }
    
}