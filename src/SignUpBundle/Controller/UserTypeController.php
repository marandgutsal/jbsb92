<?php

namespace SignUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use SignUpBundle\Helper;

class UserTypeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@SignUp/Default/index.html.twig');
    }
    
    public function searchShippingCategoryAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

            $query_keyword = "
                SELECT DISTINCT 
                    shippingCategory.shippingCategory_id, 
                    shippingCategory.shippingCategory_name, 
                    shippingCategory.shippingCategory_description 
                    
                    FROM shippingCategory
            ";

            $stmt2 = $db2->prepare($query_keyword);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);
            
            $j = 0;
            foreach($cursos2 as $curso)
            {
                $shippingCategory_id = $curso["shippingCategory_id"];
                $shippingCategory_name = $curso["shippingCategory_name"];
                $shippingCategory_description = $curso["shippingCategory_description"];

                $locationData[$j] = array(
                    'shippingCategory_id' => $shippingCategory_id,
                    'shippingCategory_name' => $shippingCategory_name,
                    'shippingCategory_description' => $shippingCategory_description,
                    'amountRecords' => $amountRecords
                );
                
                $j++;
            }
            
            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'shippingCategory_id' => 0,
                    'shippingCategory_name' => "",
                    'shippingCategory_description' => "",
                    'amountRecords' => $amountRecords
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getFinalLocationUserAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
            
        if ($request->isXMLHttpRequest()) {
//            $amountItems = $sendData[0]["amountSelectedProducts"];
////        $amountItems = $sendData[0][8];
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

            $query_keyword = "
                SELECT DISTINCT 
                    user.user_id, 
                    location.location_id 
                    
                FROM user 
                    
                INNER JOIN location ON user.location_id = location.location_id 
                    
                WHERE user.user_id = '$userId'
            ";

            $stmt2 = $db2->prepare($query_keyword);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            
            $location_id = 1;
            $geolocalization[0] = $location_id;
            foreach($cursos2 as $curso)
            {
                $location_id = $curso["location_id"];
            }
            
            $j = 0;
            while ($location_id != 1 && $j != 20)
            {
                $query_keyword33 = "
                    SELECT DISTINCT 
                        location.location_id, 
                        parent.location_id as parent_id 
                        
                    FROM location 
                    
                    INNER JOIN location as parent ON location.location_parent = parent.location_id 
                    
                    WHERE location.location_id = '$location_id' 
                ";

                $stmt3 = $db2->prepare($query_keyword33);
                $params3 = array();
                $stmt3->execute($params3);

                $cursos3 = $stmt3->fetchAll();

                foreach($cursos3 as $curso)
                {
                    $location_id = $curso["parent_id"];
                    $geolocalization[$j] = $location_id;
                }
                $j++;
            }
            
            $locationData[] = array(
                'userId' => $userId,
                'geolocalization' => $geolocalization,
                'positions' => $j
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}