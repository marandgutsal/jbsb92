<?php

namespace ShippingBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Supplying extends Controller {
    public $global_topicId = 0;
    
    public function getSupplying($db2, $supplying_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            supplying.supplying_id, 
            shipment.shipment_id, 
            branch.branch_id, 
            branch.branch_name, 
            branch.branch_telephone, 
            branch.branch_cellphone, 
            branch.branch_aditional_information, 
            commercial.commercial_id, 
            commercial.commercial_name, 
            commercial.commercial_logo, 
            location.location_id 
            
            FROM supplying 
            
            INNER JOIN shipment ON shipment.shipment_id = supplying.shipment_id 
            
            INNER JOIN branch ON branch.branch_id = supplying.branch_id 
            INNER JOIN commercial ON commercial.commercial_id = branch.commercial_id 
            INNER JOIN location ON location.location_id = branch.location_id 
            
            WHERE supplying.supplying_id = '$supplying_id'
        ";

//            WHERE saleDetail.saleDetail_id = '$saleDetail_id' 
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $supplying_id = $curso["supplying_id"];
            $shipment_id = $curso["shipment_id"];
            $branch_id = $curso["branch_id"];
            $branch_name = $curso["branch_name"];
            $branch_telephone = $curso["branch_telephone"];
            $branch_cellphone = $curso["branch_cellphone"];
            $branch_aditional_information = $curso["branch_aditional_information"];
            $commercial_id = $curso["commercial_id"];
            $commercial_name = $curso["commercial_name"];
            $commercial_logo = $curso["commercial_logo"];
            $location_id = $curso["location_id"];
            
            $supplyingData[$i] = array(
                'supplying_id' => $supplying_id,
                'shipment_id' => $shipment_id,
                'branch_id' => $branch_id,
                'branch_name' => $branch_name,
                'branch_telephone' => $branch_telephone,
                'branch_cellphone' => $branch_cellphone,
                'branch_aditional_information' => $branch_aditional_information,
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_logo' => $commercial_logo,
                'location_id' => $location_id,
                'amountRecords' => $amountRecords
            );
            
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $supplying_id = 0;
            $shipment_id = 0;
            $branch_id = 0;
            $branch_name = "";
            $branch_telephone = 0;
            $branch_cellphone = 0;
            $branch_aditional_information = "";
            $commercial_id = 0;
            $commercial_name = "";
            $commercial_logo = "";
            $location_id = 0;
            
            $supplyingData[] = array(
                'supplying_id' => $supplying_id,
                'shipment_id' => $shipment_id,
                'branch_id' => $branch_id,
                'branch_name' => $branch_name,
                'branch_telephone' => $branch_telephone,
                'branch_cellphone' => $branch_cellphone,
                'branch_aditional_information' => $branch_aditional_information,
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_logo' => $commercial_logo,
                'location_id' => $location_id,
                'amountRecords' => $amountRecords
            );
        }
        return $supplyingData;
    }
    
