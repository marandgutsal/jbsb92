<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CurrentListController extends Controller
{
    public function selectCurrencyAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
//            public function cd_fdgbcjdhs()
//            {
//                return 234;
//            }
            
//            $currency_1 = $this->get('app.currency');
//            $new_price_array = $currency_1->isValid($em, $db2, $requested_currency, $price_id);
            
//            $currency_1 = $this->get('app.currency');
//            $new_price_array = $currency_1->cd_fdgbcjdhs();
            
            $currency_1 = $this->get('app.currency');
            $new_price_array = $currency_1->getCurrency_list($em);
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => $new_price_array,
//                'amountLocations' => 0
//            );
            
            return new Response(json_encode($new_price_array), 200, array('Content-Type' => 'application/json'));
        }
    }
}