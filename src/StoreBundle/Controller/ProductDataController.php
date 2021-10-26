<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



class ProductDataController extends Controller
{
    public function getProductDataAction(Request $request) {
        $productId = $_POST['productId'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                product.product_id, 
                product.product_name, 
                product.product_price, 
                product.product_description, 
                product.product_image, 
                product.product_score 
                
                FROM product 
                
                WHERE product.product_id = '$productId' 
            ";
    
            $db2 = $em2->getConnection();
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);
            $i = 0;
            
            foreach($cursos2 as $curso)
            {
                $sendata[$i] = array(
                    'product_id' => $curso["product_id"],
                    'product_name' => $curso["product_name"],
                    'product_price' => $curso["product_price"],
                    'product_description' => $curso["product_description"],
                    'product_image' => $curso["product_image"],
                    'product_score' => $curso["product_score"],
                    'amountRecords' => $amountRecords
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendata[0] = array(
                    'product_id' => $curso["product_id"],
                    'product_name' => "",
                    'product_price' => "",
                    'product_description' => "",
                    'product_image' => "",
                    'product_score' => "",
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSaleDetailAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            if (isset($_SESSION['loginSession'])) {
                $log_userId = $_SESSION['loginSession'];
            }
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

//            $checker_1 = $this->get('app.saledetail');
//            $saleDetail = $checker_1->checkSaleDetail($db2, $log_userId);
            
            $checker_1 = $this->get('app.saledetail');
            $saleDetail = $checker_1->assignShipping_to_SaleDetail($em, $db2, $log_userId);
            
            return new Response(json_encode($saleDetail), 200, array('Content-Type' => 'application/json'));
        }
    }
    
//    paySelectedProducts
    
    public function paySelectedProductsAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
                        
            $checker_1 = $this->get('app.set_trajectory');
            $saleDetail = $checker_1->isValid($em);
            
//    isValid($em, $usertypeClass)
        
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}