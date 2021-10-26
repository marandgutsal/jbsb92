<?php

namespace ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ShippingListController extends Controller
{
    public function getShippingCondition($topic_array)
    {
        $cbdhxsj = "";

        $i_top = 0;
        while (isset($topic_array[$i_top][0][0]))
        {
            $j = 0;
            while (isset($topic_array[$i_top][$j][0]) && isset($topic_array[$i_top][$j][1]))
            {
                if ($j==0)
                {
                $cbdhxsj .= "
                    WHERE 
                    ";
                } else
                {
                $cbdhxsj .= "
                    or 
                    ";
                }
                
                $record = $topic_array[$i_top][$j][0];
                $column = $topic_array[$i_top][$j][1];
   
if ($column == 1)
{
//    driver.user_email
$cbdhxsj .= " outsourcing_shippingCompany.commercial_id = '$record' ";
}

if ($column == 2)
{
//    driver.user_id
$cbdhxsj .= " outsourcing_shippingCompany.commercial_name = '$record' ";
}

if ($column == 3)
{
//    commercial.commercial_id
$cbdhxsj .= " outsourcing_shippingCompany.commercial_tin = '$record' ";
}

if ($column == 4)
{
//    commercial.commercial_name
//    driverUser.driver_id = '$driverId' 
$cbdhxsj .= " driver.user_id = '$record' ";
}

if ($column == 5)
{
//    commercial.commercial_tin
$cbdhxsj .= " driver.user_name = '$record' ";
}

if ($column == 6)
{
$cbdhxsj .= " driver.user_email = '$record' ";
}

if ($column == 7)
{
$cbdhxsj .= " commercialDriver.commercial_id = '$record' ";
}

if ($column == 8)
{
$cbdhxsj .= " commercialDriver.commercial_name = '$record' ";
}

if ($column == 9)
{
$cbdhxsj .= " commercialDriver.commercial_tin = '$record' ";
}

if ($column == 10)
{
$cbdhxsj .= " outsourcing_employmentAgency.commercial_id = '$record' ";
}

if ($column == 11)
{
$cbdhxsj .= " outsourcing_employmentAgency.commercial_name = '$record' ";
}

if ($column == 12)
{
$cbdhxsj .= " outsourcing_employmentAgency.commercial_tin = '$record' ";
}

if ($column == 13)
{
$cbdhxsj .= " owner.user_id = '$record' ";
}

if ($column == 14)
{
$cbdhxsj .= " vehicle.vehicle_plate = '$record' ";
}

if ($column == 15)
{
$cbdhxsj .= " keyword.keyword_content = '$record' ";
}

if ($column == 16)
{
$cbdhxsj .= " outsourcing_vehicleRentalCompany.commercial_id = '$record' ";
}

if ($column == 17)
{
$cbdhxsj .= " outsourcing_vehicleRentalCompany.commercial_name = '$record' ";
}

if ($column == 18)
{
$cbdhxsj .= " outsourcing_vehicleRentalCompany.commercial_tin = '$record' ";
}

if ($column == 19)
{
$cbdhxsj .= " departure.location_id = '$record' ";
}

if ($column == 20)
{
$cbdhxsj .= " departure.location_name = '$record' ";
}

if ($column == 21)
{
$cbdhxsj .= " delivery.location_id = '$record' ";
}

if ($column == 22)
{
$cbdhxsj .= " delivery.location_name = '$record' ";
}

                $j++;
            }
            $i_top++;
        }
        
        return $cbdhxsj;
    }
    
    public function getShippingListAction(Request $request)
    {
        $topic_array = $_POST['topic_array'];
        
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
$em = $this->getDoctrine()->getManager();
            
$shipping_usertype_1 = $this->get('app.usertype');
$shipping_userType_id = $shipping_usertype_1->isValid($em, "shipping");

$commercial_1 = $this->get('app.commercial');
$loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $shipping_userType_id);
$userLogged_commercial_id = $loggedUser_commercial_array[0]["commercial_id"];
            
if ($topic_array == 0)
{
    $cbdhxsj = "
            WHERE outsourcing_shippingCompany.commercial_id = '$userLogged_commercial_id' 
            ";
} else
{
    $cbdhxsj = $this->getShippingCondition($topic_array);
}

            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                shippingUser.shippingUser_id, 
                shipping.shipping_id, 
                driver.user_id as driver_id, 
                driver.user_name as driver_name, 
                driver.user_firstGivenName as driver_firstGivenName, 
                driver.user_secondGivenName as driver_secondGivenName, 
                driver.user_firstFamilyName as driver_firstFamilyName, 
                driver.user_secondFamilyName as driver_secondFamilyName, 
                driver.user_email as driver_email, 
                vehicle.vehicle_id, 
                vehicle.vehicle_plate, 
                vehicleType.vehicleType_id, 
                keyword.keyword_content as vehicleType_name, 
                reach.reach_id, 
                departure.location_id as departure_id, 
                departure.location_name as departure_name, 
                delivery.location_id as delivery_id, 
                delivery.location_name as delivery_name 
                
                FROM shipping 
                
                
                
                INNER JOIN driverUser ON driverUser.driverUser_id = shipping.driver_id 
                INNER JOIN commercial as commercialDriver ON commercialDriver.commercial_id = driverUser.driver_id 
                INNER JOIN User as driver ON driver.user_id = commercialDriver.user_id 
                
                
                
