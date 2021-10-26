<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StockController extends Controller
{
    public function confirmStockAmountAction(Request $request)
    {
        $branchId_data = $_POST['branchId_data'];
        $productId_data = $_POST['productId_data'];
        $stockAmount_data = $_POST['stockAmount_data'];
        $stockPriceAmount = $_POST['stockPriceAmount'];
        $currency = $_POST['currency'];
            
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $todayDate = date("Y-m-d\TH:i:sP");
            
            $stock_1 = $this->get('app.stock');
            $stock_results = $stock_1->getStockData(
                    $em, 
                    $db2, 
                    $branchId_data, 
                    $productId_data, 
                    $stockAmount_data, 
                    $stockPriceAmount, 
                    $currency, 
                    $todayDate
                    );
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}