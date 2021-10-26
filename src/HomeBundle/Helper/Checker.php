<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Checker extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $topic, $topicAmount, $productId)
    {
        $valor1 = $this->insertTopicMember($em, $topic, $topicAmount, $productId);
        
//        return $valor;
        return $valor1;
//        return $productId;
    }
    
    public function insertTopicMember($em, $topic, $topicAmount, $productId)
    {
//        $topicMemberAmount = $topic[0][0][0];
        $object_array = array();
        $i = 0;
        while ($i < $topicAmount) {
//            $topic = array();
//            $topic[$i][0] = $topicMember;
//            $topic[$i][1] = $topicMemberAmount;
            $topicMemberAmount = $topic[$i][1][0];
            
            $j = 0;
            while ($j < $topicMemberAmount) {
////            $topicMember[$j][0] = $KEYWORD_NAME;
////            $topicMember[$j][1] = $USERTYPE_NAME;
                $KEYWORD_NAME = $topic[$i][0][$j][0]; // hacer consulta->si no existe insertarlo
                $USERTYPE_NAME = $topic[$i][0][$j][1]; // hacer consulta->si no existe insertarlo
                
                $keyword = $em->getRepository('HomeBundle:Keyword')
                        ->findOneBy(array(
                            'keywordContent' => $KEYWORD_NAME
                        ));
                if(!$keyword)
                {
                    $keyword = new \HomeBundle\Entity\Keyword();
                    $keyword->setKeywordContent($KEYWORD_NAME);
                    $keyword->setKeywordScore(0);
                    $em->persist($keyword);
                    $em->flush();
                }
                $keyword_id = $keyword->getKeywordId();
                
                

                $usertype = $em->getRepository('HomeBundle:Usertype')
                        ->findOneBy(array(
                            'usertypeClass' => $USERTYPE_NAME
                        ));
                if(!$usertype)
                {
                    $usertype = new \HomeBundle\Entity\Usertype();
                    $usertype->setUsertypeClass($USERTYPE_NAME);
                    $em->persist($usertype);
                    $em->flush();
                }
                $usertype_id = $usertype->getUsertypeId();

                
                
                $object = $em->getRepository('HomeBundle:Object')
                        ->findOneBy(array(
                            'keyword' => $keyword_id,
                            'usertype' => $usertype_id
                        ));
                
                if(!$object)
                {
                    $vfdjhvf = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keyword_id);
                    $vfdjhvf_2 = $em->getRepository('HomeBundle:Usertype')->findOneByUsertypeId($usertype_id);
                    
                    $object_123 = new \HomeBundle\Entity\Object();
                    $object_123->setKeyword($vfdjhvf);
                    $object_123->setUsertype($vfdjhvf_2);
                    $object_123->setObjectScore(0);
                    $em->persist($object_123);
                    $em->flush();
                    $object_id = $object_123->getObjectId();
                    $object_array[$i][$j] = $object_id;
                } else
                {
                    $object_id = $object->getObjectId();
                    $object_array[$i][$j] = $object_id;
                }
                $j++;
            }
            $i++;
        }
        
        $fgbc_3 = $this->setTopicmember_3($em, $object_array, $topic, $topicAmount, $productId);
        return $fgbc_3;
        
        
        // topic
        // object -or- topicmember
        // topicMember_id_0 -and- topicMember_id_1
        
        //        return $topic_founded[0][0]['topicMember_id_0'];
    }
    
    public function setTopicmember_3($em, $object_array, $topic, $topicAmount, $productId)
    {
        for ($i = 0; $i < $topicAmount; $i++) { // topic 
            $topic_member_position = 0;
            $array_topic[$i] = 0;
            $amountObjects = count($object_array[$i]);
            
            $topic_founded[$i] = $this->getQuery_1($amountObjects, $object_array, $em, $i);
        }
        
        
        
//        for ($i = 0; $i < $topicAmount; $i++) {
            $this->insertTopicmemberProduct($topic_founded, $productId, $em, $topicAmount);
//        }
        
        
//        $amountItems = $sendData[0]["amountSelectedProducts"];
        
//            'topicMember_id_2' => $curso["topicMember_id_2"],
//            'topicMember_next_2' => $curso["topicMember_next_2"]
        
//        return $sendData[0]['topicMember_id_1'];
//        return $topic_founded[0][0]["topicMember_id_0"];
//        return count($topic_founded);
        
        
//        $sendData[0]["topicMember_id_$i"] = $curso["topicMember_id_$i"];
//        $sendData[0]["topicMember_next_$i"] = $curso["topicMember_next_$i"];
        
//        return $topic_founded[0][0]['topicMember_id_0'];
        return $topic_founded;
    }
    
    public function getQuery_1($amountObjects, $object_array, $em, $topicPosition)
    {
        $end = $amountObjects;
        $end_1 = $amountObjects;
        $j = $amountObjects;
        $k = $amountObjects;
        for ($i=0; $i<$end; $i++)
        {
            $j--;
            $query_a[$i] = "
                Topicmember_$j.topicMember_id as topicMember_id_$j, 
                Topicmember_$j.topicMember_next as topicMember_next_$j ";
        }
        
        for ($i=0; $i<$end; $i++)
        {
            $k--;
            if($i == $end-1)
            {
                $query_c[$i] =  "
                    FROM Topicmember as Topicmember_$k 
                    ";
            } else
            {
                $query_c[$i] =  "
                    FROM 
                    (
                    ";
            }
        }
        
        for ($i=0; $i<$end; $i++)
        {
            if (isset($object_array[$topicPosition][$i]))
            {
                $value = $object_array[$topicPosition][$i];
            } else
            {
                $value = 1;                
            }
            
            
            if ($i == 0)
            {
                $query_d[$i] =  "
                    WHERE Topicmember_$i.object_id = $value 
                    ";
            } else if ($i >= 1)
            {
                $j = $i - 1;
                $query_d[$i] =  "
                    )T$j
                    LEFT JOIN Topicmember as Topicmember_$i ON Topicmember_$i.topicMember_id = topicMember_next_$j 
                    WHERE Topicmember_$i.object_id = $value 
                    GROUP BY Topicmember_$i.topicMember_id 
                    ORDER BY Topicmember_$i.topicMember_id DESC 
                    ";
            }
            
        }
        
        for ($i=0; $i<$end; $i++)
        {
            $end_1--;
            $query_b[$i] = "";
            if ($end_1 >= 1)
            {
                for ($j=0; $j<$end_1; $j++)
                {
                    $query_b[$i] .= "
                        topicMember_id_$j, 
                        topicMember_next_$j, 
                        ";
                }
            }
        }

//                .$query_b[$i] .... after SELECT DISTINTCT
//                .$query_a[$i] .... previous FROM
//                .$query_c[$i] .... from
//                .$query_d[$i] .... left join
        
        
        $query_total = "";
        for ($i=0; $i<$end; $i++)
        {
            $query_total .= "
                SELECT DISTINCT 
                ".$query_b[$i]
                .$query_a[$i]
                .$query_c[$i];
        }
        for ($i=0; $i<$end; $i++)
        {
            $query_total .= $query_d[$i];
        }
        

        $db2 = $em->getConnection();
        $stmt2 = $db2->prepare($query_total);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $uij = 0;
        $amountKeywords = 0;
        
        foreach($cursos2 as $curso)
        {
            for ($i=0; $i<$end; $i++) // topicmember - id 
            {
                if (isset($curso["topicMember_id_$i"])) {
                    $uij++;
                    $sendData[0]["topicMember_id_$i"] = $curso["topicMember_id_$i"];
                    $sendData[0]["topicMember_next_$i"] = $curso["topicMember_next_$i"];
                }
            }
        }
        
        if ($uij == 0)
        {
            $sendData = $this->insertTopic($object_array, $em, $topicPosition, $amountObjects);
        }
        
//        return count($sendData);
//        return count($sendData[0]);
//        return $uij;
//        return $query_total;
        return $sendData;
    }
    
    public function insertTopic($object_array, $em, $topicPosition, $end)
    {
        for ($i=$end-1; $i>=0; $i--) // topicmember - id 
        {
            $a = array();
            $b = array();

            if (isset($object_array[$topicPosition][$i]))
            {
                $object_entidad = $em->getRepository('HomeBundle:Object')->findOneByObjectId($object_array[$topicPosition][$i]);

                if ($i == $end-1)
                {
//                    $topicmember_entidad_1 = $em->getRepository('HomeBundle:Topicmember')
//                            ->findOneBy(array(
//                                'topicmemberId' => 1
//                            ));
                    
                    $topicMember_23 = new \HomeBundle\Entity\Topicmember();
                    $topicMember_23->setObject($object_entidad);
                    $topicMember_23->setTopicmemberNext();
                    $em->persist($topicMember_23);
                    $em->flush();
                    $topicMember_id = $topicMember_23->getTopicmemberId();
                    $topicMember_next = $topicMember_23->getTopicmemberNext();
                    $a[$i] = $topicMember_id;
                    $b[$i] = $topicMember_next;
                } else
                {
                    $topicmember_entidad = $em->getRepository('HomeBundle:Topicmember')
                            ->findOneBy(array(
                                'topicmemberId' => $topicMember_id
                            ));

                    $topicMember_23 = new \HomeBundle\Entity\Topicmember();
                    $topicMember_23->setObject($object_entidad);
                    $topicMember_23->setTopicmemberNext($topicmember_entidad);
                    $em->persist($topicMember_23);
                    $em->flush();
                    $topicMember_id = $topicMember_23->getTopicmemberId();
                    $topicMember_next = $topicMember_23->getTopicmemberNext();
                    $a[$i] = $topicMember_id;
                    $b[$i] = $topicMember_next;
                }
            }
        }

        for ($i=0; $i<$end; $i++) // topicmember - id 
        {
            $sendData[0]["topicMember_id_$i"] = $a[$i];
            $sendData[0]["topicMember_next_$i"] = $b[$i];
        }
        return $sendData;
    }
    
    public function insertTopicmemberProduct($topic_founded, $productId, $em, $topicAmount)
    {
        $product_entity = $em->getRepository('HomeBundle:Product')->findOneByProductId($productId);
        for ($i = 0; $i < $topicAmount; $i++) {
            // [$i]:topic_id; 
            // [0]:allways will be 0 because we get only one result; 
            // ["topicMember_id_0"]: first topicmember who is topicmember = null 
            
//            $sendData[0]["topicMember_id_$i"]
//            topic_founded[$i][0]["topicMember_id_$j"];
                    
                $topicMemberAmount = 1;
                for ($j=0; $j<$topicMemberAmount; $j++)
                {
                    if ($topic_founded[$i][0]["topicMember_id_$j"])
                    {
                        if ($topic_founded[$i][0]["topicMember_next_$j"] == null || 
                            $topic_founded[$i][0]["topicMember_next_$j"] == 0 )
                        {
                            $topicmemberId = $topic_founded[$i][0]["topicMember_id_$j"];

                            $topicmember_entity = 
                            $em->getRepository('HomeBundle:Topicmember')
                            ->findOneByTopicmemberId($topicmemberId);

                            $topicmemberproduct = new \HomeBundle\Entity\Topicmemberproduct();
                            $topicmemberproduct->setProduct($product_entity);
                            $topicmemberproduct->setTopicmember($topicmember_entity);
                            $em->persist($topicmemberproduct);
                            $em->flush();
                            $topicMemberAmount--;
                        } else
                        {
                            $topicMemberAmount++;
                        }
                    } else
                    {
                        $topicMemberAmount--;
                    }
                }
        }
    }
    
}