<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class User extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
//        $valor1 = $this->getUserId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
//    public function getUserId($em, $usertypeClass)
//    {
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
//        return $usertypeId;
//    }
    
    public function checkUser($db2, $user_id, $user_name, $user_email)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            user.user_id, 
            user.user_name, 
            user.user_firstGivenName, 
            user.user_secondGivenName, 
            user.user_firstFamilyName, 
            user.user_secondFamilyName, 
            user.user_email, 
            user.user_biography 
            
            FROM user 
            
            WHERE user.user_id = '$user_id' or 
                user.user_name = '$user_name' or 
                user.user_email = '$user_email' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $user_id = $curso["user_id"];
            $user_name = $curso["user_name"];
            $user_firstGivenName = $curso["user_firstGivenName"];
            $user_secondGivenName = $curso["user_secondGivenName"];
            $user_firstFamilyName = $curso["user_firstFamilyName"];
            $user_secondFamilyName = $curso["user_secondFamilyName"];
            $user_email = $curso["user_email"];
            $user_biography = $curso["user_biography"];
            
            $locationData[$i] = array(
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $locationData[] = array(
                'user_id' => 0,
                'user_name' => "",
                'user_firstGivenName' => "",
                'user_secondGivenName' => "",
                'user_firstFamilyName' => "",
                'user_secondFamilyName' => "",
                'user_email' => "",
                'user_biography' => "",
                'amountRecords' => $amountRecords
            );
        }
        
        return $locationData;
    }
    
    public function checkUser_2($db2, $user_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            user.user_id, 
            user.user_name, 
            user.user_firstGivenName, 
            user.user_secondGivenName, 
            user.user_firstFamilyName, 
            user.user_secondFamilyName, 
            user.user_email, 
            user.user_biography 
            
            FROM user 
            
            WHERE user.user_id = '$user_id'
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $user_id = $curso["user_id"];
            $user_name = $curso["user_name"];
            $user_firstGivenName = $curso["user_firstGivenName"];
            $user_secondGivenName = $curso["user_secondGivenName"];
            $user_firstFamilyName = $curso["user_firstFamilyName"];
            $user_secondFamilyName = $curso["user_secondFamilyName"];
            $user_email = $curso["user_email"];
            $user_biography = $curso["user_biography"];
            
            $locationData[$i] = array(
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $locationData[] = array(
                'user_id' => 0,
                'user_name' => "",
                'user_firstGivenName' => "",
                'user_secondGivenName' => "",
                'user_firstFamilyName' => "",
                'user_secondFamilyName' => "",
                'user_email' => "",
                'user_biography' => "",
                'amountRecords' => $amountRecords
            );
        }
        
        return $locationData;
    }
    
}