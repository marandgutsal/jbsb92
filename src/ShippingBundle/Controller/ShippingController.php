<?php

namespace ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ShippingController extends Controller
{
    public function getShippingAction(Request $request)
    {
        $shippingUser = $_POST['shippingUser'];
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
                SELECT DISTINCT 
                    Shipment.shipment_id, 
                    SaleDetail.saleDetail_id, 
                    SaleDetail.product_id, 
                    SaleDetail.store_id, 
                    SaleDetail.saleDetail_amount, 
                    node.node_id, 
                    node.departure_date, 
                    node.delivery_date, 
                    node.agreement_date, 
                    product.product_name, 
                    product.product_description, 
                    product.product_image 
                
                FROM Shipment 
                
                INNER JOIN SaleDetail ON SaleDetail.saleDetail_id = Shipment.saleDetail_id 
                
                INNER JOIN ShippingUser ON ShippingUser.shippingUser_id = Shipment.shippingUser_id 
                
                INNER JOIN node ON node.node_id = Shipment.node_id 
                
                INNER JOIN product ON product.product_id = SaleDetail.product_id 
                
                WHERE Shipment.shippingUser_id = '$shippingUser'
            ";
//                SELECT DISTINCT 
//                    Sale_1.sale_id as sale_id_1, 
//                    Sale_1.customer_id as customer_id_1, 
//                    Sale_1.sale_date as sale_date_1, 
            
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
//                BRANCH_STORE.location_id as store_branch_location_1, 
//                BRANCH_STORE.branch_id as store_branch_id_1, 
//                BRANCH_STORE.branch_name as store_branch_name_1, 
//                BRANCH_STORE.branch_telephone as store_branch_telephone_1, 
//                BRANCH_STORE.branch_cellphone as store_branch_cellphone_1, 
//                BRANCH_STORE.branch_aditional_information as store_branch_aditional_information_1, 
//                
//                
//                COMMERCIAL_CUSTOMER.commercial_name as commercial_customer_name, 
//                COMMERCIAL_CUSTOMER.commercial_tin as commercial_customer_tin, 
//                ORIGIN.location_name as location_origin, 
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
//
//                
//                
//                COMMERCIAL_STORE.commercial_name as commercial_store_name, 
//                COMMERCIAL_STORE.commercial_tin as commercial_store_tin, 
//                DESTINY.location_name as location_destiny, 
//
//
//
//                shipment.shipment_id as shipment_id_1, 
//                shipment.shipment_id as shipment_setUpDate_1 
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
//
//
//
//
//                INNER JOIN shipment ON shipment.saledetail_id = SaleDetail_1.saleDetail_id 
//            ";
            
            
            
            
            
            
//                INNER JOIN Commercial as Customer on Customer.commercial_id = Sale_1.customer_id 
//
//                INNER JOIN branch ON branch.branch_id = SaleDetail_1.store_id 
                        
            $db2 = $em2->getConnection();
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);
            $i = 0;
            
//            node.node_id, 
//            node.departure_date, 
//            node.delivery_date, 
//            node.agreement_date 
            
            foreach($cursos2 as $curso)
            {
                $sendata[$i] = array(
                    'shipment_id' => $curso["shipment_id"],
                    'saleDetail_id' => $curso["saleDetail_id"],
                    'product_id' => $curso["product_id"],
                    'store_id' => $curso["store_id"],
                    'saleDetail_amount' => $curso["saleDetail_amount"],
                    'node_id' => $curso["node_id"],
                    'departure_date' => $curso["departure_date"],
                    'delivery_date' => $curso["delivery_date"],
                    'agreement_date' => $curso["agreement_date"],
                    'product_name' => $curso["product_name"],
                    'product_description' => $curso["product_description"],
                    'product_image' => $curso["product_image"],
                    'amountRecords' => $amountRecords
                );
                $i++;
            }
            
