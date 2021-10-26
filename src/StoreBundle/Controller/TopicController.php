<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TopicController extends Controller
{
    public function getTopicAction(Request $request)
    {
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
                
                $topics[$i_top] = $topicId_1;
                
                $i_top++;
            }
            
            
            
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => $i_top,
                'amountLocations' => $topics
            );
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}