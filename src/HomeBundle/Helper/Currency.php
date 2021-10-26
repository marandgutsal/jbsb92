<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Currency extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $db2, $requested_currency, $price_id)
    {
        $valor1 = $this->getCurrency_value($em, $db2, $requested_currency, $price_id);
//        $valor1 = 1;
        
        return $valor1;
    }
    
    public function getCurrency_value($em, $db2, $requested_currency, $price_id)
    {
        $price = $em->createQuery(
            "
            SELECT DISTINCT 
                pr.priceId, 
                pr.amount, 
                cu.currencyId 
                
            FROM HomeBundle:Price pr 
            
            JOIN HomeBundle:Currency cu 
            WITH pr.currency = cu.currencyId 
            
            WHERE pr.priceId = '$price_id' 
            "
        );
        $price_e = $price->getResult();
        
        $price_amount = $price_e[0]['amount'];
        
        ////////////////////////////////////////////////////////////////////////////
        
        $currency_array = $this->getCurrency_information($em, $requested_currency);
        $new_currencyId = $currency_array[0];
        $new_currencyName = $currency_array[1];
        $new_currencyValue = $currency_array[2];
        
        $PRICE = $new_currencyValue * $price_amount;
        
        ////////////////////////////////////////////////////////////////////////////
        
        $new_price = $em->createQuery(
            "
            SELECT DISTINCT 
                pr.priceId, 
                pr.amount, 
                cu.currencyId, 
                cu.currencyName 
                
            FROM HomeBundle:Price pr 

            JOIN HomeBundle:Currency cu 
            WITH pr.currency = cu.currencyId 

            WHERE pr.currency = $requested_currency and pr.amount = $price_amount 
            "
        );
        $new_price_e = $new_price->getResult();
        
        if (isset($new_price_e[0]['priceId'])) {
            $new_priceId = $new_price_e[0]['priceId'];
            $new_amount = $new_price_e[0]['amount'];
            $new_currencyId = $new_price_e[0]['currencyId'];
            $new_currencyName = $new_price_e[0]['currencyName'];
            
            $new_price_array[0] = $new_priceId;
            $new_price_array[1] = $new_amount;
            $new_price_array[2] = $new_currencyId;
            $new_price_array[3] = $new_currencyName;
            $new_price_array[4] = $PRICE;
        } else
        {
            $query2 = "
                INSERT INTO `price`(
                `amount`, 
                `currency`) 
                VALUES (
                '$price_amount',
                '$requested_currency')
            ";
            
            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $query3 = "
                SELECT LAST_INSERT_ID() as inserted
            ";
            
            $stmt3 = $db2->prepare($query3);
            $params3 = array();
            $stmt3->execute($params3);

            $cursos3 = $stmt3->fetchAll();
            foreach($cursos3 as $curso)
            {
                $new_priceId = $curso["inserted"];
                $new_amount = $price_amount;
                
                $new_price_array[0] = $new_priceId;
                $new_price_array[1] = $new_amount;
                $new_price_array[2] = $new_currencyId;
                $new_price_array[3] = $new_currencyName;
                $new_price_array[4] = $PRICE;
            }
        }
        return $new_price_array;
    }
    
    public function getCurrency_information($em, $requested_currency)
    {
        $currency_data = $em->createQuery(
            "
            SELECT DISTINCT 
                cu.currencyId, 
                cu.currencyName, 
                cu.currencyValue 
                
            FROM HomeBundle:Currency cu 
            
            WHERE cu.currencyId = $requested_currency 
            "
        );
        $currency_data_e = $currency_data->getResult();
        
        $currency_array[0] = $currency_data_e[0]['currencyId'];
        $currency_array[1] = $currency_data_e[0]['currencyName'];
        $currency_array[2] = $currency_data_e[0]['currencyValue'];
        
        return $currency_array;
    }
    
    public function getCurrency_list($em)
    {
        $currency_data = $em->createQuery(
            "
            SELECT DISTINCT 
                cu.currencyId, 
                cu.currencyName, 
                cu.currencyValue 
                
            FROM HomeBundle:Currency cu 
            "
        );
        $currency_data_e = $currency_data->getResult();
        
        
        $amountCurrencies = 0;
        while (isset($currency_data_e[$amountCurrencies]['currencyId'])) {
            $amountCurrencies++; // this is another function, and another div 
        }

        $i = 0;
        while (isset($currency_data_e[$i]['currencyId'])) {

            $currencyId_Value = $currency_data_e[$i]['currencyId'];
            $currencyName_Value = $currency_data_e[$i]['currencyName'];
            $currencyValue_Value = $currency_data_e[$i]['currencyValue'];
            
            $sendData[$i] = array(
                'currencyId' => $currencyId_Value,
                'currencyName' => $currencyName_Value,
                'currencyValue' => $currencyValue_Value,
                'amountCurrencies' => $amountCurrencies
            );
            $i++;
        }
        
        if ($i == 0)
        {
            $sendData[0] = array(
                'currencyId' => "_",
                'currencyName' => "_",
                'currencyValue' => "_",
                'amountCurrencies' => 0
            );
        }
        
        return $sendData;
    }
}