                INNER JOIN vehicleUser ON vehicleUser.vehicleUser_id = shipping.vehicle_id 
                INNER JOIN vehicle ON vehicle.vehicle_id = vehicleUser.vehicle_id 
                INNER JOIN commercial as owner ON owner.commercial_id = vehicle.user_id 
                
                
                
                
                INNER JOIN vehicleType ON vehicle.vehicleType_id = vehicleType.vehicleType_id 
                INNER JOIN keywordVehicleType ON keywordVehicleType.vehicleType_id = vehicleType.vehicleType_id 
                INNER JOIN keyword ON keyword.keyword_id = keywordVehicleType.keyword_id 
                
                INNER JOIN reach ON reach.reach_id = shipping.reach_id 
                
                INNER JOIN location as departure ON departure.location_id = reach.departure_id 
                INNER JOIN location as delivery ON delivery.location_id = reach.delivery_id 
                
                INNER JOIN shippingUser ON shippingUser.shipping_id = shipping.shipping_id 
                INNER JOIN commercial as outsourcing_shippingCompany ON outsourcing_shippingCompany.commercial_id = shippingUser.user_id 
                
                INNER JOIN commercial as outsourcing_employmentAgency ON outsourcing_employmentAgency.commercial_id = driverUser.user_id 
                
                INNER JOIN commercial as outsourcing_vehicleRentalCompany ON outsourcing_vehicleRentalCompany.commercial_id = vehicleUser.user_id 
                    
                $cbdhxsj 
                    
                GROUP BY shippingUser.shippingUser_id 
                ORDER BY shippingUser.shippingUser_id ASC 
            ";
            
//            WHERE outsourcing_employmentAgency.commercial_id = '$userLogged_commercial_id' 
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $shippingUser_id = $curso["shippingUser_id"];
                $shipping_id = $curso["shipping_id"];
                $driver_id = $curso["driver_id"];
                $driver_name = $curso["driver_name"];
                $driver_firstGivenName = $curso["driver_firstGivenName"];
                $driver_secondGivenName = $curso["driver_secondGivenName"];
                $driver_firstFamilyName = $curso["driver_firstFamilyName"];
                $driver_secondFamilyName = $curso["driver_secondFamilyName"];
                $driver_email = $curso["driver_email"];
                $vehicle_id = $curso["vehicle_id"];
                $vehicle_plate = $curso["vehicle_plate"];
                $vehicleType_id = $curso["vehicleType_id"];
                $vehicleType_name = $curso["vehicleType_name"];
                $reach_id = $curso["reach_id"];
                $departure_id = $curso["departure_id"];
                $departure_name = $curso["departure_name"];
                $delivery_id = $curso["delivery_id"];
                $delivery_name = $curso["delivery_name"];
                
                $locationData[$i] = array(
                    'shippingUser_id' => $shippingUser_id,
                    'shipping_id' => $shipping_id,
                    'driver_id' => $driver_id,
                    'driver_name' => $driver_name,
                    'driver_firstGivenName' => $driver_firstGivenName,
                    'driver_secondGivenName' => $driver_secondGivenName,
                    'driver_firstFamilyName' => $driver_firstFamilyName,
                    'driver_secondFamilyName' => $driver_secondFamilyName,
                    'driver_email' => $driver_email,
                    'vehicle_id' => $vehicle_id,
                    'vehicle_plate' => $vehicle_plate,
                    'vehicleType_id' => $vehicleType_id,
                    'vehicleType_name' => $vehicleType_name,
                    'reach_id' => $reach_id,
                    'departure_id' => $departure_id,
                    'departure_name' => $departure_name,
                    'delivery_id' => $delivery_id,
                    'delivery_name' => $delivery_name,
                    'amountRecords' => $amountRecords,
                    'query_condition' => $cbdhxsj
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'shippingUser_id' => 0,
                    'shipping_id' => 0,
                    'driver_id' => 0,
                    'driver_name' => "_",
                    'driver_firstGivenName' => "_",
                    'driver_secondGivenName' => "_",
                    'driver_firstFamilyName' => "_",
                    'driver_secondFamilyName' => "_",
                    'driver_email' => "_",
                    'vehicle_id' => 0,
                    'vehicle_plate' => "_",
                    'vehicleType_id' => 0,
                    'vehicleType_name' => "_",
                    'reach_id' => 0,
                    'departure_id' => 0,
                    'departure_name' => "_",
                    'delivery_id' => 0,
                    'delivery_name' => "_",
                    'amountRecords' => 0,
                    'query_condition' => $cbdhxsj
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getVehicleListAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
$outsourcing_usertype_1 = $this->get('app.usertype');
$vehicle_userType_id = $outsourcing_usertype_1->isValid($em, "vehicle");

$commercial_1 = $this->get('app.commercial');
$loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $vehicle_userType_id);
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                vehicleUser.vehicleUser_id, 
                vehicle.vehicle_id, 
                vehicle.vehicle_plate, 
                vehicleType.vehicleType_id, 
                keyword.keyword_content as vehicleType_name 
                
                FROM vehicle 
                
                INNER JOIN vehicleType ON vehicle.vehicleType_id = vehicleType.vehicleType_id 
                INNER JOIN keywordVehicleType ON keywordVehicleType.vehicleType_id = vehicleType.vehicleType_id 
                INNER JOIN keyword ON keyword.keyword_id = keywordVehicleType.keyword_id 
                
