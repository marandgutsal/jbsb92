<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



class EditRoutesController extends Controller
{

    function create_trajectory($saleDetail_id, $origin_location, $destiny_location, $em)
    {
        $trajectory = new \HomeBundle\Entity\Trajectory();
        
        $packageMessenger = $this->get_packageMessenger($origin_location, $destiny_location);
        $shipping = $this->get_shipping($packageMessenger);
        $shipment = $this->get_shipment($saleDetail_id);
        $backordersrate = $this->get_backordersrate();
        
        $trajectory->setShipping($shipping);
        $trajectory->setShipment($shipment);
        $trajectory->setBackordersrate($backordersrate);
        $trajectory->setOrigin(1);
        $trajectory->setDestiny(1);
        $trajectory->setSendDate();
        $trajectory->setDeliverateDate();
        
        $em->persist($trajectory);
        $em->flush();
    }
    

    function get_packageMessenger($origin_location, $destiny_location)
    {
        $string_d_1 = "";
                    
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                package.package_id as package_id, 
                messenger.commercial_name as messenger_name, 
                messenger.commercial_tin as messenger_tin, 
                packageMessenger.trajectoriesAmount as trajectoriesAmount 
                
                FROM package 
                INNER JOIN packageMessenger ON packageMessenger.package_id = package.package_id 
                INNER JOIN messenger ON messenger.messenger_id = packageMessenger.messenger_id 
                
                INNER JOIN packageDestiny ON packageDestiny.package_id = package.package_id 
                INNER JOIN packageOrigin ON packageOrigin.package_id = package.package_id 
                
                WHERE packageDestiny.location_id = $destiny_location and packageOrigin.location_id = $origin_location 
                
                ORDER BY 
                    trajectoriesAmount DESC 
        ";
        
    }
            
    function get_shipping($packageMessenger)
    {
        
    }
         
    function get_shipment($saleDetail_id)
    {
        
    }
        
    function get_backordersrate()
    {
        
    }
            
    
}