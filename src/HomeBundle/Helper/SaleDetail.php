<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SaleDetail extends Controller {
    
    public $global_topicId = 0;
    
    public function checkSaleDetail($db2, $log_userId)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                Shipment.shipment_id, 
                SaleDetail.saleDetail_id, 
                SaleDetail.store_id, 
                SaleDetail.saleDetail_amount, 
                node.node_id, 
                node.departure_date, 
                node.delivery_date, 
                node.agreement_date, 
                product.product_id, 
                product.product_name, 
                product.product_description, 
                product.product_image, 
                price.price_id, 
                price.amount as price_amount, 
                currency.currency_id, 
                currency.currency_name, 
                currency.currency_value 

            FROM Shipment 
            INNER JOIN ShippingUser ON ShippingUser.shippingUser_id = Shipment.shippingUser_id 
            INNER JOIN node ON node.node_id = Shipment.node_id 
            
            INNER JOIN SaleDetail ON SaleDetail.saleDetail_id = Shipment.saleDetail_id 
            INNER JOIN selectedProduct ON selectedProduct.selectedProduct_id = SaleDetail.selectedProduct_id 
            
            INNER JOIN stock ON stock.stock_id = selectedProduct.stock_id 
            INNER JOIN product ON product.product_id = stock.product_id 

            INNER JOIN price ON price.price_id = selectedProduct.selectedProduct_price 

            INNER JOIN currency ON currency.currency_id = price.currency 
            
            INNER JOIN commercial ON commercial.commercial_id = ShippingUser.user_id 
            
            INNER JOIN user ON user.user_id = commercial.user_id 
            
            WHERE user.user_id = '$log_userId' 
            
            GROUP BY SaleDetail.saleDetail_id 
            ORDER BY SaleDetail.saleDetail_id DESC 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $price_amount = $curso["price_amount"];
            $currency_value = $curso["currency_value"];
            
            $checked_price = $price_amount * $currency_value;
            
            $sendata[$i] = array(
                'shipment_id' => $curso["shipment_id"],
                'saleDetail_id' => $curso["saleDetail_id"],
                'store_id' => $curso["store_id"],
                'saleDetail_amount' => $curso["saleDetail_amount"],
                'node_id' => $curso["node_id"],
                'departure_date' => $curso["departure_date"],
                'delivery_date' => $curso["delivery_date"],
                'agreement_date' => $curso["agreement_date"],
                'product_id' => $curso["product_id"],
                'product_name' => $curso["product_name"],
                'product_description' => $curso["product_description"],
                'product_image' => $curso["product_image"],
                'price_id' => $curso["price_id"],
                'price_amount' => $curso["price_amount"],
                'currency_id' => $curso["currency_id"],
                'currency_name' => $curso["currency_name"],
                'currency_value' => $curso["currency_value"],
                'checked_price' => $checked_price,
                'amountRecords' => $amountRecords
            );
            $i++;
        }

        if ($amountRecords == 0)
        {
            $sendata[] = array(
                'shipment_id' => 0,
                'saleDetail_id' => 0,
                'store_id' => 0,
                'saleDetail_amount' => 0,
                'node_id' => 0,
                'departure_date' => "",
                'delivery_date' => "",
                'agreement_date' => "",
                'product_id' => 0,
                'product_name' => "",
                'product_description' => "",
                'product_image' => "",
                'price_id' => "",
                'price_amount' => "",
                'currency_id' => "",
                'currency_name' => "",
                'currency_value' => "",
                'checked_price' => 0,
                'amountRecords' => $amountRecords
            );
        }
        return $sendata;
    }
    
    function getShipmentFromSaledetail($db2, $sale_detailId)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                Shipment.shipment_id, 
                SaleDetail.saleDetail_id, 
                SaleDetail.store_id, 
                SaleDetail.saleDetail_amount, 
                node.node_id, 
                node.departure_date, 
                node.delivery_date, 
                node.agreement_date, 
                product.product_id, 
                product.product_name, 
                product.product_description, 
                product.product_image, 
                price.price_id, 
                price.amount as price_amount, 
                currency.currency_id, 
                currency.currency_name, 
                currency.currency_value 

            FROM Shipment 
            INNER JOIN ShippingUser ON ShippingUser.shippingUser_id = Shipment.shippingUser_id 
            INNER JOIN node ON node.node_id = Shipment.node_id 

            INNER JOIN SaleDetail ON SaleDetail.saleDetail_id = Shipment.saleDetail_id 
            INNER JOIN selectedProduct ON selectedProduct.selectedProduct_id = SaleDetail.selectedProduct_id 
            
            INNER JOIN stock ON stock.stock_id = selectedProduct.stock_id 
            INNER JOIN product ON product.product_id = stock.product_id 

            INNER JOIN price ON price.price_id = selectedProduct.selectedProduct_price 

            INNER JOIN currency ON currency.currency_id = price.currency 

            INNER JOIN commercial ON commercial.commercial_id = ShippingUser.user_id 
            
            INNER JOIN user ON user.user_id = commercial.user_id 

            WHERE SaleDetail.saleDetail_id = '$sale_detailId' 
                
            GROUP BY Shipment.shipment_id 
            ORDER BY Shipment.shipment_id DESC 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $price_amount = $curso["price_amount"];
            $currency_value = $curso["currency_value"];
            
            $checked_price = $price_amount * $currency_value;
            
            $sendata[$i] = array(
                'shipment_id' => $curso["shipment_id"],
                'saleDetail_id' => $curso["saleDetail_id"],
                'store_id' => $curso["store_id"],
                'saleDetail_amount' => $curso["saleDetail_amount"],
                'node_id' => $curso["node_id"],
                'departure_date' => $curso["departure_date"],
                'delivery_date' => $curso["delivery_date"],
                'agreement_date' => $curso["agreement_date"],
                'product_id' => $curso["product_id"],
                'product_name' => $curso["product_name"],
                'product_description' => $curso["product_description"],
                'product_image' => $curso["product_image"],
                'price_id' => $curso["price_id"],
                'price_amount' => $curso["price_amount"],
                'currency_id' => $curso["currency_id"],
                'currency_name' => $curso["currency_name"],
                'currency_value' => $curso["currency_value"],
                'checked_price' => $checked_price,
                'amountRecords' => $amountRecords
            );
            $i++;
        }

        if ($amountRecords == 0)
        {
            $sendata[] = array(
                'shipment_id' => 0,
                'saleDetail_id' => 0,
                'store_id' => 0,
                'saleDetail_amount' => 0,
                'node_id' => 0,
                'departure_date' => "",
                'delivery_date' => "",
                'agreement_date' => "",
                'product_id' => 0,
                'product_name' => "",
                'product_description' => "",
                'product_image' => "",
                'price_id' => "",
                'price_amount' => "",
                'currency_id' => "",
                'currency_name' => "",
                'currency_value' => "",
                'checked_price' => 0,
                'amountRecords' => $amountRecords
            );
        }
        return $sendata;
    }
    
    function getReachFromSaledetail($db2, $sale_detailId)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                Reach.reach_id, 
                Reach.departure_id, 
                Reach.delivery_id 
                
            FROM SaleDetail 
            INNER JOIN Sale ON SaleDetail.sale_id = Sale.sale_id 
            INNER JOIN Branch as Branch_customer ON Branch_customer.branch_id = Sale.customer_id 
            INNER JOIN Location as location_customer ON Branch_customer.location_id = location_customer.location_id 
            
            INNER JOIN Branch ON SaleDetail.store_id = Branch.branch_id 
            INNER JOIN Location as location_store ON Branch.location_id = location_store.location_id 
            
            INNER JOIN Reach ON Reach.departure_id = location_store.location_id and 
            Reach.delivery_id = location_customer.location_id 
            
            WHERE SaleDetail.saleDetail_id = '$sale_detailId' 
        ";
        
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
                'departure_id' => $curso["departure_id"],
                'delivery_id' => $curso["delivery_id"],
                'amountRecords' => $amountRecords
            );
            $i++;
        }
        
        if ($amountRecords == 0)
        {
            $sendata[] = array(
                'reach_id' => 0,
                'departure_id' => 0,
                'delivery_id' => 0,
                'amountRecords' => $amountRecords
            );
        }
        return $sendata;
    }
    
    function assignShipping_to_SaleDetail($em, $db2, $log_userId)
    {
        $selectedProduct = $em->createQuery(
            "SELECT DISTINCT 
                sp.selectedproductId, 
                sp.selectedproductDate, 
                sp.selectedproductAmount, 
                p.productId, 
                p.productName, 
                p.productDescription, 
                p.productImage, 

                pr1.amount as productPrice_amount, 
                cu1.currencyValue as productPrice_currencyValue, 
                cu1.currencyName as productPrice_currency, 

                pr2.amount as stockPrice_amount, 
                cu2.currencyValue as stockPrice_currencyValue, 
                cu2.currencyName as stockPrice_currency, 

                pr3.amount as selectedproductPrice_amount, 
                cu3.currencyValue as selectedproductPrice_currencyValue, 
                cu3.currencyName as selectedproductPrice_currency 

            FROM HomeBundle:Selectedproduct sp 

            JOIN HomeBundle:Stock s 
            WITH s.stockId = sp.stock 

            JOIN HomeBundle:Product p 
            WITH p.productId = s.product 

            JOIN HomeBundle:User u 
            WITH u.userId = sp.user 


            JOIN HomeBundle:Price pr1 
            WITH pr1.priceId = p.productPrice 
            JOIN HomeBundle:Currency cu1 
            WITH pr1.currency = cu1.currencyId 

            JOIN HomeBundle:Price pr2 
            WITH pr2.priceId = s.stockPrice 
            JOIN HomeBundle:Currency cu2 
            WITH pr2.currency = cu2.currencyId 

            JOIN HomeBundle:Price pr3 
            WITH pr3.priceId = sp.selectedproductPrice 
            JOIN HomeBundle:Currency cu3 
            WITH pr3.currency = cu3.currencyId 

            JOIN HomeBundle:Sale sa2 
            WITH sa2.saleId = sp.sale 

            WHERE u.userId = '$log_userId' 

            GROUP BY sp.selectedproductId 
            ORDER BY sp.selectedproductId ASC 
            "
        );

        $selectedProductInstance = $selectedProduct->getResult();
        $amountSelectedProducts = count($selectedProductInstance);

        $i = 0;
        while (isset($selectedProductInstance[$i]['selectedproductId'])) {
            $selectedproductDate = $selectedProductInstance[$i]['selectedproductDate'];
            $selectedproductDateString = $selectedproductDate->format('d-M-Y');

            $selectedproductId_Value = $selectedProductInstance[$i]['selectedproductId'];
            $selectedproductDate_Value = $selectedproductDateString;
            $selectedproductAmount_Value = $selectedProductInstance[$i]['selectedproductAmount'];

            $productId_Value = $selectedProductInstance[$i]['productId'];
            $productName_Value = $selectedProductInstance[$i]['productName'];
            $productDescription_Value = $selectedProductInstance[$i]['productDescription'];
            $productImage_Value = $selectedProductInstance[$i]['productImage'];

            $productPrice_amount_Value = $selectedProductInstance[$i]['productPrice_amount'];
            $productPrice_currencyValue_Value = $selectedProductInstance[$i]['productPrice_currencyValue'];
            $productPrice_currency_Value = $selectedProductInstance[$i]['productPrice_currency'];
            $stockPrice_amount_Value = $selectedProductInstance[$i]['stockPrice_amount'];
            $stockPrice_currencyValue_Value = $selectedProductInstance[$i]['stockPrice_currencyValue'];
            $stockPrice_currency_Value = $selectedProductInstance[$i]['stockPrice_currency'];
            $selectedproductPrice_amount_Value = $selectedProductInstance[$i]['selectedproductPrice_amount'];
            $selectedproductPrice_currencyValue_Value = $selectedProductInstance[$i]['selectedproductPrice_currencyValue'];
            $selectedproductPrice_currency_Value = $selectedProductInstance[$i]['selectedproductPrice_currency'];

            $productPrice_label = $productPrice_amount_Value * $productPrice_currencyValue_Value;
            $stockPrice_label = $stockPrice_amount_Value * $stockPrice_currencyValue_Value;
            $selectedproductPrice_label = $selectedproductPrice_amount_Value * $selectedproductPrice_currencyValue_Value;

            if (file_exists("files/products/".$selectedProductInstance[$i]['productImage']))
            {
                $productImage_Value = $selectedProductInstance[$i]['productImage'];
            } else
            {
                $productImage_Value = "decline.png";
            }

            $sendData[$i] = array(
                'selectedproductId' => $selectedproductId_Value,
                'selectedproductDate' => $selectedproductDate_Value,
                'selectedproductAmount' => $selectedproductAmount_Value,
                'productId' => $productId_Value,
                'productName' => $productName_Value,
                'productDescription' => $productDescription_Value,
                'productImage' => $productImage_Value,

                'productPrice_amount' => $productPrice_amount_Value,
                'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
                'productPrice_currency' => $productPrice_currency_Value,
                'productPrice_label' => $productPrice_label,

                'stockPrice_amount' => $stockPrice_amount_Value,
                'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
                'stockPrice_currency' => $stockPrice_currency_Value,
                'stockPrice_label' => $stockPrice_label,

                'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
                'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
                'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
                'selectedproductPrice_label' => $selectedproductPrice_label,

                'amountSelectedProducts' => $amountSelectedProducts
            );

            $i++;
        }

        if ( $i === 0 )
        {
            $selectedproductId_Value = "_";
            $selectedproductDate_Value = "_";
            $selectedproductAmount_Value = "_";
            $productId_Value = "_";
            $productName_Value = "_";
            $productDescription_Value = "_";
            $productImage_Value = "_";

            $productPrice_amount_Value = "_";
            $productPrice_currencyValue_Value = "_";
            $productPrice_currency_Value = "_";
            $productPrice_label = "_";

            $stockPrice_amount_Value = "_";
            $stockPrice_currencyValue_Value = "_";
            $stockPrice_currency_Value = "_";
            $stockPrice_label = "_";

            $selectedproductPrice_amount_Value = "_";
            $selectedproductPrice_currencyValue_Value = "_";
            $selectedproductPrice_currency_Value = "_";
            $selectedproductPrice_label = "_";

            $sendData[0] = array(
                'selectedproductId' => $selectedproductId_Value,
                'selectedproductDate' => $selectedproductDate_Value,
                'selectedproductAmount' => $selectedproductAmount_Value,
                'productId' => $productId_Value,
                'productName' => $productName_Value,
                'productDescription' => $productDescription_Value,
                'productImage' => $productImage_Value,

                'productPrice_amount' => $productPrice_amount_Value,
                'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
                'productPrice_currency' => $productPrice_currency_Value,
                'productPrice_label' => $productPrice_label,

                'stockPrice_amount' => $stockPrice_amount_Value,
                'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
                'stockPrice_currency' => $stockPrice_currency_Value,
                'stockPrice_label' => $stockPrice_label,

                'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
                'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
                'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
                'selectedproductPrice_label' => $selectedproductPrice_label,

                'amountSelectedProducts' => $amountSelectedProducts
            );
        }

        return $sendData;
    }
    
    
    
    
    