            if ($amountRecords == 0)
            {
                $sendata[] = array(
                    'shipment_id' => 0,
                    'saleDetail_id' => 0,
                    'product_id' => 0,
                    'store_id' => 0,
                    'saleDetail_amount' => 0,
                    'node_id' => 0,
                    'departure_date' => "",
                    'delivery_date' => "",
                    'agreement_date' => "",
                    'product_name' => "",
                    'product_description' => "",
                    'product_image' => "",
                    'amountRecords' => $amountRecords
                );
            }
            
            
//            $alias[0] = 'sale_id_1';
//            $alias[1] = 'customer_id_1';
//            $alias[2] = 'sale_date_1';
//            $alias[3] = 'sale_total_1';
//            $alias[4] = 'sale_status_1';
//            $alias[5] = 'saleDetail_id_1';
//            $alias[6] = 'product_id_1';
//            $alias[7] = 'saleDetail_amount_1';
//            $alias[8] = 'product_name_1';
//            $alias[9] = 'product_description_1';
//            $alias[10] = 'product_image_1';
//            $alias[11] = 'store_branch_location_1';
//            $alias[12] = 'store_branch_id_1';
//            $alias[13] = 'store_branch_name_1';
//            $alias[14] = 'store_branch_telephone_1';
//            $alias[15] = 'store_branch_cellphone_1';
//            $alias[16] = 'store_branch_aditional_information_1';
//            $alias[17] = 'commercial_store_name';
//            $alias[18] = 'commercial_store_tin';
//            $alias[19] = 'location_origin';
//            $alias[20] = 'customer_branch_location_1';
//            $alias[21] = 'customer_branch_id_1';
//            $alias[22] = 'customer_branch_name_1';
//            $alias[23] = 'customer_branch_telephone_1';
//            $alias[24] = 'customer_branch_cellphone_1';
//            $alias[25] = 'customer_branch_aditional_information_1';
//            $alias[26] = 'commercial_customer_name';
//            $alias[27] = 'commercial_customer_tin';
//            $alias[28] = 'location_destiny';
//            $alias[29] = 'shipment_id_1';
//            $alias[30] = 'shipment_setUpDate_1';
//            $alias[31] = 'amountRecords';
            
            
//            foreach($cursos2 as $curso)
//            {
//                $sendata[$i] = array(
//                    'sale_id_1' => $curso["sale_id_1"],
//                    'customer_id_1' => $curso["customer_id_1"],
//                    'sale_date_1' => $curso["sale_date_1"],
//                    'sale_total_1' => $curso["sale_total_1"],
//                    'sale_status_1' => $curso["sale_status_1"],
//                    'saleDetail_id_1' => $curso["saleDetail_id_1"],
//                    'product_id_1' => $curso["product_id_1"],
//                    'saleDetail_amount_1' => $curso["saleDetail_amount_1"],
//                    'product_name_1' => $curso["product_name_1"],
//                    'product_description_1' => $curso["product_description_1"],
//                    'product_image_1' => $curso["product_image_1"],
//                
//                    'store_branch_location_1' => $curso["store_branch_location_1"],
//                    'store_branch_id_1' => $curso["store_branch_id_1"],
//                    'store_branch_name_1' => $curso["store_branch_name_1"],
//                    'store_branch_telephone_1' => $curso["store_branch_telephone_1"],
//                    'store_branch_cellphone_1' => $curso["store_branch_cellphone_1"],
//                    'store_branch_aditional_information_1' => $curso["store_branch_aditional_information_1"],
//                    
//                    
//                    'commercial_store_name' => $curso["commercial_store_name"],
//                    'commercial_store_tin' => $curso["commercial_store_tin"],
//                    'location_origin' => $curso["location_origin"],
//
//                    'customer_branch_location_1' => $curso["customer_branch_location_1"],
//                    'customer_branch_id_1' => $curso["customer_branch_id_1"],
//                    'customer_branch_name_1' => $curso["customer_branch_name_1"],
//                    'customer_branch_telephone_1' => $curso["customer_branch_telephone_1"],
//                    'customer_branch_cellphone_1' => $curso["customer_branch_cellphone_1"],
//                    'customer_branch_aditional_information_1' => $curso["customer_branch_aditional_information_1"], 
//                    
//                    'commercial_customer_name' => $curso["commercial_customer_name"],
//                    'commercial_customer_tin' => $curso["commercial_customer_tin"],
//                    'location_destiny' => $curso["location_destiny"],
//                
//                    'shipment_id_1' => $curso["shipment_id_1"],
//                    'shipment_setUpDate_1' => $curso["shipment_setUpDate_1"],
//                    'amountRecords' => $amountRecords,
//                    'alias' => $alias
//                );
//                $i++;
//            }
//
//            if ($i == 0)
//            {
//                $sendata[0] = array(
//                    'sale_id_1' => "_",
//                    'customer_id_1' => "_",
//                    'sale_date_1' => "_",
//                    'sale_total_1' => "_",
//                    'sale_status_1' => "_",
//                    'saleDetail_id_1' => "_",
//                    'product_id_1' => "_",
//                    'saleDetail_amount_1' => "_",
//                    'product_name_1' => "_",
//                    'product_description_1' => "_",
//                    'product_image_1' => "_",
//
//                    'store_branch_location_1' => "_",
//                    'store_branch_id_1' => "_",
//                    'store_branch_name_1' => "_",
//                    'store_branch_telephone_1' => "_",
//                    'store_branch_cellphone_1' => "_",
//                    'store_branch_aditional_information_1' => "_",
//
//                    'commercial_store_name' => "_",
//                    'commercial_store_tin' => "_",
//                    'location_origin' => "_",
//
//                    'customer_branch_location_1' => "_",
//                    'customer_branch_id_1' => "_",
//                    'customer_branch_name_1' => "_",
//                    'customer_branch_telephone_1' => "_",
//                    'customer_branch_cellphone_1' => "_",
//                    'customer_branch_aditional_information_1' => "_",
//
//
//                    'commercial_customer_name' => "_",
//                    'commercial_customer_tin' => "_",
//                    'location_destiny' => "_",
//
//                    'shipment_id_1' => "_",
//                    'shipment_setUpDate_1' => "_",
//                    'amountRecords' => 0,
//                    'alias' => $alias
//                );
//            }
            
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function getShippingMessengerListAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em2 = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                Shipping.shipping_id as shipping_id_1, 
                Shipping.driver_id as driver_id_1, 
                Shipping.vehicle_id as vehicle_id_1, 
                Shipping.packageMessenger_id as packageMessenger_id_1, 
                
