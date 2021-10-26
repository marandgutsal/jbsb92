<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SearchTopicProductController extends Controller
{
    public function SearchTopicProductAction(Request $request)
    {
        $topic_product_array = $_POST['topic_product_array'];
        
        $first_result = $_POST["first_result"];
        $max_results = $_POST["max_results"];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $languageId = 1;
            
            $i = 0;
            while (isset($topic_product_array[$i][0]) && isset($topic_product_array[$i][1]))
            {
                $keyword_1 = $this->get('app.keyword');
                $keywordId_1 = $keyword_1->isValid($em, $topic_product_array[$i][0]);

                $usertype_1 = $this->get('app.usertype');
                $usertypeId_1 = $usertype_1->isValid($em, $topic_product_array[$i][1]);

                $object_1 = $this->get('app.object');
                $objectId = $object_1->isValid($em, $db2, $keywordId_1, $usertypeId_1, $languageId);
                $objects[$i] = $objectId;
                
                $i++;
            }
            
            $topic_1 = $this->get('app.topic');
            $topicId_1 = $topic_1->isValid($em, $db2, $objects, $i);
            
            //////////////////////////////////////////////////////////////////////

            
//                var productId = data[i].product_id; 
//                var productName = data[i].product_name; 
//                var productPrice = data[i].price_value; 
//                var productDescription = data[i].product_description; 
//                var productImage = data[i].product_image; 
//                
//                var score = data[i].score; 
//                var description = data[i].description; 
                
            
            $tmp_query = $em->createQuery(
                "
                SELECT DISTINCT 
                
                tmp.topicmemberproductId, 
                tm.topicmemberId, 
                p.productId, 
                p.productName, 
                pr.amount, 
                c.currencyId, 
                c.currencyName, 
                p.productDescription, 
                p.productImage, 
                p.productScore 
                
                
                
                FROM HomeBundle:Topicmemberproduct tmp 
                
                JOIN HomeBundle:Product p 
                WITH p.productId = tmp.product 
                
                JOIN HomeBundle:Price pr 
                WITH pr.priceId = p.productPrice 
                
                JOIN HomeBundle:Currency c 
                WITH c.currencyId = pr.currency 
                
                JOIN HomeBundle:Topicmember tm 
                WITH tm.topicmemberId = tmp.topicmember 
                
                WHERE tm.topicmemberId = '$topicId_1' 
                "
            )
            ->setFirstResult($first_result)
            ->setMaxResults($max_results);
            
            $tmp_e = $tmp_query->getResult();
            $amountProducts = count($tmp_e);

            $i = 0;
            while (isset($tmp_e[$i]['topicmemberproductId']))
            {
                $topicmemberproductId_Value = $tmp_e[$i]['topicmemberproductId'];
                $topicmemberId_Value = $tmp_e[$i]['topicmemberId'];
                $productId_Value = $tmp_e[$i]['productId'];
                $productName_Value = $tmp_e[$i]['productName'];
                $amount_Value = $tmp_e[$i]['amount'];
                $currencyId_Value = $tmp_e[$i]['currencyId'];
                $currencyName_Value = $tmp_e[$i]['currencyName'];
                $productDescription_Value = $tmp_e[$i]['productDescription'];
                $productImage_Value = $tmp_e[$i]['productImage'];
                $productScore_Value = $tmp_e[$i]['productScore'];
                
                $locationData[$i] = array(
                    'topicmemberproductId' => $topicmemberproductId_Value,
                    'topicmemberId' => $topicmemberId_Value,
                    'productId' => $productId_Value,
                    'productName' => $productName_Value,
                    'amount' => $amount_Value,
                    'currencyId' => $currencyId_Value,
                    'currencyName' => $currencyName_Value,
                    'productDescription' => $productDescription_Value,
                    'productImage' => $productImage_Value,
                    'productScore' => $productScore_Value,
                    'topicId' => $topicId_1,
                    'amountProducts' => $amountProducts
                );
                
                $i++;
            }

            if ($i == 0)
            {
                $locationData[] = array(
                    'topicmemberproductId' => "_",
                    'topicmemberId' => "_",
                    'productId' => "_",
                    'productName' => "_",
                    'amount' => "_",
                    'currencyId' => "_",
                    'currencyName' => "_",
                    'productDescription' => "_",
                    'productImage' => "_",
                    'productScore' => "_",
                    'topicId' => $topicId_1,
                    'amountProducts' => $i
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}