                INNER JOIN vehicleUser ON vehicleUser.vehicle_id = vehicle.vehicle_id 
                
                INNER JOIN commercial ON commercial.commercial_id = vehicleUser.user_id 
                
                
                INNER JOIN commercial as vehiclesCompanyCommercial ON vehiclesCompanyCommercial.commercial_id = vehicleUser.user_id 
                
                WHERE vehiclesCompanyCommercial.user_id = '$log_userId' 
                and vehiclesCompanyCommercial.userType_id = '$vehicle_userType_id' 
                
                ORDER BY vehicleUser.vehicleUser_id ASC 
            ";
            
            
            
//                WHERE outsourcingCommercial.user_id = '$log_userId' 
//                and outsourcingCommercial.userType_id = '$driver_userType_id' 
//                    
//                ORDER BY driverUser.driverUser_id ASC

            
            
            
            
            
            
            

            
//            SELECT DISTINCT 
//                driverUser.driverUser_id, 
//                commercial.commercial_id, 
//                commercial.commercial_name, 
//                commercial.commercial_tin, 
//                driver.user_id as driver_id, 
//                driver.user_name as driver_name, 
//                driver.user_firstGivenName as driver_firstGivenName, 
//                driver.user_secondGivenName as driver_secondGivenName, 
//                driver.user_firstFamilyName as driver_firstFamilyName, 
//                driver.user_secondFamilyName as driver_secondFamilyName, 
//                driver.user_email as driver_email 
//                
//                FROM driverUser 
//                
//                INNER JOIN commercial ON commercial.commercial_id = driverUser.driver_id 
//                
//                INNER JOIN user as driver ON driver.user_id = commercial.user_id 
//                
//                
//                INNER JOIN userType ON userType.userType_id = commercial.userType_id 
//                
//                INNER JOIN commercial as outsourcingCommercial ON outsourcingCommercial.commercial_id = driverUser.user_id 
//                
//                
//                
//                WHERE outsourcingCommercial.user_id = '$log_userId' 
//                and outsourcingCommercial.userType_id = '$driver_userType_id' 
//                    
//                ORDER BY driverUser.driverUser_id ASC
            
            
            
            
//                WHERE vehicleUser.user_id = '44' 

            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $vehicleUser_id = $curso["vehicleUser_id"];
                $vehicle_id = $curso["vehicle_id"];
                $vehicle_plate = $curso["vehicle_plate"];
                $vehicleType_id = $curso["vehicleType_id"];
                $vehicleType_name = $curso["vehicleType_name"];
                
                $locationData[$i] = array(
                    'vehicleUser_id' => $vehicleUser_id,
                    'vehicle_id' => $vehicle_id,
                    'vehicle_plate' => $vehicle_plate,
                    'vehicleType_id' => $vehicleType_id,
                    'vehicleType_name' => $vehicleType_name,
                    'amountRecords' => $amountRecords
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'vehicleUser_id' => 0,
                    'vehicle_id' => 0,
                    'vehicle_plate' => "",
                    'vehicleType_id' => 0,
                    'vehicleType_name' => "",
                    'amountRecords' => 0
                );
            }
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getDriverListAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();

$outsourcing_usertype_1 = $this->get('app.usertype');
$driver_userType_id = $outsourcing_usertype_1->isValid($em, "driver");

$commercial_1 = $this->get('app.commercial');
$loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $driver_userType_id);

            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                driverUser.driverUser_id, 
                commercial.commercial_id, 
                commercial.commercial_name, 
                commercial.commercial_tin, 
                driver.user_id as driver_id, 
                driver.user_name as driver_name, 
                driver.user_firstGivenName as driver_firstGivenName, 
                driver.user_secondGivenName as driver_secondGivenName, 
                driver.user_firstFamilyName as driver_firstFamilyName, 
                driver.user_secondFamilyName as driver_secondFamilyName, 
                driver.user_email as driver_email 
                
                FROM driverUser 
                
                INNER JOIN commercial ON commercial.commercial_id = driverUser.driver_id 
                
                INNER JOIN user as driver ON driver.user_id = commercial.user_id 
                
                
                INNER JOIN userType ON userType.userType_id = commercial.userType_id 
                
                INNER JOIN commercial as outsourcingCommercial ON outsourcingCommercial.commercial_id = driverUser.user_id 
                
                WHERE outsourcingCommercial.user_id = '$log_userId' 
                and outsourcingCommercial.userType_id = '$driver_userType_id' 
                    
                ORDER BY driverUser.driverUser_id ASC
            ";
            
//                INNER JOIN user as login ON login.user_id = outsourcingCommercial.user_id 
            