//    public function getSupplying_2($db2, $saleDetail_id)
//    {
//        $string_d_1 = "";
//        $string_d_1 .= 
//        "
//        SELECT DISTINCT 
//            supplying.supplying_id, 
//            branch.branch_id, 
//            location.location_id, 
//            keyword.keyword_content as location_name, 
//            commercial.commercial_name, 
//            commercial.commercial_tin, 
//            partnership.user_name as partnership_name, 
//            partnership.user_firstGivenName as partnership_firstGivenName, 
//            partnership.user_secondGivenName as partnership_secondGivenName, 
//            partnership.user_firstFamilyName as partnership_firstFamilyName, 
//            partnership.user_secondFamilyName as partnership_secondFamilyName, 
//            userType.userType_id, 
//            userType.userType_class, 
//            
//            shipment.shipment_id, 
//            shippingUser.shippingUser_id, 
//            shipping.shipping_id, 
//            
//            commercial_driverUser.commercial_id as commercial_driverUser_id, 
//            vehicle.vehicle_plate, 
//            commercial_vehicleUser.commercial_id as commercial_vehicleUser_id 
//            
//            FROM supplying 
//            
//            INNER JOIN branch ON supplying.branch_id = branch.branch_id 
//            INNER JOIN location ON location.location_id = branch.location_id 
//            INNER JOIN keywordLocation ON keywordLocation.location_id = location.location_id 
//            INNER JOIN keyword ON keyword.keyword_id = keywordLocation.keyword_id 
//            
//            INNER JOIN commercial ON branch.commercial_id = commercial.commercial_id 
//            INNER JOIN user as partnership ON partnership.user_id = commercial.user_id 
//            INNER JOIN userType ON userType.userType_id = commercial.userType_id 
//            
//            INNER JOIN shipment ON shipment.shipment_id = supplying.shipment_id 
//            INNER JOIN shippingUser ON shipment.shippingUser_id = shippingUser.shippingUser_id 
//            INNER JOIN shipping ON shipping.shipping_id = shippingUser.shipping_id 
//            
//            INNER JOIN driverUser ON driverUser.driverUser_id = shipping.driver_id 
//            INNER JOIN commercial as commercial_driverUser ON commercial_driverUser.commercial_id = driverUser.driver_id 
//            
//            INNER JOIN vehicleUser ON vehicleUser.vehicleUser_id = shipping.vehicle_id 
//            INNER JOIN vehicle ON vehicle.vehicle_id = vehicleUser.vehicle_id 
//            INNER JOIN commercial as commercial_vehicleUser ON commercial_vehicleUser.commercial_id = vehicle.user_id 
//            
//            INNER JOIN saleDetail ON saleDetail.saleDetail_id = shipment.saleDetail_id 
//            
//        ";
//
////            WHERE saleDetail.saleDetail_id = '$saleDetail_id' 
//        $stmt2 = $db2->prepare($string_d_1);
//        $params2 = array();
//        $stmt2->execute($params2);
//
//        $cursos2 = $stmt2->fetchAll();
//        $amountRecords = count($cursos2);
//        
//        $i = 0;
//        foreach($cursos2 as $curso)
//        {
//            $supplying_id = $curso["supplying_id"];
//            $branch_id = $curso["branch_id"];
//            $location_id = $curso["location_id"];
//            $location_name = $curso["location_name"];
//            $commercial_name = $curso["commercial_name"];
//            $commercial_tin = $curso["commercial_tin"];
//            $partnership_name = $curso["partnership_name"];
//            $partnership_firstGivenName = $curso["partnership_firstGivenName"];
//            $partnership_secondGivenName = $curso["partnership_secondGivenName"];
//            $partnership_firstFamilyName = $curso["partnership_firstFamilyName"];
//            $partnership_secondFamilyName = $curso["partnership_secondFamilyName"];
//            $userType_id = $curso["userType_id"];
//            $userType_class = $curso["userType_class"];
//            
//            $shipment_id = $curso["shipment_id"];
//            $shippingUser_id = $curso["shippingUser_id"];
//            $shipping_id = $curso["shipping_id"];
//            $commercial_driverUser_id = $curso["commercial_driverUser_id"];
//            $vehicle_plate = $curso["vehicle_plate"];
//            $commercial_vehicleUser_id = $curso["commercial_vehicleUser_id"];
//            
//            $supplyingData[$i] = array(
//                'supplying_id' => $supplying_id,
//                'branch_id' => $branch_id,
//                'location_id' => $location_id,
//                'location_name' => $location_name,
//                'commercial_name' => $commercial_name,
//                'commercial_tin' => $commercial_tin,
//                'partnership_name' => $partnership_name,
//                'partnership_firstGivenName' => $partnership_firstGivenName,
//                'partnership_secondGivenName' => $partnership_secondGivenName,
//                'partnership_firstFamilyName' => $partnership_firstFamilyName,
//                'partnership_secondFamilyName' => $partnership_secondFamilyName,
//                'userType_id' => $userType_id,
//                'userType_class' => $userType_class,
//                
//                'shipment_id' => $shipment_id,
//                'shippingUser_id' => $shippingUser_id,
//                'shipping_id' => $shipping_id,
//                'commercial_driverUser_id' => $commercial_driverUser_id,
//                'vehicle_plate' => $vehicle_plate,
//                'commercial_vehicleUser_id' => $commercial_vehicleUser_id,
//                
//                'amountRecords' => $amountRecords
//            );
//            
//            $i++;
//        }
//        
//        if ($amountRecords == 0)
//        {
//            $supplying_id = 0;
//            $branch_id = 0;
//            $location_id = 0;
//            $location_name = "";
//            $commercial_name = "";
//            $commercial_tin = 0;
//            $partnership_name = "";
//            $partnership_firstGivenName = "";
//            $partnership_secondGivenName = "";
//            $partnership_firstFamilyName = "";
//            $partnership_secondFamilyName = "";
//            $userType_id = 0;
//            $userType_class = "";
//            
//            $shipment_id = 0;
//            $shippingUser_id = 0;
//            $shipping_id = 0;
//            $commercial_driverUser_id = 0;
//            $vehicle_plate = "";
//            $commercial_vehicleUser_id = 0;
//            
//            $supplyingData[] = array(
//                'supplying_id' => $supplying_id,
//                'branch_id' => $branch_id,
//                'location_id' => $location_id,
//                'location_name' => $location_name,
//                'commercial_name' => $commercial_name,
//                'commercial_tin' => $commercial_tin,
//                'partnership_name' => $partnership_name,
//                'partnership_firstGivenName' => $partnership_firstGivenName,
//                'partnership_secondGivenName' => $partnership_secondGivenName,
//                'partnership_firstFamilyName' => $partnership_firstFamilyName,
//                'partnership_secondFamilyName' => $partnership_secondFamilyName,
//                'userType_id' => $userType_id,
//                'userType_class' => $userType_class,
//                
//                'shipment_id' => $shipment_id,
//                'shippingUser_id' => $shippingUser_id,
//                'shipping_id' => $shipping_id,
//                'commercial_driverUser_id' => $commercial_driverUser_id,
//                'vehicle_plate' => $vehicle_plate,
//                'commercial_vehicleUser_id' => $commercial_vehicleUser_id,
//                
//                'amountRecords' => $amountRecords
//            );
//        }
//        return $supplyingData;
//    }
    
}