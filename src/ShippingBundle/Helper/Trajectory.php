<?php

namespace ShippingBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Trajectory extends Controller {
    public $global_topicId = 0;
    
    public function getTrajectory($db2, $shipment_id)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            supplier.supplier_id as identifier, 
            shipping.shipping_id as description, 
            concat('supplier') as table_db, 
            shipment.shipment_id as found_shipment, 
            node.departure_date as departure_date, 
            node.delivery_date as delivery_date, 
            node.agreement_date as agreement_date, 
            concat( 
                'supplier: ', 
                '(', 
                    supplier.supplier_id, 
                    ' - ', 
                    shipment.shipment_id, 
                ')' 
            ) as individual_description 
            
            FROM supplier 
            
            INNER JOIN shipment ON supplier.shipment_id = shipment.shipment_id 
            
            INNER JOIN shipping ON shipping.shipping_id = supplier.shipping_id 
            
            INNER JOIN node ON node.node_id = supplier.node_id 
            
            WHERE shipment.shipment_id = '$shipment_id'
        ";
        
        $string_d_2 = "";
        $string_d_2 .= 
        "
        SELECT DISTINCT 
            supplying.supplying_id as identifier, 
            branch.branch_id as description, 
            concat('supplying') as table_db, 
            shipment.shipment_id as found_shipment, 
            node.departure_date as departure_date, 
            node.delivery_date as delivery_date, 
            node.agreement_date as agreement_date, 
            concat( 
                'supplying: ', 
                '(', 
                    supplying.supplying_id, 
                    ' - ', 
                    shipment.shipment_id, 
                ')' 
            ) as individual_description 
            
            FROM supplying 
            
            INNER JOIN shipment ON shipment.shipment_id = supplying.shipment_id 
            
            INNER JOIN branch ON branch.branch_id = supplying.branch_id 
            
            INNER JOIN node ON node.node_id = supplying.node_id 
            
            WHERE shipment.shipment_id = '$shipment_id'
        ";
        
        $query2 = "
            SELECT DISTINCT 
                identifier, 
                description, 
                table_db, 
                departure_date, 
                delivery_date, 
                agreement_date, 
                individual_description 
            FROM 
            (
            ".
            $string_d_1.
            "
            UNION ALL 
            ".
            $string_d_2.
            "
            ) TBL 
            GROUP BY individual_description 
            ORDER BY delivery_date DESC 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $identifier = $curso["identifier"];
            $description = $curso["description"];
            $table_db = $curso["table_db"];
            $departure_date = $curso["departure_date"];
            $delivery_date = $curso["delivery_date"];
            $agreement_date = $curso["agreement_date"];
            
