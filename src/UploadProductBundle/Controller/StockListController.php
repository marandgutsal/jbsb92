<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StockListController extends Controller
{
//    public function indexAction()
//    {
//        return $this->render('@UploadProduct/Default/index.html.twig');
//    }
    
    public function getStockAction(Request $request)
    {
        $daysAmount = $_POST['daysAmount'];
        $order = $_POST['order']; // 1: ascendent; 0: descendent (by default)
        $orderType = $_POST['orderType']; // 0: default, 1: sales, 2: stock, 3: name, 4: type 

        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
            else {
                $userId = 0;
            }
        
            if ($orderType === 4)
            {
                $order_array = "";
            } else
            {
                $order_array = $this->getStockByName($em, $userId, $order);
//                $order_array = "";
            }
            
            $stringQuery =
                "SELECT DISTINCT 
                p.productId, p.productName, pr.amount priceAmount, c.currencyName, 
                p.productDescription, p.productImage, 
                u.userId, u.userName 
                
                FROM HomeBundle:Product p 
                
                JOIN HomeBundle:User u 
                WITH u.userId = p.user 
                
                JOIN HomeBundle:Price pr 
                WITH pr.priceId = p.productPrice 
                
                JOIN HomeBundle:Currency c 
                WITH pr.currency = c.currencyId 
                
                WHERE u.userId = '$userId'".$order_array
                ;
            
            $stockInformation = $em->createQuery(
                $stringQuery
            );
            $stockInformation_v = $stockInformation->getResult();
            
            
            $amountProducts = count($stockInformation_v);
            
            $i = 0;
            while (isset($stockInformation_v[$i]['productId'])) {

                if (
                    file_exists("files/products/".$stockInformation_v[$i]['userId'].
                    "/".$stockInformation_v[$i]['productImage'])
                )
                {
                    $productImage_Value = $stockInformation_v[$i]['productImage'];
                }
                else
                {
                    $productImage_Value = "_";
                }

                $productId_Value = $stockInformation_v[$i]['productId'];
                $productName_Value = $stockInformation_v[$i]['productName'];
                $priceAmount_Value = $stockInformation_v[$i]['priceAmount'];
                $currencyName_Value = $stockInformation_v[$i]['currencyName'];
                $productDescription_Value = $stockInformation_v[$i]['productDescription'];
                $productImage_Value = $stockInformation_v[$i]['productImage'];
                $userId_Value = $stockInformation_v[$i]['userId'];
                $userName_Value = $stockInformation_v[$i]['userName'];

//                $salesAmount = 0;
//                $stockAmount = 0;

                $salesAmount = $this->getSalesReport($daysAmount, $em, $productId_Value);
                $stockAmount = $this->getStockReport($em, $productId_Value);
                

                $sendData[$i] = array(
                    'productId' => $productId_Value,
                    'productName'=> $productName_Value,
                    'priceAmount' => $priceAmount_Value,
                    'currencyName' => $currencyName_Value,
                    'productDescription' => $productDescription_Value,
                    'productImage' => $productImage_Value,
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'amountProducts' => $amountProducts,
                    'salesAmount' => $salesAmount,
                    'stockAmount' => $stockAmount
                );
                $i++;
            }
          

            if ($i == 0)
            {
                $sendData[0] = array(
                    'productId' => "_",
                    'productName'=> "_",
                    'priceAmount' => "_",
                    'currencyName' => "_",
                    'productDescription' => "_",
                    'productImage' => "_",
                    'userId' => "_",
                    'userName' => "_",
                    'amountProducts' => 0,
                    'salesAmount' => 0,
                    'stockAmount' => 0
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    public function getStockByName($em, $userId, $order)
    {
        if ($order == 1)
        {
            $order_array = " ORDER BY p.productName ASC";
        } else
        {
            $order_array = " ORDER BY p.productName DESC";
        }
        
        return $order_array;
    }
    
    
    
    
    
    public function getStockReport($em, $productId_Value)
    {
        $stockProduct = $em->createQuery(
            "SELECT s.stockId, s.stockAmount 

            FROM HomeBundle:Stock s 
            
            JOIN HomeBundle:Product p 
            WITH s.product = p.productId 

            WHERE p.productId = '$productId_Value'"
        );
        $stockProduct_v = $stockProduct->getResult();
        if (isset($stockProduct_v[0]['stockId']))
        {
            $stockChecking = 0;
            $stockAmount = 0;
            while (isset($stockProduct_v[$stockChecking]['stockId'])) {
                $stockAmount += $stockProduct_v[$stockChecking]['stockAmount']; 
                $stockChecking++;
            }
            
        } else
        {
            $stockAmount = 0;
        }
        
        return $stockAmount;
    }
    
    public function getSalesReport($daysAmount, $em, $productId_Value)
    {
        $todayDate = date("Y-m-d");
        $initialRankDate = strtotime('-'.$daysAmount.' day', strtotime($todayDate));
        $initialRankDate_v2 = date ("Y-m-d", $initialRankDate);
        
        $sellingProduct = $em->createQuery(
            "SELECT sp.sellingproductId, sp.sellingproductDate 

            FROM HomeBundle:Sellingproduct sp 
            
            JOIN HomeBundle:Product p 
            WITH sp.product = p.productId 

            WHERE sp.sellingproductDate >= '$initialRankDate_v2' and p.productId = '$productId_Value'"
        );
        $sellingProduct_v = $sellingProduct->getResult();

        if (isset($sellingProduct_v[0]['sellingproductId']))
        {
            $salesAmount = count($sellingProduct_v);
        } else
        {
            $salesAmount = 0;
        }
        
        return $salesAmount;
    }
}