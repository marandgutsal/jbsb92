<?php

namespace SignUpBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class get_location extends Controller {

    public $global_topicId = 0;
    public function isValid($em, $locationParent, $language, $insertedLocation, $containerPosition)
    {
//        $valor1 = 1;
//        $valor1 = $this->get_keywordLocation($em, $locationParent, $language, $insertedLocation, $containerPosition);
        $valor1 = $this->asc($em, $locationParent, $language, $insertedLocation, $containerPosition);
        return $valor1;
    }
    
    public function get_keywordLocation($em, $locationParent, $language, $insertedLocation, $containerPosition)
    {
        $string_query_a = $this->get_query_a($em, $containerPosition, $insertedLocation, $locationParent);
        
        $location = $em->createQuery(
            "SELECT lo.locationId, lo.locationName, lp.locationId locationParent, 
                k.keywordContent 

            FROM HomeBundle:Keywordlocation kl 

            JOIN HomeBundle:Location lo 
            WITH kl.location = lo.locationId 

            JOIN HomeBundle:Keyword k 
            WITH kl.keyword = k.keywordId 

            JOIN HomeBundle:Language la 
            WITH kl.language = la.languageId 

            JOIN HomeBundle:Location lp 
            WITH lp.locationId = lo.locationParent 

            WHERE lo.locationParent = $locationParent and 
            la.languageId = $language 
            "
        );
        
//        and 
//            $string_query_a 
        
//            GROUP BY lo.locationId
        
        $location_v = $location->getResult();

        $amountLocations = count($location_v);

        if ($amountLocations != 0)
        {
            $i = 0;
            while (isset($location_v[$i]['locationId'])) {
                $locationId_Value = $location_v[$i]['locationId'];
                $locationName_Value = $location_v[$i]['locationName'];
                $locationParent_Value = $location_v[$i]['locationParent'];
                $keywordContent_Value = $location_v[$i]['keywordContent'];
                $amountLocations_Value = $amountLocations;
                
                $locationData[$i] = array(
                    'locationId' => $locationId_Value,
                    'locationName' => $locationName_Value,
                    'locationParent' => $locationParent_Value,
                    'keywordContent' => $keywordContent_Value,
                    'amountLocations' => $amountLocations_Value,
                    'process' => "getLocationsChildren"
                );
                $i++;
            }
        } else
        {
            $locationData[0] = array(
                'locationId' => "newLocationChild",
                'locationName' => "newLocationChild",
                'locationParent' => "newLocationChild",
                'keywordContent' => "34567",
                'amountLocations' => 0,
                'process' => "newLocationChild"
            );
        }
        return $locationData;
    }
    
    function get_query_a($em, $containerPosition, $insertedLocation, $locationParent)
    {
        $string_query_a = "";
        for ($h=0; $h<$containerPosition; $h++)
        {
            $keyword_e = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($insertedLocation[$h]);
            if (!$keyword_e)
            {
                $keyword_e = new \HomeBundle\Entity\Keyword();
                $keyword_e->setKeywordContent($insertedLocation[$h]);
                $keyword_e->setKeywordScore(0);
                $em->persist($keyword_e);
                $em->flush();
                $keywordId = $keyword_e->getKeywordId();
            } else
            {
                $keywordId = $keyword_e->getKeywordId();
            }

            if ($h == 0)
            {
                $string_query_a .= "
                    and
                ";
            }
        
            $string_query_a .= "
                k.keywordId = $keywordId
            ";

            if ($h != $containerPosition)
            {
                $string_query_a .= "
                    or
                ";
            }
        }
        
        return $string_query_a;
    }
    
    public function asc($em, $locationParent, $language, $insertedLocation, $containerPosition)
    {
        $string_query_a = $this->get_query_a($em, $containerPosition, $insertedLocation, $locationParent);
        
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $query_keyword = "
            SELECT DISTINCT 
                lo.locationId as locationId, 
                lo.locationName as locationName, 
                lp.locationId as locationParent, 
                k.keywordContent as keywordContent 

                FROM Keywordlocation as kl 

                INNER JOIN Location as lo ON kl.location = lo.locationId 
                INNER JOIN Keyword as k ON kl.keyword = k.keywordId 
                INNER JOIN Language as la ON kl.language = la.languageId 
                INNER JOIN Location as lp ON lp.locationId = lo.locationParent 

                WHERE lo.locationParent = $locationParent and 
                la.languageId = $language 
                $string_query_a 
                    
                GROUP BY lo.locationId 
                ORDER BY lo.locationId DESC 
                LIMIT 0, 300
                
                ";
            
        $stmt2 = $db2->prepare($query_keyword);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();

        foreach($cursos2 as $curso)
        {
            $locationData[] = array(
                'locationId' => $curso["locationId"],
                'locationName' => $curso["locationName"],
                'locationParent' => $curso["locationParent"],
                'keywordContent' => $curso["keywordContent"],
                'amountLocations' => 1,
                'process' => "newLocationChild"
            );
        }
        
        return $locationData;
    }
    
}