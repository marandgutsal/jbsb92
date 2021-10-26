<?php

namespace ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReachController extends Controller
{
    
//    public function getReachAction(Request $request)
//    {
//        if ($request->isXMLHttpRequest()) {
//            $em2 = $this->getDoctrine()->getEntityManager();
//            
//            $string_d_1 = "";
//            $string_d_1 .= 
//            "
//            SELECT DISTINCT 
//                Sale_1.sale_id as sale_id_1, 
//                Sale_1.customer_id as customer_id_1, 
//                Sale_1.sale_date as sale_date_1, 
//                Sale_1.sale_total as sale_total_1, 
//                Sale_1.sale_status as sale_status_1, 
//                SaleDetail_1.saleDetail_id as saleDetail_id_1, 
//                SaleDetail_1.product_id as product_id_1, 
//                SaleDetail_1.store_id as store_id_1, 
//                SaleDetail_1.saleDetail_amount as saleDetail_amount_1, 
//                product.product_name as product_name_1, 
//                product.product_description as product_description_1, 
//                product.product_image as product_image_1, 
//                
//
//
//                BRANCH_CUSTOMER.location_id as customer_branch_location_1, 
//                BRANCH_CUSTOMER.branch_id as customer_branch_id_1, 
//                BRANCH_CUSTOMER.branch_name as customer_branch_name_1, 
//                BRANCH_CUSTOMER.branch_telephone as customer_branch_telephone_1, 
//                BRANCH_CUSTOMER.branch_cellphone as customer_branch_cellphone_1, 
//                BRANCH_CUSTOMER.branch_aditional_information as customer_branch_aditional_information_1, 
//                
//                COMMERCIAL_CUSTOMER.commercial_id as commercial_customer_id, 
//                COMMERCIAL_CUSTOMER.commercial_name as commercial_customer_name, 
//                COMMERCIAL_CUSTOMER.commercial_tin as commercial_customer_tin, 
//                ORIGIN.location_name as location_origin, 
//                
//
//
//                BRANCH_STORE.location_id as store_branch_location_1, 
//                BRANCH_STORE.branch_id as store_branch_id_1, 
//                BRANCH_STORE.branch_name as store_branch_name_1, 
//                BRANCH_STORE.branch_telephone as store_branch_telephone_1, 
//                BRANCH_STORE.branch_cellphone as store_branch_cellphone_1, 
//                BRANCH_STORE.branch_aditional_information as store_branch_aditional_information_1, 
//                
//                COMMERCIAL_STORE.commercial_id as commercial_store_id, 
//                COMMERCIAL_STORE.commercial_name as commercial_store_name, 
//                COMMERCIAL_STORE.commercial_tin as commercial_store_tin, 
//                DESTINY.location_name as location_destiny 
//                
//
//
//
//                FROM sale as Sale_1 
//                INNER JOIN SaleDetail as SaleDetail_1 ON SaleDetail_1.sale_id = Sale_1.sale_id 
//                INNER JOIN product ON product.product_id = SaleDetail_1.product_id 
//                
//                
//                INNER JOIN branch as BRANCH_CUSTOMER ON BRANCH_CUSTOMER.branch_id = Sale_1.customer_id 
//                INNER JOIN commercial as COMMERCIAL_CUSTOMER ON COMMERCIAL_CUSTOMER.commercial_id = BRANCH_CUSTOMER.commercial_id 
//                INNER JOIN location as DESTINY ON BRANCH_CUSTOMER.location_id = DESTINY.location_id 
//                
//                
//                
//                INNER JOIN branch as BRANCH_STORE ON BRANCH_STORE.branch_id = SaleDetail_1.store_id 
//                INNER JOIN commercial as COMMERCIAL_STORE ON COMMERCIAL_STORE.commercial_id = BRANCH_STORE.commercial_id 
//                INNER JOIN location as ORIGIN ON BRANCH_STORE.location_id = ORIGIN.location_id 
//                
//                WHERE BRANCH_CUSTOMER.location_id = '148' and BRANCH_STORE.location_id = '132' 
//            ";
//              
//            
//            
//
//            
//            
//            
//            
//            
//            
//            
//        
//        $db2 = $em2->getConnection();
//        $stmt2 = $db2->prepare($string_d_1);
//        $params2 = array();
//        $stmt2->execute($params2);
//
//        $cursos2 = $stmt2->fetchAll();
//        $amountRecords = count($cursos2);
//        $i = 0;
//        
//        $alias[0] = 'sale_id_1';
//        $alias[1] = 'customer_id_1';
//        $alias[2] = 'sale_date_1';
//        $alias[3] = 'sale_total_1';
//        $alias[4] = 'sale_status_1';
//        $alias[5] = 'saleDetail_id_1';
//        $alias[6] = 'product_id_1';
//        $alias[7] = 'saleDetail_amount_1';
//        $alias[8] = 'product_name_1';
//        $alias[9] = 'product_description_1';
//        $alias[10] = 'product_image_1';
//        $alias[11] = 'store_branch_location_1';
//        $alias[12] = 'store_branch_id_1';
//        $alias[13] = 'store_branch_name_1';
//        $alias[14] = 'store_branch_telephone_1';
//        $alias[15] = 'store_branch_cellphone_1';
//        $alias[16] = 'store_branch_aditional_information_1';
//        $alias[17] = 'commercial_store_id';
//        $alias[18] = 'commercial_store_name';
//        $alias[19] = 'commercial_store_tin';
//        $alias[20] = 'location_origin';
//        $alias[21] = 'customer_branch_location_1';
//        $alias[22] = 'customer_branch_id_1';
//        $alias[23] = 'customer_branch_name_1';
//        $alias[24] = 'customer_branch_telephone_1';
//        $alias[25] = 'customer_branch_cellphone_1';
//        $alias[26] = 'customer_branch_aditional_information_1';
//        $alias[27] = 'commercial_customer_id';
//        $alias[28] = 'commercial_customer_name';
//        $alias[29] = 'commercial_customer_tin';
//        $alias[30] = 'location_destiny';
//        $alias[31] = 'amountRecords';
//        
//        foreach($cursos2 as $curso)
//        {
//            $sendata_sale[$i] = array(
//                'sale_id_1' => $curso["sale_id_1"],
//                'customer_id_1' => $curso["customer_id_1"],
//                'sale_date_1' => $curso["sale_date_1"],
//                'sale_total_1' => $curso["sale_total_1"],
//                'sale_status_1' => $curso["sale_status_1"],
//                'saleDetail_id_1' => $curso["saleDetail_id_1"],
//                'product_id_1' => $curso["product_id_1"],
//                'saleDetail_amount_1' => $curso["saleDetail_amount_1"],
//                'product_name_1' => $curso["product_name_1"],
//                'product_description_1' => $curso["product_description_1"],
//                'product_image_1' => $curso["product_image_1"],
//                
//                'store_branch_location_1' => $curso["store_branch_location_1"],
//                'store_branch_id_1' => $curso["store_branch_id_1"],
//                'store_branch_name_1' => $curso["store_branch_name_1"],
//                'store_branch_telephone_1' => $curso["store_branch_telephone_1"],
//                'store_branch_cellphone_1' => $curso["store_branch_cellphone_1"],
//                'store_branch_aditional_information_1' => $curso["store_branch_aditional_information_1"],
//                
//                
//                'commercial_store_id' => $curso["commercial_store_id"],
//                'commercial_store_name' => $curso["commercial_store_name"],
//                'commercial_store_tin' => $curso["commercial_store_tin"],
//                'location_origin' => $curso["location_origin"],
//                
//                
//                
//                
//                
//                
//                
//                'customer_branch_location_1' => $curso["customer_branch_location_1"],
//                'customer_branch_id_1' => $curso["customer_branch_id_1"],
//                'customer_branch_name_1' => $curso["customer_branch_name_1"],
//                'customer_branch_telephone_1' => $curso["customer_branch_telephone_1"],
//                'customer_branch_cellphone_1' => $curso["customer_branch_cellphone_1"],
//                'customer_branch_aditional_information_1' => $curso["customer_branch_aditional_information_1"],
//                
//                
//                'commercial_customer_id' => $curso["commercial_customer_id"],
//                'commercial_customer_name' => $curso["commercial_customer_name"],
//                'commercial_customer_tin' => $curso["commercial_customer_tin"],
//                'location_destiny' => $curso["location_destiny"],
//                
//                'amountRecords' => $amountRecords,
//                'alias' => $alias
//            );
//            $i++;
//        }
//
//        if ($i == 0)
//        {
//            $sendata_sale[0] = array(
//                'sale_id_1' => "_",
//                'customer_id_1' => "_",
//                'sale_date_1' => "_",
//                'sale_total_1' => "_",
//                'sale_status_1' => "_",
//                'saleDetail_id_1' => "_",
//                'product_id_1' => "_",
//                'saleDetail_amount_1' => "_",
//                'product_name_1' => "_",
//                'product_description_1' => "_",
//                'product_image_1' => "_",
//                
//                
//                'store_branch_location_1' => "_",
//                'store_branch_id_1' => "_",
//                'store_branch_name_1' => "_",
//                'store_branch_telephone_1' => "_",
//                'store_branch_cellphone_1' => "_",
//                'store_branch_aditional_information_1' => "_",
//                
//                'commercial_store_id' => "_",
//                'commercial_store_name' => "_",
//                'commercial_store_tin' => "_",
//                'location_origin' => "_",
//                
//                
//                'customer_branch_location_1' => "_",
//                'customer_branch_id_1' => "_",
//                'customer_branch_name_1' => "_",
//                'customer_branch_telephone_1' => "_",
//                'customer_branch_cellphone_1' => "_",
//                'customer_branch_aditional_information_1' => "_",
//                
//                'commercial_customer_id' => "_",
//                'commercial_customer_name' => "_",
//                'commercial_customer_tin' => "_",
//                'location_destiny' => "_",
//                
//                'amountRecords' => $amountRecords,
//                'alias' => $alias
//            );
//        }
//        
//            return new Response(
//                json_encode($sendata_sale), 
//                200, 
//                array('Content-Type' => 'application/json'));
//        }
//    }
    
    public function addShippingAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}