                Driver.user_profilePhoto as user_profilePhoto_1, 
                Driver.user_name as user_name_1, 
                Driver.user_firstGivenName as user_firstGivenName_1, 
                Driver.user_secondGivenName as user_secondGivenName_1, 
                Driver.user_firstFamilyName as user_firstFamilyName_1, 
                Driver.user_secondFamilyName as user_secondFamilyName_1, 
                Driver.user_email as user_email_1, 
                Driver.user_password as user_password_1, 
                Driver.user_biography as user_biography_1, 
                Driver.user_score as user_score_1, 
                
                Vehicle.vehicle_plate as vehicle_plate_1 

                FROM Shipping 
                
                INNER JOIN Commercial ON Commercial.commercial_id = Shipping.driver_id 
                
                INNER JOIN User as Driver ON Driver.user_id = Commercial.user_id 
                
                INNER JOIN Vehicle ON Vehicle.vehicle_id = Shipping.vehicle_id 
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
                    'shipping_id_1' => $curso["shipping_id_1"],
                    'driver_id_1' => $curso["driver_id_1"],
                    'vehicle_id_1' => $curso["vehicle_id_1"],
                    'packageMessenger_id_1' => $curso["packageMessenger_id_1"],
                    
                    'user_profilePhoto_1' => $curso["user_profilePhoto_1"],
                    'user_name_1' => $curso["user_name_1"],
                    'user_firstGivenName_1' => $curso["user_firstGivenName_1"],
                    'user_secondGivenName_1' => $curso["user_secondGivenName_1"],
                    'user_firstFamilyName_1' => $curso["user_firstFamilyName_1"],
                    'user_secondFamilyName_1' => $curso["user_secondFamilyName_1"],
                    'user_email_1' => $curso["user_email_1"],
                    'user_password_1' => $curso["user_password_1"],
                    'user_biography_1' => $curso["user_biography_1"],
                    'user_score_1' => $curso["user_score_1"],
                    'vehicle_plate_1' => $curso["vehicle_plate_1"],
                    
