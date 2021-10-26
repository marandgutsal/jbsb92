<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Stock extends Controller {

    public $global_topicId = 0;
    
    public function getStockData(
            $em, 
            $db2, 
            $branchId_data, 
            $productId_data, 
            $stockAmount_data, 
            $stockPriceAmount, 
            $currency, 
            $todayDate  
            )
    {
        $priceId = $this->getPrice(
            $db2, 
            $stockPriceAmount, 
            $currency
        );
        
        $stockProduct = $em->createQuery(
            "SELECT s.stockId 

            FROM HomeBundle:Stock s 
            
            JOIN HomeBundle:Product p 
            WITH s.product = p.productId 
            
            JOIN HomeBundle:Branch b 
            WITH s.branch = b.branchId 

            WHERE p.productId = '$productId_data' and 
            b.branchId = '$branchId_data' "
        );
        $stockProduct_v = $stockProduct->getResult();
        
        if (isset($stockProduct_v[0]['stockId']))
        {
            $stockId = $stockProduct_v[0]['stockId'];
            $this->updateStock_Amount($db2, $stockId, $stockAmount_data, $todayDate);
            $this->updateStock_Price($db2, $stockId, $priceId, $todayDate);
        } else
        {
            $stockId = $this->insertStock(
                $db2, 
                $branchId_data, 
                $productId_data, 
                $stockAmount_data, 
                $priceId, 
                $todayDate
            );
        }
        
        return $stockId;
    }
    
    public function insertStock(
                $db2, 
                $branchId_data, 
                $productId_data, 
                $stockAmount_data, 
                $priceId, 
                $todayDate)
    {
        $query2 = "
            INSERT INTO `stock`( 
            `product_id`, 
            `branch_id`, 
            `stock_amount`, 
            `stock_price`, 
            `stock_lastTransactionDate`) 
            VALUES ( 
            '$productId_data', 
            '$branchId_data', 
            '$stockAmount_data', 
            '$priceId', 
            '$todayDate') 
        ";

        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);

        ////////
        
        $query3 = "
            SELECT LAST_INSERT_ID() as inserted
        ";

        $stmt3 = $db2->prepare($query3);
        $params3 = array();
        $stmt3->execute($params3);

        $cursos3 = $stmt3->fetchAll();
        foreach($cursos3 as $curso)
        {
            $stockId = $curso["inserted"];
        }
        return $stockId;
    }
    
    public function updateStock_Amount($db2, $stockId, $stockAmount_data, $todayDate)
    {
        $query_nm = " 
            UPDATE `stock` 
            SET 
            `stock_amount`=$stockAmount_data,
            `stock_lastTransactionDate`='$todayDate' 

            WHERE 

            stock_id = '$stockId' 
        ";

        $stmt_nm = $db2->prepare($query_nm);
        $params_nm = array();
        $stmt_nm->execute($params_nm);
    }
    
    public function updateStock_Price($db2, $stockId, $priceId, $todayDate)
    {
        $query_n = " 
            UPDATE `stock` 
            SET 
            `stock_price`=$priceId, 
            `stock_lastTransactionDate`='$todayDate' 

            WHERE 

            stock.stock_id = '$stockId' 
        ";

        $stmt_n = $db2->prepare($query_n);
        $params_n = array();
        $stmt_n->execute($params_n);
    }
    
    public function get_currency_value($currency, $db2)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            currency.currency_id, 
            currency.currency_name, 
            currency.currency_value 

            FROM currency 
            
            WHERE currency.currency_id = '$currency' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);
        
        $cursos2 = $stmt2->fetchAll();
        
        foreach($cursos2 as $curso)
        {
            $currency_value = $curso["currency_value"];
        }
        
        return $currency_value;
    }
    
    public function getPrice($db2, $stockPriceAmount, $currency)
    {
        $currency_value = $this->get_currency_value($currency, $db2);
        
        $price_amount_value = $stockPriceAmount / $currency_value;
        
//        $PriceAmount = $price_amount_POST / $currency_value_POST;
//        $PRICE_ID : $PriceAmount && $currency
        
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            price.price_id, 
            price.amount, 
            currency.currency_id, 
            currency.currency_name, 
            currency.currency_value 

            FROM price 
            INNER JOIN currency ON currency.currency_id = price.currency 
            
            WHERE price.amount = '$price_amount_value' and currency.currency_id = '$currency' 
        ";
        
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        if ($amountRecords == 0)
        {
            $query4 = "
                INSERT INTO `price`( 
                `amount`, 
                `currency`) 
                VALUES ( 
                '$price_amount_value', 
                '$currency') 
            ";

            $stmt4 = $db2->prepare($query4);
            $params4 = array();
            $stmt4->execute($params4);

            ////////

            $query3 = "
                SELECT LAST_INSERT_ID() as inserted
            ";

            $stmt3 = $db2->prepare($query3);
            $params3 = array();
            $stmt3->execute($params3);

            $cursos3 = $stmt3->fetchAll();
            foreach($cursos3 as $curso)
            {
                $price_id = $curso["inserted"];
            }
            
        } else
        {
            foreach($cursos2 as $curso)
            {
                $price_id = $curso["price_id"];
            }
        }
        
        return $price_id;
    }
}