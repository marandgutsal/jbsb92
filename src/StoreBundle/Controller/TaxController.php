<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaxController extends Controller
{
    public function exchangeCurrencyAction(Request $request)
    {
        $requested_currency = $_POST["requested_currency"];
        $price_id = $_POST["price_id"];
        
//        var requested_currency = 1;
//        var foreign_currency = 2;
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
                
            $currency_1 = $this->get('app.currency');
            $new_price_id = $currency_1->isValid($em, $db2, $requested_currency, $price_id);
            
//            $keyword_1 = $this->get('app.keyword');
//            $keywordId_1 = $keyword_1->isValid($em, $keywords_entered_2);
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}