                    'amountRecords' => $amountRecords
                );
                $i++;
            }
            
            
            if ($i == 0)
            {
                $sendata[0] = array(
                    'shipping_id_1' => 0,
                    'driver_id_1' => 0,
                    'vehicle_id_1' => 0,
                    'packageMessenger_id_1' => 0,
                    
                    'user_profilePhoto_1' => "_",
                    'user_name_1' => "_",
                    'user_firstGivenName_1' => "_",
                    'user_secondGivenName_1' => "_",
                    'user_firstFamilyName_1' => "_",
                    'user_secondFamilyName_1' => "_",
                    'user_email_1' => "_",
                    'user_password_1' => "_",
                    'user_biography_1' => "_",
                    'user_score_1' => "_",
                    'vehicle_plate_1' => "_",
                    
                    'amountRecords' => $amountRecords
                );
            }
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function getShipmentDetailListAction(Request $request)
    {
        $saleDetail = $_POST['saleDetail'];
        
        if ($request->isXMLHttpRequest()) {

            $em2 = $this->getDoctrine()->getManager();
            
//                Shipment.shipping_id, 
//                Shipment.delivery, 
//                Shipment.setUpDate, 
//                Shipment.catched, 
//                Shipment.state 
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                Shipment.shipment_id 
                
                FROM Shipment 
                WHERE Shipment.saleDetail_id = '$saleDetail'
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
                    'shipment_id' => $curso["shipment_id"],
                    'shipping_id' => "_",
                    'delivery' => "_",
                    'setUpDate' => "_",
                    'catched' => "_",
                    'state' => "_",
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendata[0] = array(
                    'shipment_id' => 0,
                    'shipping_id' => 0,
                    'delivery' => "_",
                    'setUpDate' => "_",
                    'catched' => "_",
                    'state' => "_"
                );
            }
            
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    public function editShipmentAction(Request $request)
    {
        $new_shipping = $_POST["new_shipping"];
        $shipment = $_POST["shipment"];
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            $followers456 = $em->createQuery(
                "
                SELECT sh.shippingId 
                    
                FROM HomeBundle:Shipment s 
                
                JOIN HomeBundle:Shipping sh 
                WITH sh.shippingId = s.shipping 
                
                WHERE s.shipmentId = '$shipment'
            ");
            $followers_v123 = $followers456->getResult();
            
            if ($followers_v123)
            {
                $old_shipping = $followers_v123[0]['shippingId'];
            }
            
            $todayDate = date("Y-m-d\TH:i:sP");
            
            $query2 = "
                UPDATE `shipment` SET 
                `shipping_id` = $new_shipping, 
                `catched` = '$todayDate' 
                WHERE `shipment`.`shipment_id` = $shipment 
            ";
            
            
            
            $this->insert_anomalyShipment($em2, $shipment, $old_shipping, $new_shipping);
            
            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function insert_anomalyShipment($em, $shipment, $old_shipping, $new_shipping)
    {
        $db2 = $em->getConnection();
        
        $todayDate = date("Y-m-d\TH:i:sP");
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        
        $query2 = "
            INSERT INTO `anomalyShipment`(
            `shipment_id`, 
            `reporter`, 
            `date`, 
            `old_shipping`, 
            `new_shipping` 
            ) 
            VALUES (
            '$shipment',
            '$userId',
            '$todayDate',
            '$old_shipping',
            '$new_shipping')
        ";

        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);
    }
    
    
    
    public function getLocationDetailAction(Request $request)
    {
        $locationId = $_POST['locationId'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $location_query = $em->createQuery(
                "
                SELECT DISTINCT 
                    l.locationId, 
                    l.locationName, 
                    k.keywordContent territorialityName 
                    
                    FROM HomeBundle:Location l 

                    JOIN HomeBundle:Territoriality t 
                    WITH l.territoriality = t.territorialityId 
                    
                    JOIN HomeBundle:Keywordterritoriality kt 
                    WITH kt.territoriality = t.territorialityId 
                    
                    JOIN HomeBundle:Keyword k 
                    WITH k.keywordId = kt.keyword 
                    
                    WHERE l.locationId = '$locationId' 
                "
            );
            $location_e = $location_query->getResult();

            if (isset($location_e[0]['locationId']))
            {
                $locationId_value = $location_e[0]['locationId'];
                $locationName_value = $location_e[0]['locationName'];
                $territorialityName_value = $location_e[0]['territorialityName'];

                $locationData[] = array(
                    'locationId' => $locationId_value, 
                    'locationName' => $locationName_value, 
                    'territorialityName' => $territorialityName_value
                );
            } else
            {
                $locationData[] = array(
                    'locationId' => "_", 
                    'locationName' => "_", 
                    'territorialityName' => "_"
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getReachFromPackageMessengerAction(Request $request)
    {
        $location_id = $_POST['location_id'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getManager();
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                Reach.reach_id, 
                Reach.location_id, 
                Location.location_name, 
                Keyword.keyword_content as territoriality_name 
                
                FROM Reach 
                
                INNER JOIN Location ON Location.location_id = Reach.location_id 
                
                INNER JOIN Territoriality ON Territoriality.territoriality_id = Location.territoriality 
                
                INNER JOIN KeywordTerritoriality ON KeywordTerritoriality.territoriality_id = Territoriality.territoriality_id 
                
                INNER JOIN Keyword ON Keyword.keyword_id = KeywordTerritoriality.keyword_id 

                WHERE Reach.location_id = '$location_id' 
            ";
            
//                INNER JOIN KeywordLocation ON KeywordLocation.location_id = Reach.location_id 
//                
//                INNER JOIN Keyword ON Keyword.keyword_id = KeywordLocation.keyword_id 
//                
//                INNER JOIN Language ON Language.language_id = KeywordLocation.language_id 
//                
//            and Language.language_id = '1' 
//                INNER JOIN Reach ON Reach.package_id = Package.package_id 
//            GROUP BY Reach.reach_id

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
                    'reach_id' => $curso["reach_id"],
                    'location_id' => $curso["location_id"],
                    'location_name' => $curso["location_name"],
                    'territoriality_name' => $curso["territoriality_name"],
                    'amountRecords' => $amountRecords
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendata[0] = array(
                    'reach_id' => 0,
                    'location_id' => 0,
                    'location_name' => 0,
                    'territoriality_name' => 0,
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getPackageMessengerAction(Request $request)
    {
        $reach_request = $_POST['reach_request'];
        
        if ($request->isXMLHttpRequest()) {

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
        
            $em2 = $this->getDoctrine()->getManager();
            $db2 = $em2->getConnection();
            
            if ($reach_request == "messenger")
            {
                $reachmessenger_1 = $this->get('app.reachmessenger');
                $reachlist_id = $reachmessenger_1->get_reachMessenger_list($db2, $userId);
            } else if ($reach_request == "user")
            {
                $reachuser_1 = $this->get('app.reachuser');
                $reachlist_id = $reachuser_1->get_reachUser_list($db2, $userId);
            }
            
            return new Response(json_encode($reachlist_id), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSalePackageMessengerAction(Request $request)
    {
        $origin_id = $_POST['origin_id'];
        $destiny_id = $_POST['destiny_id'];
                
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getManager();
            $db2 = $em2->getConnection();
            
            $matchnodes_1 = $this->get('app.matchnodes');
            $nodes = $matchnodes_1->isValid($db2, $origin_id, $destiny_id);
            
            $origin = $nodes[0];
            $destiny = $nodes[1];
            
            $reach_1 = $this->get('app.reach');
            $reach_id = $reach_1->isValid($db2, $origin, $destiny);
            
            $reachuser_1 = $this->get('app.reachuser');
            $reachuser_id = $reachuser_1->isValid($db2, $reach_id, $userId);
            
            $string_d_1 = "";
            $string_d_1 .= 
            "
            SELECT DISTINCT 
                saleDetail.saleDetail_id, 
                saleDetail.saleDetail_amount, 
                Product.product_id, 
                Product.product_name, 
                Product.product_description, 
                Product.product_image, 
                Product.product_score, 
                Price.amount, 
                Currency.currency_name, 
                Currency.currency_value 
                
                FROM saleDetail 
                
                INNER JOIN Sale ON saleDetail.sale_id = Sale.sale_id 
                INNER JOIN Branch as Customer ON Sale.customer_id = Customer.branch_id 
                
                INNER JOIN Branch as Store ON Store.branch_id = saleDetail.store_id 
                
                INNER JOIN Product ON Product.product_id = saleDetail.product_id 
                INNER JOIN Price ON Price.price_id = Product.product_price 
                INNER JOIN Currency ON Currency.currency_id = Price.currency 
                
                WHERE Customer.location_id = '$destiny' and Store.location_id = '$origin' 
            ";
    
            $stmt2 = $db2->prepare($string_d_1);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);
            $i = 0;
            
            foreach($cursos2 as $curso)
            {
                $amount = $curso["amount"];
                $currency_value = $curso["currency_value"];
                        
                $price = $amount * $currency_value;
                        
                $sendata[$i] = array(
                    'saleDetail_id' => $curso["saleDetail_id"],
                    'saleDetail_amount' => $curso["saleDetail_amount"],
                    'product_id' => $curso["product_id"],
                    'product_name' => $curso["product_name"],
                    'product_description' => $curso["product_description"],
                    'product_image' => $curso["product_image"],
                    'product_score' => $curso["product_score"],
                    'price' => $price,
                    'currency_name' => $curso["currency_name"],
                    'amountRecords' => $amountRecords
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendata[0] = array(
                    'saleDetail_id' => 0,
                    'saleDetail_amount' => 0,
                    'product_id' => 0,
                    'product_name' => "",
                    'product_description' => "",
                    'product_image' => "",
                    'product_score' => "",
                    'price' => 0,
                    'currency_name' => "",
                    'amountRecords' => 0
                );
            }
            
            return new Response(json_encode($sendata), 200, array('Content-Type' => 'application/json'));
        }
    }
}