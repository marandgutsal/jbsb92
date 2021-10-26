<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Reach_6_communal extends Controller {

    public $global_topicId = 0;
    
    public function isValid($db2, $location_id)
    {
        $valor1 = $this->getShipmentCommunal($db2, $location_id);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function getShipmentCommunal($db2, $location_id)
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
                INNER JOIN Location as domiciled_store ON domiciled_store.location_id = aditional_store.location_parent 
                INNER JOIN Location as residential_store ON residential_store.location_id = domiciled_store.location_parent 
                INNER JOIN Location as local_store ON local_store.location_id = residential_store.location_parent 
                INNER JOIN Location as communal_store ON communal_store.location_id = local_store.location_parent 

                
                INNER JOIN Branch as Customer ON Customer.branch_id = Sale.customer_id 
                
                INNER JOIN Location as aditional_customer ON aditional_customer.location_id = Customer.location_id 
                INNER JOIN Location as domiciled_customer ON domiciled_customer.location_id = aditional_customer.location_parent 
                INNER JOIN Location as residential_customer ON residential_customer.location_id = domiciled_customer.location_parent 
                INNER JOIN Location as local_customer ON local_customer.location_id = residential_customer.location_parent 
                INNER JOIN Location as communal_customer ON communal_customer.location_id = local_customer.location_parent 

                WHERE communal_store.location_id = communal_customer.location_id and 
                communal_customer.location_id = '$location_id' 
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