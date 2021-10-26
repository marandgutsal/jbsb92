<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Keyworduser extends Controller {

    public $global_topicId = 0;
            
    public function isValid($em, $keywordId_1, $userId, $useripId)
    {
        $valor1 = $this->set_keywordUser($em, $keywordId_1, $userId, $useripId);
        
        return $valor1;
    }
    
    public function set_keywordUser($em, $keywordId_1, $userId, $useripId)
    {

        if ($userId === 0)
        {
            $existentedKeywordUser = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                FROM HomeBundle:Keyword k 

                JOIN HomeBundle:Keyworduser ku 
                WITH k.keywordId = ku.keyword

                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 

                JOIN HomeBundle:Userip up 
                WITH up.useripId = ku.userip 

                WHERE k.keywordId = '$keywordId_1' and (u.userId = '0' and up.useripId = '$useripId')"
            );
        } else
        {
            $existentedKeywordUser = $em->createQuery(
                "SELECT k.keywordId, k.keywordContent, ku.keyworduserId, ku.keyworduserScore 
                FROM HomeBundle:Keyword k 

                JOIN HomeBundle:Keyworduser ku 
                WITH k.keywordId = ku.keyword

                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 

                JOIN HomeBundle:Userip up 
                WITH up.useripId = ku.userip 

                WHERE k.keywordId = '$keywordId_1' and (u.userId = '$userId' and up.useripId = '0')"
            );
        }

        $existentedKeywordUser_v = $existentedKeywordUser->getResult();
        // validar la existencia del keyworduser ingresado en la Base de Datos
        if (isset($existentedKeywordUser_v[0]['keywordId'])) { // si SI existe el keywordUser en la base de datos, incrementar_keywordUser_score()
            $keyworduserId = $existentedKeywordUser_v[0]['keyworduserId'];
            $keyworduserScore = $existentedKeywordUser_v[0]['keyworduserScore'];
            $this->incrementar_keywordUser_score($em, $keyworduserId, $keyworduserScore);
        } else { // si NO existe el keywordUser en la base de datos, insertar_keywordUser()
            $keyworduserId = $this->insertar_keywordUser($em, $keywordId_1, $userId, $useripId);
        }
        return $keyworduserId;
    }
    
    public function incrementar_keywordUser_score($em, $keyworduserId, $keyworduserScore)
    {
        $new_keyworduserScore = $keyworduserScore + 1;
        $keywordUser = $em->getRepository('HomeBundle:Keyworduser')->findOneByKeyworduserId($keyworduserId);
        if ($keywordUser)
        {
            $keywordUser->setKeyworduserScore($new_keyworduserScore);
            $em->persist($keywordUser);
            $em->flush();
        }
    }
    
    public function insertar_keywordUser($em, $keywordId_1, $userId, $useripId)
    {
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId_1);
        $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
        $userip = $em->getRepository('HomeBundle:Userip')->findOneByUseripId($useripId);
        
        if ($keyword && $user && $userip)
        {
            $keywordid = $keyword->getKeywordid();
            
            $query_keywordUser = $em->createQuery(
                "
                SELECT DISTINCT 
                ku.keyworduserId, 
                ku.keyworduserScore 
                
                FROM HomeBundle:Keyworduser ku 
                
                JOIN HomeBundle:Keyword k 
                WITH k.keywordId = ku.keyword 
                
                JOIN HomeBundle:User u 
                WITH u.userId = ku.user 
                
                JOIN HomeBundle:Userip up 
                WITH up.useripId = ku.userip 
                
                WHERE 
                k.keywordId = '$keywordid' and 
                u.userId = '$userId' and 
                up.useripId = '$useripId' 
                "
            );
            
            $instance_keywordUser = $query_keywordUser->getResult();
            $amount_keywordUser = count($instance_keywordUser);
            
            if ($amount_keywordUser == 0)
            {
                $keywordUser = new \HomeBundle\Entity\Keyworduser;
                $keywordUser->setKeyworduserScore(0);
                $keywordUser->setKeyword($keyword);
                $keywordUser->setUser($user);
                $keywordUser->setUserip($userip);
                $em->persist($keywordUser);
                $em->flush();
                $keyworduserId = $keywordUser->getKeyworduserId();
            }
        }
        return $keyworduserId;
    }
}