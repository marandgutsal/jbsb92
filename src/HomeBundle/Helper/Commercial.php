<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Commercial extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
        return $valor1;
    }
     
    public function checkCommercial($db2, 
                    $user_id, 
                    $commercial_name, $commercial_tin, $userType_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            commercial.commercial_id, 
            commercial.commercial_name, 
            commercial.commercial_tin 
            
            FROM user 
            
            INNER JOIN commercial ON commercial.user_id = user.user_id 
            
            WHERE user.user_id = '$user_id' and 
                commercial.commercial_name = '$commercial_name' and 
                commercial.commercial_tin = '$commercial_tin' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $commercial_id = $curso["commercial_id"];
            $commercial_name = $curso["commercial_name"];
            $commercial_tin = $curso["commercial_tin"];
            
            $locationData[$i] = array(
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_tin' => $commercial_tin,
                'amountRecords' => $amountRecords
            );
            
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $locationData = $this->insertCommercial($db2, $user_id, $commercial_name, $commercial_tin, $userType_id);
        }
        
        return $locationData;
    }
    
    public function checkCommercial_byUserId($db2, $user_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            commercial.commercial_id, 
            commercial.commercial_name, 
            commercial.commercial_tin, 
            user.user_id, 
            user.user_name, 
            user.user_firstGivenName, 
            user.user_secondGivenName, 
            user.user_firstFamilyName, 
            user.user_secondFamilyName, 
            user.user_email, 
            user.user_biography 
            
            FROM user 
            
            INNER JOIN commercial ON commercial.user_id = user.user_id 
            
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
            $commercial_id = $curso["commercial_id"];
            $commercial_name = $curso["commercial_name"];
            $commercial_tin = $curso["commercial_tin"];
            $user_id = $curso["user_id"];
            $user_name = $curso["user_name"];
            $user_firstGivenName = $curso["user_firstGivenName"];
            $user_secondGivenName = $curso["user_secondGivenName"];
            $user_firstFamilyName = $curso["user_firstFamilyName"];
            $user_secondFamilyName = $curso["user_secondFamilyName"];
            $user_email = $curso["user_email"];
            $user_biography = $curso["user_biography"];
            
            $locationData[$i] = array(
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_tin' => $commercial_tin,
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
                'commercial_id' => 0,
                'commercial_name' => "",
                'commercial_tin' => "",
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
    
    public function insertCommercial($db2, $user_id, $commercial_name, $commercial_tin, $userType_id)
    {
        $query2 = "
            INSERT INTO `commercial`(
            `commercial_name`, 
            `commercial_tin`, 
            `commercial_logo`, 
            `user_id`, 
            `userType_id`) 
            VALUES (
            '$commercial_name',
            '$commercial_tin',
            '',
            '$user_id',
            '$userType_id')
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
            $commercial_id = $curso["inserted"];
        }
        
        $locationData[] = array(
            'commercial_id' => $commercial_id,
            'commercial_name' => $commercial_name,
            'commercial_tin' => $commercial_tin,
            'amountRecords' => 1
        );
        
        return $locationData;
    }
    
    public function check_commercial_userLogged($db2, $log_userId, $outsourcing_userType_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            commercial.commercial_id, 
            commercial.commercial_name, 
            commercial.commercial_tin 
            
            FROM user 
            
            INNER JOIN commercial ON commercial.user_id = user.user_id 
            
            WHERE user.user_id = '$log_userId' and 
                commercial.userType_id = '$outsourcing_userType_id' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $commercial_id = $curso["commercial_id"];
            $commercial_name = $curso["commercial_name"];
            $commercial_tin = $curso["commercial_tin"];
            
            $locationData[$i] = array(
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_tin' => $commercial_tin,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $locationData = $this->insertCommercial($db2, $log_userId, "", "", $outsourcing_userType_id);
        }
        
        return $locationData;
    }
    
}