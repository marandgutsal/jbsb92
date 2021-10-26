<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Product extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $db2, 
                        $userId, 
                        $productName, 
                        $productPrice, 
                        $productDescription, 
                        $productImage,
                        $imageType)
    {
        $valor1 = $this->getProductId($em, $db2, 
            $userId, 
            $productName, 
            $productPrice, 
            $productDescription, 
            $productImage,
            $imageType);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function getProductId($em, $db2, 
            $userId, 
            $productName, 
            $productPrice, 
            $productDescription, 
            $productImage,
            $imageType)
    {
//        $usertype = $em->createQuery(
//            "SELECT DISTINCT 
//                ut.usertypeId, ut.usertypeClass 
//                
//            FROM HomeBundle:Usertype ut 
//            
//            WHERE ut.usertypeClass = '$usertypeClass' 
//            "
//        );
//        
//        $usertype_i = $usertype->getResult();
//        
//        $usertypeId = $usertype_i[0]['usertypeId'];
//       
        
        $query2 = "
            INSERT INTO `product`(
            `product_name`, 
            `user_id`, 
            `product_price`, 
            `product_description`, 
            `product_image`, 
            `product_score`) 
            VALUES (
            '$productName',
            '$userId',
            '$productPrice',
            '$productDescription',
            '$productImage',
            '0')
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
            $productId = $curso["inserted"];
        }
        
//        $productId = 1;
        return $productId;
    }
}