<?php

namespace ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AssignmentController extends Controller
{
    public function assignSaleAction(Request $request)
    {
        $package_id = $_POST['package_id'];
        
        if ($request->isXMLHttpRequest()) {
            
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            
            $location_id = 350;
            
            $territoriality = $this->getTerritoriality($db2, $location_id);
            
//            $territoriality = 1;
            
            if ($territoriality == 1)
            {
                $reach_1 = $this->get('app.reach_1_international');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 2)
            {
                $reach_1 = $this->get('app.reach_2_continental');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 3)
            {
                $reach_1 = $this->get('app.reach_3_national');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 4)
            {
                $reach_1 = $this->get('app.reach_4_departamental');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 5)
            {
                $reach_1 = $this->get('app.reach_5_municipal');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 6)
            {
                $reach_1 = $this->get('app.reach_6_communal');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 7)
            {
                $reach_1 = $this->get('app.reach_7_local');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 8)
            {
                $reach_1 = $this->get('app.reach_8_residential');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 9)
            {
                $reach_1 = $this->get('app.reach_9_domiciled');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            } else if ($territoriality == 10)
            {
                $reach_1 = $this->get('app.reach_10_aditional');
                $reachId_1 = $reach_1->isValid($db2, $location_id);
            }
            

            
            
            
            
            
            
            
            $i = 0;
            if ($i==0)
            {
                $trajectory[] = array(
                    'saleDetail_id' => "",
                    'store_location' => "",
                    'custome_location' => "",
                    'records_amount' => 0
                );
            }
            
            return new Response(json_encode($trajectory), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getTerritoriality($db2, $location_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                territoriality.territoriality_id 
                
                FROM location 
                
                INNER JOIN territoriality ON territoriality.territoriality_id = location.territoriality 
                
                WHERE location.location_id = '$location_id' 
        ";
        
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;







        foreach($cursos2 as $curso)
        {
            $trajectory[$i] = array(
                'territoriality_id' => $curso["territoriality_id"]
            );
            $i++;
        }
        
        if ($i==0)
        {
            $trajectory[] = array(
                'territoriality_id' => 1
            );
        }
        
        return $trajectory;
    }
}