//    public function getSelectedProductsAction(Request $request)
//    {
//        if ($request->isXMLHttpRequest()) {
//            $em = $this->getDoctrine()->getManager();
//
//            $userId = $_SESSION['loginSession'];
//            
//            $selectedProduct = $em->createQuery(
//                "SELECT DISTINCT 
//                    sp.selectedproductId, 
//                    sp.selectedproductDate, 
//                    sp.selectedproductAmount, 
//                    p.productId, 
//                    p.productName, 
//                    p.productDescription, 
//                    p.productImage, 
//                    
//                    pr1.amount as productPrice_amount, 
//                    cu1.currencyValue as productPrice_currencyValue, 
//                    cu1.currencyName as productPrice_currency, 
//                    
//                    pr2.amount as stockPrice_amount, 
//                    cu2.currencyValue as stockPrice_currencyValue, 
//                    cu2.currencyName as stockPrice_currency, 
//                    
//                    pr3.amount as selectedproductPrice_amount, 
//                    cu3.currencyValue as selectedproductPrice_currencyValue, 
//                    cu3.currencyName as selectedproductPrice_currency 
//                    
//                FROM HomeBundle:Selectedproduct sp 
//                
//                JOIN HomeBundle:Stock s 
//                WITH s.stockId = sp.stock 
//                
//                JOIN HomeBundle:Product p 
//                WITH p.productId = s.product 
//
//                JOIN HomeBundle:User u 
//                WITH u.userId = sp.user 
//                
//
//                JOIN HomeBundle:Price pr1 
//                WITH pr1.priceId = p.productPrice 
//                JOIN HomeBundle:Currency cu1 
//                WITH pr1.currency = cu1.currencyId 
//                
//                JOIN HomeBundle:Price pr2 
//                WITH pr2.priceId = s.stockPrice 
//                JOIN HomeBundle:Currency cu2 
//                WITH pr2.currency = cu2.currencyId 
//                
//                JOIN HomeBundle:Price pr3 
//                WITH pr3.priceId = sp.selectedproductPrice 
//                JOIN HomeBundle:Currency cu3 
//                WITH pr3.currency = cu3.currencyId 
//                
//                JOIN HomeBundle:Sale sa2 
//                WITH sa2.saleId = sp.sale OR sp.sale IS NULL 
//                
//                WHERE u.userId = '$userId' 
//                    
//                GROUP BY sp.selectedproductId 
//                ORDER BY sp.selectedproductId ASC 
//                "
//            );
//
//            $selectedProductInstance = $selectedProduct->getResult();
//            $amountSelectedProducts = count($selectedProductInstance);
//            
//            $i = 0;
//            while (isset($selectedProductInstance[$i]['selectedproductId'])) {
//                $selectedproductDate = $selectedProductInstance[$i]['selectedproductDate'];
//                $selectedproductDateString = $selectedproductDate->format('d-M-Y');
//
//                $selectedproductId_Value = $selectedProductInstance[$i]['selectedproductId'];
//                $selectedproductDate_Value = $selectedproductDateString;
//                $selectedproductAmount_Value = $selectedProductInstance[$i]['selectedproductAmount'];
//                
//                $productId_Value = $selectedProductInstance[$i]['productId'];
//                $productName_Value = $selectedProductInstance[$i]['productName'];
//                $productDescription_Value = $selectedProductInstance[$i]['productDescription'];
//                $productImage_Value = $selectedProductInstance[$i]['productImage'];
//                
//                $productPrice_amount_Value = $selectedProductInstance[$i]['productPrice_amount'];
//                $productPrice_currencyValue_Value = $selectedProductInstance[$i]['productPrice_currencyValue'];
//                $productPrice_currency_Value = $selectedProductInstance[$i]['productPrice_currency'];
//                $stockPrice_amount_Value = $selectedProductInstance[$i]['stockPrice_amount'];
//                $stockPrice_currencyValue_Value = $selectedProductInstance[$i]['stockPrice_currencyValue'];
//                $stockPrice_currency_Value = $selectedProductInstance[$i]['stockPrice_currency'];
//                $selectedproductPrice_amount_Value = $selectedProductInstance[$i]['selectedproductPrice_amount'];
//                $selectedproductPrice_currencyValue_Value = $selectedProductInstance[$i]['selectedproductPrice_currencyValue'];
//                $selectedproductPrice_currency_Value = $selectedProductInstance[$i]['selectedproductPrice_currency'];
//                
//                $productPrice_label = $productPrice_amount_Value * $productPrice_currencyValue_Value;
//                $stockPrice_label = $stockPrice_amount_Value * $stockPrice_currencyValue_Value;
//                $selectedproductPrice_label = $selectedproductPrice_amount_Value * $selectedproductPrice_currencyValue_Value;
//                
//                if (file_exists("files/products/".$selectedProductInstance[$i]['productImage']))
//                {
//                    $productImage_Value = $selectedProductInstance[$i]['productImage'];
//                } else
//                {
//                    $productImage_Value = "decline.png";
//                }
//
//                $sendData[$i] = array(
//                    'selectedproductId' => $selectedproductId_Value,
//                    'selectedproductDate' => $selectedproductDate_Value,
//                    'selectedproductAmount' => $selectedproductAmount_Value,
//                    'productId' => $productId_Value,
//                    'productName' => $productName_Value,
//                    'productDescription' => $productDescription_Value,
//                    'productImage' => $productImage_Value,
//                    
//                    'productPrice_amount' => $productPrice_amount_Value,
//                    'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
//                    'productPrice_currency' => $productPrice_currency_Value,
//                    'productPrice_label' => $productPrice_label,
//                    
//                    'stockPrice_amount' => $stockPrice_amount_Value,
//                    'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
//                    'stockPrice_currency' => $stockPrice_currency_Value,
//                    'stockPrice_label' => $stockPrice_label,
//                    
//                    'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
//                    'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
//                    'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
//                    'selectedproductPrice_label' => $selectedproductPrice_label,
//                    
//                    'amountSelectedProducts' => $amountSelectedProducts
//                );
//
//                $i++;
//            }
//
//            if ( $i === 0 )
//            {
//                $selectedproductId_Value = "_";
//                $selectedproductDate_Value = "_";
//                $selectedproductAmount_Value = "_";
//                $productId_Value = "_";
//                $productName_Value = "_";
//                $productDescription_Value = "_";
//                $productImage_Value = "_";
//                
//                $productPrice_amount_Value = "_";
//                $productPrice_currencyValue_Value = "_";
//                $productPrice_currency_Value = "_";
//                $productPrice_label = "_";
//                
//                $stockPrice_amount_Value = "_";
//                $stockPrice_currencyValue_Value = "_";
//                $stockPrice_currency_Value = "_";
//                $stockPrice_label = "_";
//                
//                $selectedproductPrice_amount_Value = "_";
//                $selectedproductPrice_currencyValue_Value = "_";
//                $selectedproductPrice_currency_Value = "_";
//                $selectedproductPrice_label = "_";
//                
//                $sendData[0] = array(
//                    'selectedproductId' => $selectedproductId_Value,
//                    'selectedproductDate' => $selectedproductDate_Value,
//                    'selectedproductAmount' => $selectedproductAmount_Value,
//                    'productId' => $productId_Value,
//                    'productName' => $productName_Value,
//                    'productDescription' => $productDescription_Value,
//                    'productImage' => $productImage_Value,
//                    
//                    'productPrice_amount' => $productPrice_amount_Value,
//                    'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
//                    'productPrice_currency' => $productPrice_currency_Value,
//                    'productPrice_label' => $productPrice_label,
//                    
//                    'stockPrice_amount' => $stockPrice_amount_Value,
//                    'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
//                    'stockPrice_currency' => $stockPrice_currency_Value,
//                    'stockPrice_label' => $stockPrice_label,
//                    
//                    'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
//                    'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
//                    'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
//                    'selectedproductPrice_label' => $selectedproductPrice_label,
//                    
//                    'amountSelectedProducts' => $amountSelectedProducts
//                );
//            }
//            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
//        }
//    }
}