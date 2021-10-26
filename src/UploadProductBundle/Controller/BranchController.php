<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BranchController extends Controller
{
    public function uploadBranchAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $branchName = $_POST['branchName'];
            $branchCellphone = $_POST['branchCellphone'];
            $branchTelephone = $_POST['branchTelephone'];
            $branchDescription = $_POST['branchDescription'];
            $commercial = $_POST['commercial'];
            $location = $_POST['location'];
            
            ////////////////////////////////////////////////////////////////////////////
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $query2 = "
                INSERT INTO `branch`(
                `commercial_id`, 
                `location_id`, 
                `branch_name`, 
                `branch_telephone`, 
                `branch_cellphone`, 
                `branch_aditional_information`) 
                VALUES (
                '$commercial',
                '$location',
                '$branchName',
                '$branchTelephone',
                '$branchCellphone',
                '$branchDescription')
            ";
            
            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function loadCommercialAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
            $commercial_query = $em->createQuery(
                "
                SELECT DISTINCT 
                    c.commercialId, 
                    c.commercialName, 
                    c.commercialLogo, 
                    c.commercialTin, 
                    ut.usertypeClass 
                    
                    FROM HomeBundle:Commercial c 
                    
                    JOIN HomeBundle:User u 
                    WITH u.userId = c.user 
                    
                    JOIN HomeBundle:Usertype ut 
                    WITH ut.usertypeId = c.usertype 
                    
                    WHERE u.userId = '$userId' 
                "
            );
            $commercial_e = $commercial_query->getResult();
            
            $amountcommercials = count($commercial_e);
            
            $i = 0;
            while (isset($commercial_e[$i]['commercialId'])) {
                
                $commercialId_value = $commercial_e[$i]['commercialId'];
                $commercialName_value = $commercial_e[$i]['commercialName'];
                $commercialLogo_value = $commercial_e[$i]['commercialLogo'];
                $commercialTin_value = $commercial_e[$i]['commercialTin'];
                $usertypeClass_value = $commercial_e[$i]['usertypeClass'];
                
                $locationData[$i] = array(
                    'commercialId' => $commercialId_value, 
                    'commercialName' => $commercialName_value, 
                    'commercialLogo' => $commercialLogo_value, 
                    'commercialTin' => $commercialTin_value, 
                    'usertypeClass' => $usertypeClass_value, 
                    'amountcommercials' => $amountcommercials 
                );
                $i++;
            }
            
            if ($amountcommercials == 0)
            {
                $locationData[] = array(
                    'commercialId' => 0, 
                    'commercialName' => "other", 
                    'commercialLogo' => "_", 
                    'commercialTin' => 0, 
                    'usertypeClass' => "_", 
                    'amountcommercials' => $amountcommercials 
                );
            }
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}