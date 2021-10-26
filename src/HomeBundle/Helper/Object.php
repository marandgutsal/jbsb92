<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Object extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $db2, $keywordId_1, $userTypeId, $languageId)
    {
        $valor1 = $this->insertObject($em, $db2, $keywordId_1, $userTypeId, $languageId);
        
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function insertObject($em, $db2, $keywordId, $userTypeId, $languageId)
    {
        
        $object = $em->createQuery(
            "SELECT DISTINCT 
                o.objectId, o.objectScore, k.keywordId, ut.usertypeId 
                
            FROM HomeBundle:Object o 
            
            JOIN HomeBundle:Keyword k 
            WITH o.keyword = k.keywordId 
            
            JOIN HomeBundle:Usertype ut 
            WITH o.usertype = ut.usertypeId 
            
            JOIN HomeBundle:Language l 
            WITH o.language = l.languageId 
            
            WHERE k.keywordId = '$keywordId' and ut.usertypeId = '$userTypeId' and l.languageId = '$languageId' 
            "
        );
        
        $object_i = $object->getResult();
        
        if (isset($object_i[0]['objectId'])) {
            $objectId = $object_i[0]['objectId'];
            $objectScore = $object_i[0]['objectScore'];

            $this->increaseObject($objectId, $objectScore, $db2);
            
            return $objectId;
        } else
        {
            $keywordEntity = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId);
            $usertypeEntity = $em->getRepository('HomeBundle:Usertype')->findOneByUsertypeId($userTypeId);
            $languageEntity = $em->getRepository('HomeBundle:Language')->findOneByLanguageId($languageId);
            
            $objectEntity = new \HomeBundle\Entity\Object();
            $objectEntity->setKeyword($keywordEntity);
            $objectEntity->setObjectScore(0);
            $objectEntity->setUsertype($usertypeEntity);
            $objectEntity->setLanguage($languageEntity);
            $em->persist($objectEntity);
            $em->flush();
            $objectId = $objectEntity->getObjectId();
            return $objectId;
            
        }
    }
    
    function increaseObject($objectId, $objectScore, $db2)
    {
        $objectScore++;
        $query1 = "
            UPDATE `object` 
            SET `object_score` = $objectScore 
            WHERE `object_id` = $objectId
        ";

        $stmt1 = $db2->prepare($query1);
        $params1 = array();
        $stmt1->execute($params1);
    }
    
}