//            and userType.userType_id = '$driver_userType_id' 
//                WHERE driverUser.user_id = '50' and userType.userType_id = '17' 
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $driverUser_id = $curso["driverUser_id"];
                $commercial_id = $curso["commercial_id"];
                $commercial_name = $curso["commercial_name"];
                $commercial_tin = $curso["commercial_tin"];
                $driver_id = $curso["driver_id"];
                $driver_name = $curso["driver_name"];
                $driver_firstGivenName = $curso["driver_firstGivenName"];
                $driver_secondGivenName = $curso["driver_secondGivenName"];
                $driver_firstFamilyName = $curso["driver_firstFamilyName"];
                $driver_secondFamilyName = $curso["driver_secondFamilyName"];
                $driver_email = $curso["driver_email"];
                
                $locationData[$i] = array(
                    'driverUser_id' => $driverUser_id,
                    'commercial_id' => $commercial_id,
                    'commercial_name' => $commercial_name,
                    'commercial_tin' => $commercial_tin,
                    'driver_id' => $driver_id,
                    'driver_name' => $driver_name,
                    'driver_firstGivenName' => $driver_firstGivenName,
                    'driver_secondGivenName' => $driver_secondGivenName,
                    'driver_firstFamilyName' => $driver_firstFamilyName,
                    'driver_secondFamilyName' => $driver_secondFamilyName,
                    'driver_email' => $driver_email,
                    'amountRecords' => $amountRecords
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'driverUser_id' => 0,
                    'commercial_id' => 0,
                    'commercial_name' => "",
                    'commercial_tin' => 0,
                    'driver_id' => 0,
                    'driver_name' => "",
                    'driver_firstGivenName' => "",
                    'driver_secondGivenName' => "",
                    'driver_firstFamilyName' => "",
                    'driver_secondFamilyName' => "",
                    'driver_email' => "",
                    'amountRecords' => 0
                );
            }
            
