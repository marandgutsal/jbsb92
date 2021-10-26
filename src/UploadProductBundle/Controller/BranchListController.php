<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BranchListController extends Controller
{
    public function getBranchAction(Request $request)
    {
        $productId = $_POST['productId'];
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();

//            "SELECT b.branchId, b.branchName, 
//            b.branchTelephone, b.branchCellphone, b.branchAditionalInformation, 
//            s.stockAmount, s.stockPrice, 
//            l.locationName 
//
//            FROM HomeBundle:Branch b 
//
//            JOIN HomeBundle:Stock s 
//            WITH s.branch = b.branchId 
//
//            JOIN HomeBundle:Product p 
//            WITH s.product = p.productId 
//
//            JOIN HomeBundle:Location l 
//            WITH l.locationId = b.location 
//
//            WHERE b.branchId = '$branchId_Value' and p.productId = '$productId'"
            
            
            
            
            
            
//            s.stockAmount, pr.amount priceAmount, c.currencyName, 
            
//                JOIN HomeBundle:Stock s 
//                WITH s.branch = b.branchId 
//                
//                JOIN HomeBundle:Price pr 
//                WITH pr.priceId = s.stockPrice 
//                
//                JOIN HomeBundle:Currency c 
//                WITH pr.currency = c.currencyId 
            
            
            
            
            
            $branchQuery = $em->createQuery(
                "SELECT b.branchId, b.branchName, 
                b.branchTelephone, b.branchCellphone, b.branchAditionalInformation, 
                l.locationName 
                
                FROM HomeBundle:Branch b 
                
                JOIN HomeBundle:Commercial co 
                WITH b.commercial = co.commercialId 
                
                JOIN HomeBundle:Location l 
                WITH l.locationId = b.location 
                
                JOIN HomeBundle:User u 
                WITH u.userId = co.user 
                
                WHERE u.userId = '$userId'"
            );
            $branchQuery_v = $branchQuery->getResult();
            $amountBranch = count($branchQuery_v);
            
            $i = 0;
            while (isset($branchQuery_v[$i]['branchId'])) {
                $branchId_Value = $branchQuery_v[$i]['branchId'];
                $branchName_Value = $branchQuery_v[$i]['branchName'];
                $branchTelephone_Value = $branchQuery_v[$i]['branchTelephone'];
                $branchCellphone_Value = $branchQuery_v[$i]['branchCellphone'];
                $branchAditionalInformation_Value = $branchQuery_v[$i]['branchAditionalInformation'];
                $locationName_Value = $branchQuery_v[$i]['locationName'];
                
                $sendData[$i] = array(
                    'branchId' => $branchId_Value,
                    'branchName' => $branchName_Value,
                    'branchTelephone' => $branchTelephone_Value,
                    'branchCellphone' => $branchCellphone_Value,
                    'branchAditionalInformation' => $branchAditionalInformation_Value,
                    'locationName' => $locationName_Value,
                    'amountBranch' => $amountBranch
                );

                $i++;
            }
            
            if ($i == 0)
            {
                $sendData[0] = array(
                    'branchId' => "_",
                    'branchName' => "_",
                    'branchTelephone' => "_",
                    'branchCellphone' => "_",
                    'branchAditionalInformation' => "_",
                    'locationName' => "_",
                    'amountBranch' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getStockInTheBranchAction(Request $request)
    {
        $productId = $_POST['productId'];
        $branchId = $_POST['branchId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $stockQuery = $em->createQuery(
                "SELECT b.branchId, 
                s.stockAmount, pr.amount priceAmount, c.currencyName, c.currencyValue 

                FROM HomeBundle:Branch b 

                JOIN HomeBundle:Stock s 
                WITH s.branch = b.branchId 

                JOIN HomeBundle:Product p 
                WITH s.product = p.productId 

                JOIN HomeBundle:Price pr 
                WITH pr.priceId = s.stockPrice 

                JOIN HomeBundle:Currency c 
                WITH pr.currency = c.currencyId 

                WHERE b.branchId = '$branchId' and p.productId = '$productId'
                "
            );
            $stockQuery_v = $stockQuery->getResult();

            
            
            if (isset($stockQuery_v[0]['branchId']))
            {
                
                $priceAmount_value = $stockQuery_v[0]['priceAmount'];
                $currencyValue_value = $stockQuery_v[0]['currencyValue'];
                
                $value = $priceAmount_value * $currencyValue_value;
                
                $branchId_Value = $stockQuery_v[0]['branchId'];
                $stockAmount_Value = $stockQuery_v[0]['stockAmount'];
                $priceAmount_Value = $value;
                $currencyName_Value = $stockQuery_v[0]['currencyName'];
            }
            else {
                $branchId_Value = 0;
                $stockAmount_Value = 0;
                $priceAmount_Value = 0;
                $currencyName_Value = 0;
            }

            $sendData[0] = array(
                'branchId' => $branchId_Value,
                'stockAmount' => $stockAmount_Value,
                'priceAmount' => $priceAmount_Value,
                'currencyName' => $currencyName_Value
            );
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
}