<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Usertype extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $usertypeClass)
    {
        $valor1 = $this->getUserTypeId($em, $usertypeClass);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function getUserTypeId($em, $usertypeClass)
    {
        $usertype = $em->createQuery(
            "SELECT DISTINCT 
                ut.usertypeId, ut.usertypeClass 
                
            FROM HomeBundle:Usertype ut 
            
            WHERE ut.usertypeClass = '$usertypeClass' 
            "
        );
        
        $usertype_i = $usertype->getResult();
        
        $usertypeId = $usertype_i[0]['usertypeId'];
       
        return $usertypeId;
    }
    
}