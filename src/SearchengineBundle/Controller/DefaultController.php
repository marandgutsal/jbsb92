<?php

namespace SearchengineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('@Searchengine/Default/index.html.twig');
    }

    public function searchKeywordAction(Request $request) {
        $keywords_entered_2 = $_POST["keyword"];
        $amountVideosViewed = $_POST["amountVideosViewed"];

        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $keyword_1 = $this->get('app.keyword');
            $keywordId_1 = $keyword_1->isValid($em, $keywords_entered_2);
            
            $video = $em->createQuery(
                "SELECT DISTINCT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoScore, v.videoCoinScore, 
                u.userId, u.userName 
                FROM HomeBundle:Video v 
                
                JOIN HomeBundle:User u 
                WITH u.userId = v.user 
                
                JOIN HomeBundle:Keywordvideo kv 
                WITH v.videoId = kv.video 
                
                JOIN HomeBundle:Keyword k 
                WITH kv.keyword = k.keywordId 
                
                WHERE k.keywordId = '$keywordId_1' 
                ORDER BY 
                v.videoCoinScore DESC, 
                v.videoScore DESC, 
                v.videoAmountViews DESC, 
                v.videoAmountComments DESC, 
                v.videoUpdatedate DESC
                "
            )
            ->setFirstResult($amountVideosViewed)
            ->setMaxResults(30);

            

            
            
            
            $videoInstance = $video->getResult();

            $amountVideos = 0;

            $m = 0;
            while (isset($videoInstance[$amountVideos]['videoId'])) {
                if (
                    file_exists("files/".$videoInstance[$m]['userId'].
                    "/".$videoInstance[$m]['videoId'].
                    "/".$videoInstance[$m]['videoImage'])
                    &&
                    file_exists("files/".$videoInstance[$m]['userId'].
                    "/".$videoInstance[$m]['videoId'].
                    "/".$videoInstance[$m]['videoContent'])
                )
                {
                    $amountVideos++;
                }
                $m++;
            }

            $i = 0;
            while (isset($videoInstance[$i]['videoId'])) {

                if (
                    file_exists("files/".$videoInstance[$i]['userId'].
                    "/".$videoInstance[$i]['videoId'].
                    "/".$videoInstance[$i]['videoImage'])
                    &&
                    file_exists("files/".$videoInstance[$i]['userId'].
                    "/".$videoInstance[$i]['videoId'].
                    "/".$videoInstance[$i]['videoContent'])
                )
                {
                    $videoUpdatedate = $videoInstance[$i]['videoUpdatedate'];
                    $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                    $videoAmountViews = $videoInstance[$i]['videoAmountViews'];
                    $videoAmountViewsFormat = number_format($videoAmountViews);

                    $videoAmountComments = $videoInstance[$i]['videoAmountComments'];
                    $videoAmountCommentsFormat = number_format($videoAmountComments);

                    $videoId_Value = $videoInstance[$i]['videoId'];
                    $videoName_Value = $videoInstance[$i]['videoName'];
                    $videoDescription_Value = $videoInstance[$i]['videoDescription'];
                    $videoImage_Value = $videoInstance[$i]['videoImage'];
                    $videoContent_Value = $videoInstance[$i]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoScore_Value = $videoInstance[$i]['videoScore'];
                    $videoCoinScore_Value = $videoInstance[$i]['videoCoinScore'];
                    $userId_Value = $videoInstance[$i]['userId'];
                    $userName_Value = $videoInstance[$i]['userName'];
                
                    $sendData[$i] = array(
                        'videoId' => $videoId_Value,
                        'videoName' => $videoName_Value,
                        'videoDescription' => $videoDescription_Value,
                        'videoImage' => $videoImage_Value,
                        'videoContent' => $videoContent_Value,
                        'videoUpdatedate' => $videoUpdatedate_Value,
                        'videoAmountViews' => $videoAmountViews_Value,
                        'videoAmountComments' => $videoAmountComments_Value,
                        'videoScore' => $videoScore_Value,
                        'videoCoinScore' => $videoCoinScore_Value,
                        'userId' => $userId_Value,
                        'userName' => $userName_Value,
                        'amountVideos' => $amountVideos
                    );
                }
                $i++;
            }

            if ($amountVideos === 0) {
                $videoId_Value = "_";
                $videoName_Value = "_";
                $videoDescription_Value = "_";
                $videoImage_Value = "_";
                $videoContent_Value = "_";
                $videoUpdatedate_Value = "_";
                $videoAmountViews_Value = "_";
                $videoAmountComments_Value = "_";
                $videoScore_Value = "_";
                $videoCoinScore_Value = "_";
                $userId_Value = "_";
                $userName_Value = "_";

                $sendData[0] = array(
                    'videoId' => $videoId_Value,
                    'videoName' => $videoName_Value,
                    'videoDescription' => $videoDescription_Value,
                    'videoImage' => $videoImage_Value,
                    'videoContent' => $videoContent_Value,
                    'videoUpdatedate' => $videoUpdatedate_Value,
                    'videoAmountViews' => $videoAmountViews_Value,
                    'videoAmountComments' => $videoAmountComments_Value,
                    'videoScore' => $videoScore_Value,
                    'videoCoinScore' => $videoCoinScore_Value,
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'amountVideos' => $amountVideos
                );
            }

            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    // replace by next functionName: manageTendenciesAction
    public function storeCurrentKeywordsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
            $useripId = 0;
        }
        else {
            $userId = 0;
            $useripId = $this->get_useripId($em);
        }
        
        $keywords_entered_2 = $_POST["keyword"];
        
        $keyword_1 = $this->get('app.keyword');
        $keywordId_1 = $keyword_1->isValid($em, $keywords_entered_2);
        
        $keyworduser_1 = $this->get('app.keyworduser');
        $keyworduserId_1 = $keyworduser_1->isValid($em, $keywordId_1, $userId, $useripId);
        
        if ($request->isXMLHttpRequest()) {
            $sendData[0] = array(
                'word_entered' => $keywordId_1
            );
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function get_useripId($em)
    {
        $geolocalization = $_SERVER["REMOTE_ADDR"];
        
        $existentedUserip = $em->createQuery(
            "SELECT ui.useripId 
            FROM HomeBundle:Userip ui 
            WHERE ui.useripGeolocalization = '$geolocalization'"
        );
        
        $existentedUserip_v = $existentedUserip->getResult();

        if (isset($existentedUserip_v[0]['useripId'])) {
            $useripId = $existentedUserip_v[0]['useripId'];
        } else {
            $useripId = $this->insertar_userip($geolocalization);
        }
        return $useripId;
    }
    
    public function insertar_userip($geolocalization)
    {
        $em = $this->getDoctrine()->getManager();
        $userip = new \HomeBundle\Entity\Userip;
        $userip->setUseripGeolocalization($geolocalization);
        $em->persist($userip);
        $em->flush();
        
        $existentedUserip = $em->createQuery(
            "SELECT ui.useripId 
            FROM HomeBundle:Userip ui 
            WHERE ui.useripGeolocalization = '$geolocalization'"
        );
        $existentedUserip_v = $existentedUserip->getResult();
        $useripId = $existentedUserip_v[0]['useripId'];
        
        return $useripId;
    }
}