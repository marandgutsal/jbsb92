<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Topic extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $db2, $objects, $amountObjects)
    {
        $valor1 = $this->get_topic($em, $db2, $objects, $amountObjects);
        
        return $valor1;
    }
    
    public function get_topic($em, $db2, $objects, $amountObjects)
    {
        if ($amountObjects == 1)
        {
            $query_topic = "
            SELECT DISTINCT 
                    tm.topicmemberId 

                FROM HomeBundle:Topicmember tm 

                JOIN HomeBundle:Object o 
                WITH tm.object = o.objectId 
                
                WHERE o.objectId = '113' 
            ";
        } else {
            $query_a = "";
            $query_b = "";
            $query_c = "";
            
            for ($i = 1; $i <= $amountObjects; $i++)
            {
                $query_a.="tm_$i.topicmemberId";
                if ($i<$amountObjects){$query_a.=", ";}

                $h = $i - 1;
                if ($i > 1)
                {
                    $query_b.="JOIN HomeBundle:Topicmember tm_$i ";
                    $query_b.="WITH tm_$i.topicmemberNext = tm_$h.topicmemberId ";
                    $query_b.="JOIN HomeBundle:Object o_$i ";
                    $query_b.="WITH tm_$i.object = o_$i.objectId ";
                }
                
                $query_c.="o_$i.objectId = '$objects[$h]'";
                if ($i<$amountObjects){$query_c.=" and ";}
            }
            
            $query_topic = "
            SELECT DISTINCT 
                    $query_a
                
                FROM HomeBundle:Topicmember tm_1 
                
                JOIN HomeBundle:Object o_1 
                WITH tm_1.object = o_1.objectId 
                
                $query_b
                
                WHERE $query_c 
            ";
        }
        
        $topic = $em->createQuery($query_topic);
        $topic_e = $topic->getResult();
        
        if (isset($topic_e[0]['topicmemberId'])) {
            $topic_id = $topic_e[0]['topicmemberId'];
        } else
        {
            $topic_id = $this->insert_topic($em, $db2, $objects, $amountObjects);
        }
        
        return $topic_id;
    }
    
    public function insert_topic($em, $db2, $objects, $amountObjects)
    {
        for ($i = $amountObjects-1; $i >= 0; $i--)
        {
            $object_id = $objects[$i];
            if ($i == $amountObjects-1) $next_temp_id = 1;
            
            $next_temp_id = $this->check_topicMember($em, $db2, $object_id, $next_temp_id);
        }
        return $next_temp_id;
    }
    
    public function check_topicMember($em, $db2, $object_id, $next_temp_id)
    {
        if ($next_temp_id == 1)
        {
            $query_n = " tm_n.topicmemberId = tm.topicmemberId ";
        } else 
        {
            $query_n = " tm_n.topicmemberId = '$next_temp_id' ";
        }
        
        $tm_query = $em->createQuery(
            "
            SELECT DISTINCT 
            
            tm.topicmemberId, 
            tm_n.topicmemberId as next_topicmember 
            
            FROM HomeBundle:Topicmember tm 

            JOIN HomeBundle:Topicmember tm_n 
            WITH tm.topicmemberNext = tm_n.topicmemberId 
            
            JOIN HomeBundle:Object o 
            WITH tm.object = o.objectId 
            
            WHERE o.objectId = '$object_id' and 
                $query_n 
            "
        );
        
        $tm_e = $tm_query->getResult();
        
        if (isset($tm_e[0]['topicmemberId']))
        {
            $topicmemberId = $tm_e[0]['topicmemberId'];
        } else
        {
            $topicmemberId = $this->insert_topicMember($em, $db2, $object_id, $next_temp_id);
        }
        return $topicmemberId;
    }
    
    public function insert_topicMember($em, $db2, $object_id, $next_temp_id)
    {
        $query2 = "
            INSERT INTO `topicMember`(
            `object_id`, 
            `topicMember_next`) 
            VALUES (
            '$object_id',
            '$next_temp_id')
        ";


        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        ////////////////////////

        $query3 = "
            SELECT LAST_INSERT_ID() as inserted
        ";

        $stmt3 = $db2->prepare($query3);
        $params3 = array();
        $stmt3->execute($params3);

        $cursos3 = $stmt3->fetchAll();
        foreach($cursos3 as $curso)
        {
            $topicmemberId = $curso["inserted"];
        }
        
        if ($next_temp_id == 1)
        {
            $query_n = " 
                UPDATE `topicMember` 
                SET 
                `topicMember_next`=$topicmemberId 
                
                WHERE  
                
                topicMember.topicMember_id = '$topicmemberId' 
            ";
            
            $stmt_n = $db2->prepare($query_n);
            $params_n = array();
            $stmt_n->execute($params_n);
        }
        return $topicmemberId;
    }
}