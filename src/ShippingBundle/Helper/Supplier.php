<?php

namespace ShippingBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Supplier extends Controller {
    public $global_topicId = 0;
    
    public function getSupplier($db2, $supplier_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            supplier.supplier_id, 
            shipment.shipment_id, 
            shipping.shipping_id, 
            driverUser.driverUser_id, 
            vehicleUser.vehicleUser_id, 
            reach.reach_id 
            
            FROM supplier 
            
            INNER JOIN shipment ON supplier.shipment_id = shipment.shipment_id 
            
            INNER JOIN shipping ON supplier.shipping_id = shipping.shipping_id 
            
            INNER JOIN driverUser ON driverUser.driverUser_id = shipping.driver_id 
            INNER JOIN vehicleUser ON vehicleUser.vehicleUser_id = shipping.vehicle_id 
            INNER JOIN reach ON reach.reach_id = shipping.reach_id 
            
            WHERE supplier.supplier_id = '$supplier_id' 
        ";
        
        
//            driver.commercial_id as driver_id, 
//            driver.commercial_name as driver_name, 
//            driver.commercial_tin as driver_tin, 
//            vehicle.vehicle_id, 
//            vehicle.vehicle_plate 
//            
//            INNER JOIN commercial as driver ON driver.commercial_id = driverUser.driver_id 
//            INNER JOIN vehicle ON vehicle.vehicle_id = vehicleUser.vehicle_id 
        

//            WHERE saleDetail.saleDetail_id = '$saleDetail_id' 
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $supplier_id = $curso["supplier_id"];
            $shipment_id = $curso["shipment_id"];
            $shipping_id = $curso["shipping_id"];
            $driverUser_id = $curso["driverUser_id"];
            $vehicleUser_id = $curso["vehicleUser_id"];
            $reach_id = $curso["reach_id"];
            
            $supplierData[$i] = array(
                'supplier_id' => $supplier_id,
                'shipment_id' => $shipment_id,
                'shipping_id' => $shipping_id,
                'driverUser_id' => $driverUser_id,
                'vehicleUser_id' => $vehicleUser_id,
                'reach_id' => $reach_id,
                'amountRecords' => $amountRecords
            );
            
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $supplier_id = 0;
            $shipment_id = 0;
            $shipping_id = 0;
            $driverUser_id = 0;
            $vehicleUser_id = 0;
            $reach_id = 0;
            
            $supplierData[] = array(
                'supplier_id' => $supplier_id,
                'shipment_id' => $shipment_id,
                'shipping_id' => $shipping_id,
                'driverUser_id' => $driverUser_id,
                'vehicleUser_id' => $vehicleUser_id,
                'reach_id' => $reach_id,
                'amountRecords' => $amountRecords
            );
        }
        return $supplierData;
    }
    
//    public function getSupplier_2($db2, $saleDetail_id)
//    {
//        $string_d_1 = "";
//        $string_d_1 .= 
//        "
//        SELECT DISTINCT 
//            supplier.supplier_id, 
//            shipping.shipping_id, 
//            
//            commercial_driverUser.commercial_id as commercial_driverUser_id, 
//            vehicle.vehicle_plate, 
//            commercial_vehicleUser.commercial_id as commercial_vehicleUser_id 
//            
//            FROM supplier 
//            
//            INNER JOIN shipment ON supplier.shipment_id = shipment.shipment_id 
//            
//            INNER JOIN shipping ON shipping.shipping_id = supplier.shipping_id 
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
//            $supplier_id = $curso["supplier_id"];
//            $shipping_id = $curso["shipping_id"];
//            
//            $commercial_driverUser_id = $curso["commercial_driverUser_id"];
//            $vehicle_plate = $curso["vehicle_plate"];
//            $commercial_vehicleUser_id = $curso["commercial_vehicleUser_id"];
//            
//            $supplierData[$i] = array(
//                'supplier_id' => $supplier_id,
//                'shipping_id' => $shipping_id,
//                'commercial_driverUser_id' => $commercial_driverUser_id,
//                'vehicle_plate' => $vehicle_plate,
//                'commercial_vehicleUser_id' => $commercial_vehicleUser_id,
//                'amountRecords' => $amountRecords
//            );
//            
//            $i++;
//        }
//        
//        if ($amountRecords == 0)
//        {
//            $supplier_id = 0;
//            $shipping_id = 0;
//            
//            $commercial_driverUser_id = 0;
//            $vehicle_plate = "";
//            $commercial_vehicleUser_id = 0;
//            
//            $supplierData[] = array(
//                'supplier_id' => $supplier_id,
//                'shipping_id' => $shipping_id,
//                'commercial_driverUser_id' => $commercial_driverUser_id,
//                'vehicle_plate' => $vehicle_plate,
//                'commercial_vehicleUser_id' => $commercial_vehicleUser_id,
//                'amountRecords' => $amountRecords
//            );
//        }
//        return $supplierData;
//    }
    
}