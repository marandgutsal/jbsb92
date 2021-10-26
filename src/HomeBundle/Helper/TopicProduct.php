<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TopicProduct extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $db2, $topicId_1, $product_id)
    {
        $valor1 = $this->set_topicProduct($em, $db2, $topicId_1, $product_id);
        
        return $valor1;
    }
    
    public function set_topicProduct($em, $db2, $topicId_1, $product_id)
    {
        $tmp_query = $em->createQuery(
            "
            SELECT DISTINCT 
            
            tmp.topicmemberproductId, 
            tm.topicmemberId, 
            p.productId 
            
            
            
            FROM HomeBundle:Topicmemberproduct tmp 
            
            JOIN HomeBundle:Product p 
            WITH p.productId = tmp.product 
            
            JOIN HomeBundle:Topicmember tm 
            WITH tm.topicmemberId = tmp.topicmember 
            
            
            
            WHERE p.productId = '$product_id' and 
                tm.topicmemberId = '$topicId_1' 
            "
        );
        
        
        
        
        
        $tmp_e = $tmp_query->getResult();
        
        if (isset($tmp_e[0]['topicmemberproductId']))
        {
            $topicmemberproductId = $tmp_e[0]['topicmemberproductId'];
        } else {
            
            $query2 = "
                INSERT INTO `topicMemberProduct`( 
                `topicMember_id`, 
                `product_id`) 
                VALUES ( 
                '$topicId_1', 
                '$product_id') 
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
                $topicmemberproductId = $curso["inserted"];
            }
        }
        
        return $topicmemberproductId;
    }
}