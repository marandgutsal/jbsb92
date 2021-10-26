<?php

namespace UploadProductBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StockPrice extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em)
    {
//        $valor1 = $this->insertTopicMember($em, $topic, $topicAmount, $productId);
        $valor1 = 1;
//        return $valor;
        return $valor1;
//        return $productId;
    }
    
}