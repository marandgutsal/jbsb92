<?php

namespace DataminingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function getKeywordUsersAction(Request $request)
    {
        $keywordsAmount_value = $_POST['keywordsAmount_value'];
        $languageId = 1;
        $locationId = 1;
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
                $dataminingLocation_1 = $this->get('app.dataminiglistlocation');
                $locationId = $dataminingLocation_1->getLocation_byUser($userId, $db2, $em);
                
                $dataminingLocation_2 = $this->get('app.dataminiglistlocation');
                $results = $dataminingLocation_2->getKeywordUser($em, $userId, $keywordsAmount_value);
            }
            
//            $results[] = array(
//                'keywordId' => 1,
//                'keywordContent' => "-",
//                'amountKeywords' => 1
//            );
            
            return new Response(json_encode($results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getDataminingLocationAction(Request $request)
    {
        $keywordsAmount_value = $_POST['keywordsAmount_value'];
        $this_location = $_POST['this_location'];
        $languageId = 1;
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $em = $this->getDoctrine()->getManager();
            
            if ($this_location == 1)
            {
                if (isset($_SESSION['loginSession'])) {
                    $userId = $_SESSION['loginSession'];

                    $dataminingLocation_1 = $this->get('app.dataminiglistlocation');
                    $locationId = $dataminingLocation_1->getLocation_byUser($userId, $db2, $em);
                } else
                {
                    $locationId = 1;
                }
            } else
            {
                $locationId = $this_location;
            }
            
            $dataminingResults_1 = $this->get('app.dataminiglistlocation');
            $results = $dataminingResults_1->getDatamining_byLocation($em, $keywordsAmount_value, $locationId);
            
//            $results[] = array(
//                'keywordId' => 1,
//                'keywordContent' => "+",
//                'amountKeywords' => 1
//            );
            
            return new Response(json_encode($results), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function getVideosPerKeywordUsersAction(Request $request)
    {
        $keywordId = $_POST['keywordId'];
        $keywordContent = $_POST['keywordContent'];
        $videosAmount_value = $_POST['videosAmount_value'];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $video = $em->createQuery(
                "SELECT DISTINCT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoScore, 
                u.userId, u.userName, 
                k.keywordId, k.keywordContent 

                FROM HomeBundle:Video v 

                JOIN HomeBundle:User u 
                WITH u.userId = v.user 

                JOIN HomeBundle:Keywordvideo kv 
                WITH kv.video = v.videoId 

                JOIN HomeBundle:Keyword k 
                WITH k.keywordId = kv.keyword 

                WHERE k.keywordId = '$keywordId'
                "
            )
            ->setFirstResult($videosAmount_value)
            ->setMaxResults(10);

            $video_e = $video->getResult();
            $amountVideos = 0;
            while (isset($video_e[$amountVideos]['videoId']))
            {
                $amountVideos++;
            }
            $videos = 0;
            while (isset($video_e[$videos]['videoId'])) {
                
                if (
                    file_exists("files/".$video_e[$videos]['userId'].
                    "/".$video_e[$videos]['videoId'].
                    "/".$video_e[$videos]['videoImage'])
                    &&
                    file_exists("files/".$video_e[$videos]['userId'].
                    "/".$video_e[$videos]['videoId'].
                    "/".$video_e[$videos]['videoContent'])
                )
                {
                    $videoUpdatedate = $video_e[$videos]['videoUpdatedate'];
                    $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                    $videoAmountViews = $video_e[$videos]['videoAmountViews'];
                    $videoAmountViewsFormat = number_format($videoAmountViews);

                    $videoAmountComments = $video_e[$videos]['videoAmountComments'];
                    $videoAmountCommentsFormat = number_format($videoAmountComments);

                    $videoId_Value = $video_e[$videos]['videoId'];
                    $videoName_Value = $video_e[$videos]['videoName'];
                    $videoDescription_Value = $video_e[$videos]['videoDescription'];
                    $videoImage_Value = $video_e[$videos]['videoImage'];
                    $videoContent_Value = $video_e[$videos]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoScore_Value = $video_e[$videos]['videoScore'];
                    $userId_Value = $video_e[$videos]['userId'];
                    $userName_Value = $video_e[$videos]['userName'];
                    $keywordId_Value = $video_e[$videos]['keywordId'];
                    $keywordContent_Value = $video_e[$videos]['keywordContent'];
                } else
                {
                    $videoId_Value = "_";
                    $videoName_Value = "_";
                    $videoDescription_Value = "_";
                    $videoImage_Value = "_";
                    $videoContent_Value = "_";
                    $videoUpdatedate_Value = "_";
                    $videoAmountViews_Value = "_";
                    $videoAmountComments_Value = "_";
                    $videoScore_Value = "_";
                    $userId_Value = "_";
                    $userName_Value = "_";
                    $keywordId_Value = "_";
                    $keywordContent_Value = "_";
                }
                
                    $videosInformation[$videos] = array(
                        'videoId' => $videoId_Value,
                        'videoName' => $videoName_Value,
                        'videoDescription' => $videoDescription_Value,
                        'videoImage' => $videoImage_Value,
                        'videoContent' => $videoContent_Value,
                        'videoUpdatedate' => $videoUpdatedate_Value,
                        'videoAmountViews' => $videoAmountViews_Value,
                        'videoAmountComments' => $videoAmountComments_Value,
                        'videoScore' => $videoScore_Value,
                        'userId' => $userId_Value,
                        'userName' => $userName_Value,
                        'keywordId' => $keywordId_Value,
                        'keywordContent' => $keywordContent_Value,
                        'amountVideos' => $amountVideos
                    );

                $videos++;
            }
            
            if ($videos === 0)
            {
                $videosInformation[0] = array(
                    'videoId' => 0,
                    'videoName' => "",
                    'videoDescription' => "",
                    'videoImage' => "",
                    'videoContent' => "",
                    'videoUpdatedate' => "",
                    'videoAmountViews' => 0,
                    'videoAmountComments' => 0,
                    'videoScore' => 0,
                    'userId' => 0,
                    'userName' => "",
                    'keywordId' => $keywordId,
                    'keywordContent' => $keywordContent,
                    'amountVideos' => 0
                );
            }
            
            return new Response(json_encode($videosInformation), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteKeywordUserAction(Request $request)
    {
        $keyword = $_POST['keyword'];
        
        if ($request->isXMLHttpRequest()) {

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $query2 = "
                DELETE FROM `keywordUser` 
                WHERE `keywordUser`.`user_id` = $userId and 
                     `keywordUser`.`keyword_id` = $keyword 
            ";

            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $locationData[] = array(
                'locationId' => "-",
                'locationName' => "-",
                'amountLocations' => 0
            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}