            $individual_description = $curso["individual_description"];
            $trajectoryData[$i] = array(
                'identifier' => $identifier,
                'description' => $description,
                'table_db' => $table_db,
                'departure_date' => $departure_date,
                'delivery_date' => $delivery_date,
                'agreement_date' => $agreement_date,
                'individual_description' => $individual_description,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $identifier = 0;
            $description = "";
            $table_db = "";
            $departure_date = "";
            $delivery_date = "";
            $agreement_date = "";
            $individual_description = 0;
            
            $trajectoryData[] = array(
                'identifier' => $identifier,
                'description' => $description,
                'table_db' => $table_db,
                'departure_date' => $departure_date,
                'delivery_date' => $delivery_date,
                'agreement_date' => $agreement_date,
                'individual_description' => $individual_description,
                'amountRecords' => $amountRecords
            );
        }
        return $trajectoryData;
    }
    
    public function getLocation($db2, $value)
    {
        $query2 = "
            SELECT DISTINCT 
                location.location_id, 
                keyword.keyword_content as location_name, 
                locationParent.location_id as locationParent_id 
                
            FROM location 
            
            INNER JOIN keywordLocation ON keywordLocation.location_id = location.location_id 
            INNER JOIN keyword ON keyword.keyword_id = keywordLocation.keyword_id 
            INNER JOIN location as locationParent ON locationParent.location_id = location.location_id 
            
            WHERE location.location_id = '$value' 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $alias[0] = 'location_id';
        $alias[1] = 'location_name';
        $alias[2] = 'locationParent_id';
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $location_id = $curso["location_id"];
            $location_name = $curso["location_name"];
            $locationParent_id = $curso["locationParent_id"];
            
            $locationData[$i] = array(
                'location_id' => $location_id,
                'location_name' => $location_name,
                'locationParent_id' => $locationParent_id,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $location_id = 0;
            $location_name = "";
            $locationParent_id = 0;
            
            $locationData[] = array(
                'location_id' => $location_id,
                'location_name' => $location_name,
                'locationParent_id' => $locationParent_id,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
        }
        return $locationData;
    }
    
    public function getDriver($db2, $value)
    {
        $query2 = "
            SELECT DISTINCT 
                driver.commercial_id, 
                driver.commercial_name, 
                driver.commercial_logo, 
                driver.commercial_tin, 
                user.user_id, 
                user.user_profilePhoto, 
                user.user_name, 
                user.user_firstGivenName, 
                user.user_secondGivenName, 
                user.user_firstFamilyName, 
                user.user_secondFamilyName, 
                user.user_email, 
                user.user_biography, 
                user.user_score 
                
            FROM driverUser 
            
            INNER JOIN commercial as driver ON driver.commercial_id = driverUser.driver_id 
            
            INNER JOIN user ON user.user_id = driver.user_id 
            
            WHERE driverUser.driverUser_id = '$value' 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
            $alias[0] = 'commercial_id';
            $alias[1] = 'commercial_name';
            $alias[2] = 'commercial_logo';
            $alias[3] = 'commercial_tin';
            $alias[4] = 'user_id';
            $alias[5] = 'user_profilePhoto';
            $alias[6] = 'user_name';
            $alias[7] = 'user_firstGivenName';
            $alias[8] = 'user_secondGivenName';
            $alias[9] = 'user_firstFamilyName';
            $alias[10] ='user_secondFamilyName';
            $alias[11] ='user_email';
            $alias[12] ='user_biography';
            $alias[13] ='user_score';
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $commercial_id = $curso["commercial_id"];
            $commercial_name = $curso["commercial_name"];
            $commercial_logo = $curso["commercial_logo"];
            $commercial_tin = $curso["commercial_tin"];
            $user_id = $curso["user_id"];
            $user_profilePhoto = $curso["user_profilePhoto"];
            $user_name = $curso["user_name"];
            $user_firstGivenName = $curso["user_firstGivenName"];
            $user_secondGivenName = $curso["user_secondGivenName"];
            $user_firstFamilyName = $curso["user_firstFamilyName"];
            $user_secondFamilyName = $curso["user_secondFamilyName"];
            $user_email = $curso["user_email"];
            $user_biography = $curso["user_biography"];
            $user_score = $curso["user_score"];
            
            $driverData[$i] = array(
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_logo' => $commercial_logo,
                'commercial_tin' => $commercial_tin,
                'user_id' => $user_id,
                'user_profilePhoto' => $user_profilePhoto,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'user_score' => $user_score,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $commercial_id = 0;
            $commercial_name = "";
            $commercial_logo = "";
            $commercial_tin = 0;
            $user_id = 0;
            $user_profilePhoto = "";
            $user_name = "";
            $user_firstGivenName = "";
            $user_secondGivenName = "";
            $user_firstFamilyName = "";
            $user_secondFamilyName = "";
            $user_email = "";
            $user_biography = "";
            $user_score = 0;
            
            $driverData[] = array(
                'commercial_id' => $commercial_id,
                'commercial_name' => $commercial_name,
                'commercial_logo' => $commercial_logo,
                'commercial_tin' => $commercial_tin,
                'user_id' => $user_id,
                'user_profilePhoto' => $user_profilePhoto,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'user_score' => $user_score,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
        }
        return $driverData;
    }
    
    public function getVehicle($db2, $value)
    {
        $query2 = "
            SELECT DISTINCT 
                vehicle.vehicle_id, 
                vehicle.vehicle_plate, 
                keyword.keyword_content as vehicleType_name, 
                commercial.commercial_id, 
                commercial.commercial_name, 
                commercial.commercial_tin, 
                user.user_id, 
                user.user_profilePhoto, 
                user.user_name, 
                user.user_firstGivenName, 
                user.user_secondGivenName, 
                user.user_firstFamilyName, 
                user.user_secondFamilyName, 
                user.user_email, 
                user.user_biography, 
                user.user_score 
                
            FROM vehicleUser 
            
            INNER JOIN vehicle ON vehicle.vehicle_id = vehicleUser.vehicle_id 
            
            INNER JOIN vehicleType ON vehicle.vehicleType_id = vehicleType.vehicleType_id 
            
            INNER JOIN keywordVehicleType ON keywordVehicleType.vehicleType_id = vehicleType.vehicleType_id 
            
            INNER JOIN keyword ON keywordVehicleType.keyword_id = keyword.keyword_id 
            
            INNER JOIN commercial ON commercial.commercial_id = vehicle.user_id 
            
            INNER JOIN user ON commercial.user_id = user.user_id 

            WHERE vehicleUser.vehicleUser_id = '$value' 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $alias[0] = 'vehicle_id';
        $alias[1] = 'vehicle_plate';
        $alias[2] = 'vehicleType_name';
        $alias[3] = 'user_id';
        $alias[4] = 'user_profilePhoto';
        $alias[5] = 'user_name';
        $alias[6] = 'user_firstGivenName';
        $alias[7] = 'user_secondGivenName';
        $alias[8] = 'user_firstFamilyName';
        $alias[9] = 'user_secondFamilyName';
        $alias[10] ='user_email';
        $alias[11] ='user_biography';
        $alias[12] ='user_score';
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $vehicle_id = $curso["vehicle_id"];
            $vehicle_plate = $curso["vehicle_plate"];
            $vehicleType_name = $curso["vehicleType_name"];
            $user_id = $curso["user_id"];
            $user_profilePhoto = $curso["user_profilePhoto"];
            $user_name = $curso["user_name"];
            $user_firstGivenName = $curso["user_firstGivenName"];
            $user_secondGivenName = $curso["user_secondGivenName"];
            $user_firstFamilyName = $curso["user_firstFamilyName"];
            $user_secondFamilyName = $curso["user_secondFamilyName"];
            $user_email = $curso["user_email"];
            $user_biography = $curso["user_biography"];
            $user_score = $curso["user_score"];
            
            $vehicleData[$i] = array(
                'vehicle_id' => $vehicle_id,
                'vehicle_plate' => $vehicle_plate,
                'vehicleType_name' => $vehicleType_name,
                'user_id' => $user_id,
                'user_profilePhoto' => $user_profilePhoto,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'user_score' => $user_score,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $vehicle_id = 0;
            $vehicle_plate = "";
            $vehicleType_name = 0;
            $user_id = 0;
            $user_profilePhoto = "";
            $user_name = "";
            $user_firstGivenName = "";
            $user_secondGivenName = "";
            $user_firstFamilyName = "";
            $user_secondFamilyName = "";
            $user_email = "";
            $user_biography = "";
            $user_score = 0;
            
            $vehicleData[] = array(
                'vehicle_id' => $vehicle_id,
                'vehicle_plate' => $vehicle_plate,
                'vehicleType_name' => $vehicleType_name,
                'user_id' => $user_id,
                'user_profilePhoto' => $user_profilePhoto,
                'user_name' => $user_name,
                'user_firstGivenName' => $user_firstGivenName,
                'user_secondGivenName' => $user_secondGivenName,
                'user_firstFamilyName' => $user_firstFamilyName,
                'user_secondFamilyName' => $user_secondFamilyName,
                'user_email' => $user_email,
                'user_biography' => $user_biography,
                'user_score' => $user_score,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
        }
        return $vehicleData;
    }
    
    public function getReach($db2, $value)
    {
        $query2 = "
            SELECT DISTINCT 
                departure.location_id as departure_id, 
                departureName.keyword_content as departure_name, 
                delivery.location_id as delivery_id, 
                deliveryName.keyword_content as delivery_name 
                
            FROM reach 
            
            INNER JOIN location as departure ON reach.departure_id = departure.location_id 
            INNER JOIN keywordLocation as departure_kl ON departure_kl.location_id = departure.location_id 
            INNER JOIN keyword as departureName ON departureName.keyword_id = departure_kl.keyword_id 

            INNER JOIN location as delivery ON reach.delivery_id = delivery.location_id 
            INNER JOIN keywordLocation as delivery_kl ON delivery_kl.location_id = delivery.location_id 
            INNER JOIN keyword as deliveryName ON deliveryName.keyword_id = delivery_kl.keyword_id 
            
            WHERE reach.reach_id = '$value' 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $alias[0] = 'departure_id';
        $alias[1] = 'departure_name';
        $alias[2] = 'delivery_id';
        $alias[3] = 'delivery_name';
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $departure_id = $curso["departure_id"];
            $departure_name = $curso["departure_name"];
            $delivery_id = $curso["delivery_id"];
            $delivery_name = $curso["delivery_name"];
            
            $vehicleData[$i] = array(
                'departure_id' => $departure_id,
                'departure_name' => $departure_name,
                'delivery_id' => $delivery_id,
                'delivery_name' => $delivery_name,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
            $i++;
        }

        if ($amountRecords == 0)
        {
            $departure_id = 0;
            $departure_name = "";
            $delivery_id = 0;
            $delivery_name = "";
            
            $vehicleData[] = array(
                'departure_id' => $departure_id,
                'departure_name' => $departure_name,
                'delivery_id' => $delivery_id,
                'delivery_name' => $delivery_name,
                'alias' => $alias,
                'amountRecords' => $amountRecords
            );
        }
        return $vehicleData;
    }
}

//            $alias[0] = '';
//            $alias[1] = '';
//            $alias[2] = '';
//            $alias[3] = '';
//            $alias[4] = '';
//            $alias[5] = '';
//            $alias[6] = '';
//            $alias[7] = '';
//            $alias[8] = '';
//            $alias[9] = '';
//            $alias[10] ='';
//            $alias[11] ='';
//            $alias[12] ='';