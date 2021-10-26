<?php

namespace DataminingBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DataminigListLocation extends Controller {
    public $global_topicId = 0;
    
    public function getKeywordUser($em, $userId, $keywordsAmount_value)
    {
        $keyword = $em->createQuery(
            "SELECT DISTINCT k.keywordId, k.keywordContent 
            
            FROM HomeBundle:Keyword k 
            
            JOIN HomeBundle:Keyworduser ku 
            WITH ku.keyword = k.keywordId 
            
            JOIN HomeBundle:User u 
            WITH u.userId = ku.user 
            
            WHERE u.userId = '$userId' 
            
            GROUP BY k.keywordId 
            ORDER BY k.keywordScore DESC"
        )
        ->setFirstResult($keywordsAmount_value)
        ->setMaxResults(10);
        $keyword_e = $keyword->getResult();
        
        $amountKeywords = count($keyword_e);
        
        $keywords = 0;
        while (isset($keyword_e[$keywords]['keywordId'])) {
            $results[$keywords] = array(
                'keywordId' => $keyword_e[$keywords]['keywordId'],
                'keywordContent' => $keyword_e[$keywords]['keywordContent'],
                'amountKeywords' => $amountKeywords
            );
            $keywords++;
        }
        
        if ($amountKeywords == 0)
        {
            $results[] = array(
                'keywordId' => 1,
                'keywordContent' => "*",
                'amountKeywords' => $amountKeywords
            );
        }
        return $results;
    }
    
    public function getLocation_byUser($userId, $db2, $em)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            location.location_id 
            
            FROM location 
            
            INNER JOIN user ON user.location_id = location.location_id 
            
            WHERE user.user_id = '$userId'
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $location_id = $curso["location_id"];
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $location_id = 1;
        }
        
        return $location_id;
    }
    
    public function getDatamining_byLocation($em, $keywordsAmount_value, $locationId)
    {
        $keyword = $em->createQuery(
            "SELECT DISTINCT 
                k.keywordId, 
                k.keywordContent 
            
            FROM HomeBundle:Datamininglocation dl 
            
            JOIN HomeBundle:Location lo 
            WITH lo.locationId = dl.location 
            
            JOIN HomeBundle:Keywordlanguage kl 
            WITH kl.keywordlanguageId = dl.keywordlanguage 
            
            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = kl.keyword 
            
            JOIN HomeBundle:Language l 
            WITH l.languageId = kl.language 
            
            WHERE lo.locationId = '$locationId' 
            
            GROUP BY dl.datamininglocationId 
            ORDER BY dl.datamininglocationId DESC"
        )
        ->setFirstResult($keywordsAmount_value)
        ->setMaxResults(10);
        $keyword_e = $keyword->getResult();
        
        $amountKeywords = count($keyword_e);
        
        $keywords = 0;
        while (isset($keyword_e[$keywords]['keywordId'])) {
            $results[$keywords] = array(
                'keywordId' => $keyword_e[$keywords]['keywordId'],
                'keywordContent' => $keyword_e[$keywords]['keywordContent'],
                'amountKeywords' => $amountKeywords
            );
            $keywords++;
        }
        
        if ($amountKeywords == 0)
        {
            $results[] = array(
                'keywordId' => 1,
                'keywordContent' => "",
                'amountKeywords' => $amountKeywords
            );
        }
        
        return $results;
    }
}