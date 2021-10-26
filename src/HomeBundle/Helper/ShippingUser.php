<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ShippingUser extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
//        $valor1 = $this->getUserTypeId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    
    
//$shippingUser_1 = $this->get('app.shippinguser');
//$shippingUser_id = $shipping_1->checkShippingUser($db2, $shipping_id, $userLogged_commercial_id);

    
//    checkShippingUser($db2, $log_userId, $vehicle_id1)
    public function checkShippingUser($db2, $shipping_id, $userLogged_commercial_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            shippingUser.shippingUser_id 
            
            FROM shippingUser 
            
            INNER JOIN shipping ON shipping.shipping_id = shippingUser.shipping_id 
            
            INNER JOIN commercial ON commercial.commercial_id = shippingUser.user_id 
            
            WHERE shipping.shipping_id = '$shipping_id' and commercial.commercial_id = '$userLogged_commercial_id' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        foreach($cursos2 as $curso)
        {
            $shippingUser_id = $curso["shippingUser_id"];
        }
        
        if ($amountRecords == 0)
        {
            $shippingUser_id = $this->insertShippingUser($db2, $shipping_id, $userLogged_commercial_id);
        }
        
        return $shippingUser_id;
    }
    
    function insertShippingUser($db2, $shipping_id, $userLogged_commercial_id)
    {
        $query2 = "
            INSERT INTO `shippingUser`( 
            `shipping_id`, 
            `user_id`) 
            VALUES (
            '$shipping_id',
            '$userLogged_commercial_id')
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
            $shippingUser_id = $curso["inserted"];
        }
        
        return $shippingUser_id;
    }
    
}