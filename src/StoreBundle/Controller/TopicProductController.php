<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TopicProductController extends Controller
{
    public function insertTopicProductAction(Request $request)
    {
        $product_id = $_POST['product_id'];
        $topic_array = $_POST['topic_array'];
        
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
        
                
            $languageId = 1;
            
            $i_top = 0;
            while (isset($topic_array[$i_top][0][0]))
            {
                $j = 0;
                while (isset($topic_array[$i_top][$j][0]) && isset($topic_array[$i_top][$j][1]))
                {
                    $keyword_1 = $this->get('app.keyword');
                    $keywordId_1 = $keyword_1->isValid($em, $topic_array[$i_top][$j][0]);
                    
                    $usertype_1 = $this->get('app.usertype');
                    $usertypeId_1 = $usertype_1->isValid($em, $topic_array[$i_top][$j][1]);
                    
                    $object_1 = $this->get('app.object');
                    $objectId = $object_1->isValid($em, $db2, $keywordId_1, $usertypeId_1, $languageId);
                    $objects[$i_top][$j] = $objectId;

                    $j++;
                }
                
                $topic_1 = $this->get('app.topic');
                $topicId_1 = $topic_1->isValid($em, $db2, $objects[$i_top], $j);
                
                
                
                $topicProduct_1 = $this->get('app.topicproduct');
                $topicProductId_1 = $topicProduct_1->isValid($em, $db2, $topicId_1, $product_id);
                
                
                $topics[$i_top] = $topicId_1;
                
                $i_top++;
            }
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
//            $em = $this->getDoctrine()->getManager();
//            
//            $em2 = $this->getDoctrine()->getEntityManager();
//            $db2 = $em2->getConnection();
//            

            
            
            
            
            
            
            
//            $locationData[] = array(
//                'locationId' => "-",
//                'locationName' => $i_top,
//                'amountLocations' => $topics
//            );
            
            
            $locationData[] = array(
                'locationId' => ":::",
                'locationName' => ":::",
                'amountLocations' => ":::"
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}