//            $em = $this->getDoctrine()->getManager();
//            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => "-",
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getDriverAction(Request $request)
    {
        $topic_array = $_POST['topic_array'];
        
        if ($request->isXMLHttpRequest()) {
    
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
        
            
            
            
            
            $cbdhxsj = "";
            
            $i_top = 0;
            while (isset($topic_array[$i_top][0][0]))
            {
                $j = 0;
                while (isset($topic_array[$i_top][$j][0]) && isset($topic_array[$i_top][$j][1]))
                {
                    
                    if ($j==0)
                    {
                    $cbdhxsj .= "
                        WHERE 
                        ";
                    } else
                    {
                    $cbdhxsj .= "
                        or 
                        ";
                    }

                    
                    
                    
                    
                    $record = $topic_array[$i_top][$j][0];
                    $column = $topic_array[$i_top][$j][1];
                    
                    
                    
                    
                    

if ($column == 0)
{
    $cbdhxsj .= " driver.user_name = '$record' ";
}

if ($column == 1)
{
    $cbdhxsj .= " driver.user_email = '$record' ";
}

if ($column == 2)
{
    $cbdhxsj .= " driver.user_id = '$record' ";
}

if ($column == 3)
{
    $cbdhxsj .= " commercial.commercial_id = '$record' ";
}

if ($column == 4)
{
    $cbdhxsj .= " commercial.commercial_name = '$record' ";
}

if ($column == 5)
{
    $cbdhxsj .= " commercial.commercial_tin = '$record' ";
}

                    
                    
                    
                    $j++;
                }
                
                
                $i_top++;
            }
            
            
            
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                driverUser.driverUser_id, 
                commercial.commercial_id, 
                commercial.commercial_name, 
                commercial.commercial_tin, 
                driver.user_id as driver_id, 
                driver.user_name as driver_name, 
                driver.user_firstGivenName as driver_firstGivenName, 
                driver.user_secondGivenName as driver_secondGivenName, 
                driver.user_firstFamilyName as driver_firstFamilyName, 
                driver.user_secondFamilyName as driver_secondFamilyName, 
                driver.user_email as driver_email 
                
                FROM driverUser 
                
                INNER JOIN commercial ON commercial.commercial_id = driverUser.driver_id 
                
                INNER JOIN user as driver ON driver.user_id = commercial.user_id 
                
                $cbdhxsj 
            ";
            
            
//            driver.user_id as driver_id, 
//            driver.user_name as driver_name, 
//            driver.user_firstGivenName as driver_firstGivenName, 
//            driver.user_secondGivenName as driver_secondGivenName, 
//            driver.user_firstFamilyName as driver_firstFamilyName, 
//            driver.user_secondFamilyName as driver_secondFamilyName, 
//            driver.user_email as driver_email 
            
            
            
            
            
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $driverUser_id = $curso["driverUser_id"];
                $commercial_id = $curso["commercial_id"];
                $commercial_name = $curso["commercial_name"];
                $commercial_tin = $curso["commercial_tin"];
                
                $driver_id = $curso["driver_id"];
                $driver_name = $curso["driver_name"];
                $driver_firstGivenName = $curso["driver_firstGivenName"];
                $driver_secondGivenName = $curso["driver_secondGivenName"];
                $driver_firstFamilyName = $curso["driver_firstFamilyName"];
                $driver_secondFamilyName = $curso["driver_secondFamilyName"];
                $driver_email = $curso["driver_email"];
                
                $locationData[$i] = array(
                    'driverUser_id' => $driverUser_id,
                    'commercial_id' => $commercial_id,
                    'commercial_name' => $commercial_name,
                    'commercial_tin' => $commercial_tin,
                    'driver_id' => $driver_id,
                    'driver_name' => $driver_name,
                    'driver_firstGivenName' => $driver_firstGivenName,
                    'driver_secondGivenName' => $driver_secondGivenName,
                    'driver_firstFamilyName' => $driver_firstFamilyName,
                    'driver_secondFamilyName' => $driver_secondFamilyName,
                    'driver_email' => $driver_email,
                    'amountRecords' => $amountRecords
                );
                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'driverUser_id' => 0,
                    'commercial_id' => 0,
                    'commercial_name' => "",
                    'commercial_tin' => 0,
                    'driver_id' => 0,
                    'driver_name' => $driver_name,
                    'driver_firstGivenName' => "",
                    'driver_secondGivenName' => "",
                    'driver_firstFamilyName' => "",
                    'driver_secondFamilyName' => "",
                    'driver_email' => "",
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getVehicleAction(Request $request)
    {
        $topic_array = $_POST['topic_array'];
        
        if ($request->isXMLHttpRequest()) {

            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
        
            
            $cbdhxsj = "";
            
            $i_top = 0;
            while (isset($topic_array[$i_top][0][0]))
            {
                $j = 0;
                while (isset($topic_array[$i_top][$j][0]) && isset($topic_array[$i_top][$j][1]))
                {
                    
                    if ($j==0)
                    {
                    $cbdhxsj .= "
                        WHERE 
                        ";
                    } else
                    {
                    $cbdhxsj .= "
                        or 
                        ";
                    }

                    
                    
                    
                    
                    $record = $topic_array[$i_top][$j][0];
                    $column = $topic_array[$i_top][$j][1];
                    
                    
                    
                    
                    

if ($column == 0)
{
    $cbdhxsj .= " owner.user_id = '$record' or owner.user_name = '$record' or owner.user_email = '$record' ";
}

if ($column == 1)
{
    $cbdhxsj .= " vehicle.vehicle_plate = '$record' ";
}

if ($column == 2)
{
    $cbdhxsj .= " keyword.keyword_content = '$record' ";
}

                    
                    
                    
                    $j++;
                }
                
//                $topic_1 = $this->get('app.topic');
//                $topicId_1 = $topic_1->isValid($em, $db2, $objects[$i_top], $j);
//                
//                $topics[$i_top] = $topicId_1;
                
                $i_top++;
            }
            
            
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                vehicleUser.vehicleUser_id, 
                vehicle.vehicle_id, 
                vehicle.vehicle_plate, 
                vehicleType.vehicleType_id, 
                keyword.keyword_content as vehicleType_name 
                
                FROM vehicle 
                
                INNER JOIN commercial as ownerCommercial ON ownerCommercial.commercial_id = vehicle.user_id 
                INNER JOIN user as owner ON owner.user_id = ownerCommercial.user_id 
                
                INNER JOIN vehicleType ON vehicleType.vehicleType_id = vehicle.vehicleType_id 
                INNER JOIN keywordVehicleType ON keywordVehicleType.vehicleType_id = vehicleType.vehicleType_id 
                INNER JOIN keyword ON keyword.keyword_id = keywordVehicleType.keyword_id 
                
                INNER JOIN vehicleUser ON vehicleUser.vehicle_id = vehicle.vehicle_id 

                $cbdhxsj 
            ";

//            WHERE keyword.keyword_content = 'dfghj' 
//          WHERE driverUser.user_id = '$userId' 
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $vehicleUser_id = $curso["vehicleUser_id"];
                $vehicle_id = $curso["vehicle_id"];
                $vehicle_plate = $curso["vehicle_plate"];
                $vehicleType_id = $curso["vehicleType_id"];
                $vehicleType_name = $curso["vehicleType_name"];
                
                $locationData[$i] = array(
                    'vehicleUser_id' => $vehicleUser_id,
                    'vehicle_id' => $vehicle_id,
                    'vehicle_plate' => $vehicle_plate,
                    'vehicleType_id' => $vehicleType_id,
                    'vehicleType_name' => $vehicleType_name,
                    'amountRecords' => $amountRecords
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'vehicleUser_id' => 0,
                    'vehicle_id' => 0,
                    'vehicle_plate' => "",
                    'vehicleType_id' => 0,
                    'vehicleType_name' => "",
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    public function setNewDriverAction(Request $request)
    {
        $user_id = $_POST['user_id'];
        $new_commercial_id = $_POST['commercial_id'];
        $new_commercial_name = $_POST['commercial_name'];
        $new_commercial_tin = $_POST['commercial_tin'];
        $new_commercial_action = $_POST['commercial_action'];
        
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            $userType_class = "driver";
            $usertype_1 = $this->get('app.usertype');
            $userType_id = $usertype_1->isValid($em, $userType_class);
                    
            $user_1 = $this->get('app.user');
            $user_array = $user_1->checkUser_2($db2, $user_id);
            
            if ($new_commercial_action == "new")
            {
                $commercial_1 = $this->get('app.commercial');
                $driver_commercial_array = $commercial_1->checkCommercial($db2, 
                        $user_id, 
                        $new_commercial_name, $new_commercial_tin, $userType_id);
                
                $driver_commercial_id = $driver_commercial_array[0]["commercial_id"];
            } else if ($new_commercial_action == "existent")
            {
                $driver_commercial_id = $new_commercial_id;
            }
            
            
            $outsourcing_usertype_1 = $this->get('app.usertype');
            $driver_userType_id = $outsourcing_usertype_1->isValid($em, "driver");
            
            $commercial_1 = $this->get('app.commercial');
            $loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $driver_userType_id);
            $userLogged_commercial_id = $loggedUser_commercial_array[0]["commercial_id"];
            
            $driveruser_1 = $this->get('app.driveruser');
            $driveruser_id = $driveruser_1->checkDriverUser($db2, $userLogged_commercial_id, $driver_commercial_id);
            
            $locationData[] = array(
                'new_driverUserId' => $driveruser_id,
                'driver_commercial_array' => $driver_commercial_array,
                'user_array' => $user_array,
                'loggedUser_commercial_array' => $loggedUser_commercial_array
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function setNewVehicleAction(Request $request)
    {
        $user_id = $_POST['select_ownerVehicle'];
        $vehicle_plate = $_POST['vehicle_plate'];
        $vehicle_type = $_POST['vehicle_type'];
        
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            if ($log_userId == $user_id)
            {
                
                
                
                
                
$vehicleOwner_usertype_1 = $this->get('app.usertype');
$vehicleOwner_userType_id = $vehicleOwner_usertype_1->isValid($em, "vehicleOwner");

$commercial_vehicleOwner_1 = $this->get('app.commercial');
$loggedUser_vehicleOwner_array = $commercial_vehicleOwner_1->check_commercial_userLogged($db2, $log_userId, $vehicleOwner_userType_id);
$userLogged_vehicleOwner_id = $loggedUser_vehicleOwner_array[0]["commercial_id"];
                
                
            
                
                
            
            $keyword_1 = $this->get('app.keyword');
            $keywordId_1 = $keyword_1->isValid($em, $vehicle_type);
                
            $vehicleType_1 = $this->get('app.vehicletype');
            $vehicleType_id1 = $vehicleType_1->checkVehicleType($db2, $keywordId_1);
            
            $vehicle_1 = $this->get('app.vehicle');
            $vehicle_id1 = $vehicle_1->checkVehicle($db2, $userLogged_vehicleOwner_id, $vehicle_plate, $vehicleType_id1);
            
            
            
            
            
            
            
            
            
            
            
$vehicle_usertype_1 = $this->get('app.usertype');
$vehicle_userType_id = $vehicle_usertype_1->isValid($em, "vehicle");

$commercial_1 = $this->get('app.commercial');
$loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $vehicle_userType_id);
$userLogged_commercial_id = $loggedUser_commercial_array[0]["commercial_id"];
            
            
            $vehicleUser_1 = $this->get('app.vehicleuser');
            $vehicleUser_id1 = $vehicleUser_1->checkVehicleUser($db2, $userLogged_commercial_id, $vehicle_id1);
            
            
            $locationData[] = array(
                'vehicleUser_id' => $vehicleUser_id1,
                'vehicle_id' => $vehicle_id1,
                'vehicle_plate' => $vehicle_plate,
                'vehicleType_id' => $vehicleType_id1,
                'vehicleType_name' => $vehicle_type
            );
            
            } else
            {
                $locationData[] = array(
                    'vehicleUser_id' => "_",
                    'vehicle_id' => "_",
                    'vehicle_plate' => "_",
                    'vehicleType_id' => "_",
                    'vehicleType_name' => "_"
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    public function setNewShippingAction(Request $request)
    {
        $driver_id = $_POST['driver_id'];
        $vehicle_id = $_POST['vehicle_id'];
        $origin_id = $_POST['origin_id'];
        $destiny_id = $_POST['destiny_id'];
        
        if (isset($_SESSION['loginSession'])) {
            $log_userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $matchnodes_1 = $this->get('app.matchnodes');
            $nodes = $matchnodes_1->isValid($db2, $origin_id, $destiny_id);
            
            $origin = $nodes[0];
            $destiny = $nodes[1];
            
            $reach_1 = $this->get('app.reach');
            $reach_id = $reach_1->isValid($db2, $origin, $destiny);
            
            $shipping_1 = $this->get('app.shipping');
            $shipping_id = $shipping_1->checkShipping($db2, $reach_id, $driver_id, $vehicle_id);
            
            
            
            
            
$shipping_usertype_1 = $this->get('app.usertype');
$shipping_userType_id = $shipping_usertype_1->isValid($em, "shipping");
            
$commercial_1 = $this->get('app.commercial');
$loggedUser_commercial_array = $commercial_1->check_commercial_userLogged($db2, $log_userId, $shipping_userType_id);
$userLogged_commercial_id = $loggedUser_commercial_array[0]["commercial_id"];

            
            
            
            $shippingUser_1 = $this->get('app.shippinguser');
            $shippingUser_id = $shippingUser_1->checkShippingUser($db2, $shipping_id, $userLogged_commercial_id);
            
            
            
            
            
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function searchOwnerVehicleAction(Request $request)
    {
//        ownerVehicle_user_name : ownerVehicle_user_name, 
//        ownerVehicle_user_id : ownerVehicle_user_id, 
//        ownerVehicle_user_email : ownerVehicle_user_email
        
        $ownerVehicle_user_name = $_POST['ownerVehicle_user_name'];
        $ownerVehicle_user_id = $_POST['ownerVehicle_user_id'];
        $ownerVehicle_user_email = $_POST['ownerVehicle_user_email'];

        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $user_1 = $this->get('app.user');
            $user_id1 = $user_1->checkUser($db2, $ownerVehicle_user_id, $ownerVehicle_user_name, $ownerVehicle_user_email);
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => "-",
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($user_id1), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function searchUserDriverAction(Request $request)
    {
//        userDriver_user_name: userDriver_user_name,
//        userDriver_user_email: userDriver_user_email,
//        userDriver_user_id: userDriver_user_id
                
        $userDriver_user_name = $_POST['userDriver_user_name'];
        $userDriver_user_email = $_POST['userDriver_user_email'];
        $userDriver_user_id = $_POST['userDriver_user_id'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $user_1 = $this->get('app.user');
            $user_id1 = $user_1->checkUser($db2, $userDriver_user_id, $userDriver_user_name, $userDriver_user_email);
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => "-",
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($user_id1), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function searchUserDriverCommercialAction(Request $request)
    {
        $user_id = $_POST['user_id'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $user_1 = $this->get('app.commercial');
            $user_id1 = $user_1->checkCommercial_byUserId($db2, $user_id);
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => "-",
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($user_id1), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSaleDetailShipmentAction(Request $request)
    {
        $shipment_id = $_POST['shipment_id'];
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $trajectory_1 = $this->get('app.trajectory');
            $trajectory_results = $trajectory_1->getTrajectory($db2, $shipment_id);
            return new Response(json_encode($trajectory_results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSupplierDataAction(Request $request)
    {
        $supplier_id = $_POST['supplier_id'];
        if ($request->isXMLHttpRequest()) {

            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $supplier_1 = $this->get('app.supplier');
            $supplier_results = $supplier_1->getSupplier($db2, $supplier_id);
            
            return new Response(json_encode($supplier_results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSupplyingDataAction(Request $request)
    {
        $supplying_id = $_POST['supplying_id'];
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $supplying_1 = $this->get('app.supplying');
            $supplying_results = $supplying_1->getSupplying($db2, $supplying_id);
            
            return new Response(json_encode($supplying_results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getItemDataAction(Request $request)
    {
        $label = $_POST['label'];
        $value = $_POST['value'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            if ($label == "location_id")
            {
                $location_1 = $this->get('app.trajectory');
                $item_results = $location_1->getLocation($db2, $value);
            }
            
            ////////////////////////////////////////////////////////////////////////
            
            if ($label == "driverUser_id")
            {
                $driver_1 = $this->get('app.trajectory');
                $item_results = $driver_1->getDriver($db2, $value);
            }
            
            if ($label == "vehicleUser_id")
            {
                $vehicle_1 = $this->get('app.trajectory');
                $item_results = $vehicle_1->getVehicle($db2, $value);
            }
            
            if ($label == "reach_id")
            {
                $reach_1 = $this->get('app.trajectory');
                $item_results = $reach_1->getReach($db2, $value);
            }
            
            return new Response(json_encode($item_results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getShipmentFromSaleDetailAction(Request $request)
    {
        $sale_detailId = $_POST['sale_detailId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

            $checker_1 = $this->get('app.saledetail');
            $saleDetail = $checker_1->getShipmentFromSaledetail($db2, $sale_detailId);
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => "-",
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($saleDetail), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getReachFromSaleDetailAction(Request $request)
    {
        $sale_detailId = $_POST['sale_detailId'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

            $checker_1 = $this->get('app.saledetail');
            $saleDetail = $checker_1->getReachFromSaledetail($db2, $sale_detailId);
            
            ////////////////////////////////////////////////////////////////////////
            
//            $sendata[$i] = array(
//                'reach_id' => $curso["reach_id"],
//                'departure_id' => $curso["departure_id"],
//                'delivery_id' => $curso["delivery_id"],
//                'amountRecords' => $amountRecords
//            );
            
            ////////////////////////////////////////////////////////////////////////
            
            $origin_id = $saleDetail[0]["departure_id"];
            $destiny_id = $saleDetail[0]["delivery_id"];
            
            $matchnodes_1 = $this->get('app.matchnodes');
            $nodes = $matchnodes_1->isValid($db2, $origin_id, $destiny_id);
            
            $origin = $nodes[0];
            $destiny = $nodes[1];
            
            $saleDetail_2[] = array(
                'origin' => $origin,
                'destiny' => $destiny
            );
            
            return new Response(json_encode($saleDetail_2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function matchNodesTasterAction(Request $request)
    {
        $origin_id = $_POST['origin_id'];
        $destiny_id = $_POST['destiny_id'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $matchnodes_1 = $this->get('app.matchnodes');
            $nodes = $matchnodes_1->isValid($db2, $origin_id, $destiny_id);
            
            $origin = $nodes[0];
            $destiny = $nodes[1];
            $i = $nodes[2];
            $j = $nodes[3];
            $reach = $nodes[4];
            $l_11 = $nodes[5];
            $l_22 = $nodes[6];
            
//        $cbdjk[0] = $node_origin;
//        $cbdjk[1] = $node_destiny;
//        $cbdjk[2] = $i;
//        $cbdjk[3] = $j;
//        $cbdjk[4] = $reach;
//        $cbdjk[5] = $l_11;
//        $cbdjk[6] = $l_22;
        
            $locationData[] = array(
                'origin' => $origin,
                'destiny' => $destiny,
                'i' => $i,
                'j' => $j,
                'reach' => $reach,
                'l_11' => $l_11,
                'l_22' => $l_22
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function assignRouteAction(Request $request)
    {
        $price = $_POST['price'];
        
        $departure = $_POST['departure'];
        $delivery = $_POST['delivery'];
        
//            $departure = 16;
//            $delivery = 22;
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $reach_1_nodes_1 = $this->get('app.reach_1_nodes');
            
            $location_position = 0;
            $location_parenthjk[0] = 0;
            $delivery_parent = $reach_1_nodes_1->getParent($db2, $delivery, $location_position, $location_parenthjk);
            $departure_parent = $reach_1_nodes_1->getParent($db2, $departure, $location_position, $location_parenthjk);
            
//            $bhfd[0] = "1";
//            $bhfd[1] = "1";
//            $bhfd[2] = "1";
//            $bhfd[3] = "1";
//            $bhfd[4] = "1";
            
            $delivery_size = sizeof($delivery_parent);
            $departure_size = sizeof($departure_parent);
            
            $locationData = $reach_1_nodes_1->getShipping_nodes($db2, $price, $departure, $delivery, $departure_size, $delivery_size, $departure_parent, $delivery_parent);
            
            
            
//            $matchnodes_1 = $this->get('app.matchnodes');
//            $nodes = $matchnodes_1->isValid($db2, $departure, $delivery);
//            
//            $origin = $nodes[0];
//            $destiny = $nodes[1];
            
            
            
//            $amountRecords = $locationData[14];
//            if ($amountRecords == 0)
//            {
//                
//                $reach_1_nodes_1->getShipping_nodes($db2, $price, $departure_parent, $delivery_parent);
//            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function updateShippingFoundingAction(Request $request)
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
    
    public function assignRoute_2Action(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                shipping.shipping_id as shipping_1_id, 
                reach.reach_id as reach_1_id, 
                location_origin.location_id as departure_id, 
                location_origin.location_name as departure_name, 
                location_destiny.location_id as delivery_id, 
                location_destiny.location_name as delivery_name, 
                shipping_2.shipping_id as shipping_2_id, 
                reach_2.reach_id as reach_2_id 

                FROM shipping 
                
                INNER JOIN reach ON reach.reach_id = shipping.reach_id 
                
                INNER JOIN branch as branch_origin ON branch_origin.branch_id = reach.departure_id 
                INNER JOIN location as location_origin ON location_origin.location_id = branch_origin.location_id 
                
                INNER JOIN branch as branch_destiny ON branch_destiny.branch_id = reach.delivery_id 
                INNER JOIN location as location_destiny ON location_destiny.location_id = branch_destiny.location_id 
                
                INNER JOIN reach as reach_2 ON reach_2.departure_id = reach.delivery_id 
                INNER JOIN shipping as shipping_2 ON shipping_2.reach_id = reach_2.reach_id 
                
                GROUP BY shipping.shipping_id 
                ORDER BY shipping.shipping_id ASC 
            ";
            
//                WHERE reach_2.delivery_id = '0' 
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $shipping_1_id = $curso["shipping_1_id"];
                $reach_1_id = $curso["reach_1_id"];
                $departure_id = $curso["departure_id"];
                $departure_name = $curso["departure_name"];
                $delivery_id = $curso["delivery_id"];
                $delivery_name = $curso["delivery_name"];
                $shipping_2_id = $curso["shipping_2_id"];
                $reach_2_id = $curso["reach_2_id"];
                
                $locationData[$i] = array(
                    'shipping_1_id' => $shipping_1_id,
                    'reach_1_id' => $reach_1_id,
                    'departure_id' => $departure_id,
                    'departure_name' => $departure_name,
                    'delivery_id' => $delivery_id,
                    'delivery_name' => $delivery_name,
                    'shipping_2_id' => $shipping_2_id,
                    'reach_2_id' => $reach_2_id,
                    'amountRecords' => $amountRecords
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'shipping_1_id' => 0,
                    'reach_1_id' => 0,
                    'departure_id' => 0,
                    'departure_name' => "_",
                    'delivery_id' => 0,
                    'delivery_name' => "_",
                    'shipping_2_id' => 0,
                    'reach_2_id' => 0,
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function assignRoute_1Action(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                shipping.shipping_id, 
                reach.reach_id, 
                location_origin.location_id as departure_id, 
                location_origin.location_name as departure_name, 
                location_destiny.location_id as delivery_id, 
                location_destiny.location_name as delivery_name 
                
                FROM shipping 
                
                INNER JOIN reach ON reach.reach_id = shipping.reach_id 
                
                INNER JOIN branch as branch_origin ON branch_origin.branch_id = reach.departure_id 
                INNER JOIN location as location_origin ON location_origin.location_id = branch_origin.location_id 
                
                INNER JOIN branch as branch_destiny ON branch_destiny.branch_id = reach.delivery_id 
                INNER JOIN location as location_destiny ON location_destiny.location_id = branch_destiny.location_id 
                
                GROUP BY shipping.shipping_id 
                ORDER BY shipping.shipping_id ASC 
            ";
            
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $i = 0;
            foreach($cursos2 as $curso)
            {
                $shipping_id = $curso["shipping_id"];
                $reach_id = $curso["reach_id"];
                $departure_id = $curso["departure_id"];
                $departure_name = $curso["departure_name"];
                $delivery_id = $curso["delivery_id"];
                $delivery_name = $curso["delivery_name"];
                
                $locationData[$i] = array(
                    'shipping_id' => $shipping_id,
                    'reach_id' => $reach_id,
                    'departure_id' => $departure_id,
                    'departure_name' => $departure_name,
                    'delivery_id' => $delivery_id,
                    'delivery_name' => $delivery_name,
                    'amountRecords' => $amountRecords
                );

                $i++;
            }

            if ($amountRecords == 0)
            {
                $locationData[] = array(
                    'shipping_id' => 0,
                    'reach_id' => 0,
                    'departure_id' => 0,
                    'departure_name' => "_",
                    'delivery_id' => 0,
                    'delivery_name' => "_",
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function calculatePriceAction(Request $request)
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