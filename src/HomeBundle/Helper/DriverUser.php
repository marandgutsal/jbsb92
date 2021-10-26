<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DriverUser extends Controller {
    
    public $global_topicId = 0;
    
    public function checkDriverUser($db2, $userLogged_commercial_id, $driver_commercial_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            driverUser.driverUser_id 
            
            FROM driverUser 
            
            INNER JOIN commercial as driverCommercial ON driverCommercial.commercial_id = driverUser.driver_id 
            
            INNER JOIN commercial as vehicleCompany ON vehicleCompany.commercial_id = driverUser.user_id 
            
            INNER JOIN user ON user.user_id = driverUser.user_id 
            
            WHERE driverCommercial.commercial_id = '$driver_commercial_id' and 
            vehicleCompany.commercial_id = '$userLogged_commercial_id' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);

        foreach($cursos2 as $curso)
        {
            $driverUser_id = $curso["driverUser_id"];
        }
        
        if ($amountRecords == 0)
        {
//            $driverUser_id = 32;
            $driverUser_id = $this->insertDriverUser($db2, $userLogged_commercial_id, $driver_commercial_id);
        }
        
        return $driverUser_id;
    }
    
    public function insertDriverUser($db2, $userLogged_commercial_id, $driver_commercial_id)
    {
        $query4 = "
            INSERT INTO `driverUser`( 
            `driver_id`, 
            `user_id`) 
            VALUES (
            '$driver_commercial_id',
            '$userLogged_commercial_id')
        ";

        $stmt4 = $db2->prepare($query4);
        $params4 = array();
        $stmt4->execute($params4);
        
        $query5 = "
            SELECT LAST_INSERT_ID() as inserted 
        ";
        
        $stmt5 = $db2->prepare($query5);
        $params5 = array();
        $stmt5->execute($params5);
        
        $cursos5 = $stmt5->fetchAll();
        foreach($cursos5 as $curso)
        {
            $new_driverUserId = $curso["inserted"];
        }
        
//        $locationData[] = array(
//            'new_driverUserId' => $new_driverUserId
//        );
            
        return $new_driverUserId;
    }
    
}