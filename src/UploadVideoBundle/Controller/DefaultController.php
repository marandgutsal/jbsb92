<?php

namespace UploadVideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        return $this->render('UploadVideoBundle/Default/index.html.twig');
        return $this->render('@UploadVideo/Default/index.html.twig');
    }
    
    public function uploadVideoAction(Request $request)
    {
        $videoId = $_POST['video_id'];
        $userId = $_POST['user_id'];
        
        
        $user_dir = "files/".$userId."/";
        $file_dir = "files/".$userId."/".$videoId."/";
        
        if (!file_exists($user_dir))
        {
            mkdir($user_dir, 0777);
        }
        
        if (!file_exists($file_dir))
        {
            mkdir($file_dir, 0777);
        }
        
        opendir($file_dir);
        
        
        
        

        $video_status = "";
        $image_status = "";
        
        $filenameVideo = $_FILES['video_content']['tmp_name'];
//        $destinationVideo = $file_dir . $_FILES['video_content']['name'];
        $typeVideo = $_FILES['video_content']['type'];
        if ($typeVideo == "video/mp4") {
            $destinationVideo = $file_dir . $videoId . ".mp4";
            move_uploaded_file($filenameVideo, $destinationVideo);
        }

        $filenameImage = $_FILES['video_portrait']['tmp_name'];
//        $destinationImage = $file_dir . $_FILES['video_portrait']['name']."_hello";
        $typeImage = $_FILES['video_portrait']['type'];
        if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
            if($typeImage == "image/jpeg")
            {
                $destinationImage = $file_dir . $videoId . ".jpeg";
            }
            if($typeImage == "image/jpg")
            {
                $destinationImage = $file_dir . $videoId . ".jpg";
            }
            if($typeImage == "image/png")
            {
                $destinationImage = $file_dir . $videoId . ".png";
            }
            move_uploaded_file($filenameImage, $destinationImage);
        }
        
        $response = array();
        $response[0] = array(
            'video_status' => $video_status,
            'image_status' => $image_status
        );
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
    
    public function updateVideoAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $video_name_data = $_POST['video_name'];
            $video_description_data = $_POST['video_description'];
            $video_content_data = $_FILES['video_content']['name'];
            $video_portrait_data = $_FILES['video_portrait']['name'];

            
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
            else {
                $userId = 0;
            }

            $todayDate = date("Y-m-d");
            $videoUpdatedate = date_create_from_format('Y-m-d', $todayDate);

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
            $userName = $user->getUserName();
            
            $video = new \HomeBundle\Entity\Video();
            
            $video->setUser($user);
            $video->setVideoAmountComments(0);
            $video->setVideoAmountViews(0);
            $video->setVideoContent($video_content_data);
            $video->setVideoDescription($video_description_data);
            $video->setVideoImage($video_portrait_data);
            $video->setVideoScore(0);
            $video->setVideoName($video_name_data);
            $video->setVideoUpdatedate($videoUpdatedate);
            $video->setVideoCoinScore(0);
            $video->setVideoPeoplescore(0);
            
            $em->persist($video);
            $em->flush();

            $video_id = $video->getVideoId();
            
            $typeVideo = $_FILES['video_content']['type'];
            if ($typeVideo == "video/mp4") {
                $destinationVideo = $video_id . ".mp4";
            }
            
            $typeImage = $_FILES['video_portrait']['type'];
            if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                if($typeImage == "image/jpeg")
                {
                    $destinationImage = $video_id . ".jpeg";
                }
                if($typeImage == "image/jpg")
                {
                    $destinationImage = $video_id . ".jpg";
                }
                if($typeImage == "image/png")
                {
                    $destinationImage = $video_id . ".png";
                }
            }
            
            
            $video->setVideoContent($destinationVideo);
            $video->setVideoImage($destinationImage);
            
            $em->persist($video);
            $em->flush();
            
            $video_amount_comments = $video->getVideoAmountComments();
            $video_amount_views = $video->getVideoAmountViews();
            $video_content = $video->getVideoContent();
            $video_description = $video->getVideoDescription();
            $video_image = $video->getVideoImage();
            $video_score = $video->getVideoScore();
            $video_name = $video->getVideoName();
            $video_update_date = $video->getVideoUpdatedate();
            $video_update_dateString = $video_update_date->format('d-M-Y');
            $video_coin_score = $video->getVideoCoinScore();
            $video_people_score = $video->getVideoPeoplescore();
            
            
            $response[0] = array(
                'user' => $userId,
                'videoId' => $video_id,
                'videoAmountComments' => $video_amount_comments,
                'videoAmountViews' => $video_amount_views,
                'videoContent' => $video_content,
                'videoDescription' => $video_description,
                'videoImage' => $video_image,
                'videoScore' => $video_score,
                'videoName' => $video_name,
                'videoUpdatedate' => $video_update_dateString,
                'videoCoinScore' => $video_coin_score,
                'videoPeopleScore' => $video_people_score,
                'userName' => $userName
            );
            
            return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
            
        }
    }
    
    public function uploadKeywordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $currentKeyword_2 = $_POST['currentKeywordContent'];
        $videoId = $_POST['videoId'];
        
        $keyword_1 = $this->get('app.keyword');
        $keywordId_1 = $keyword_1->isValid($em, $currentKeyword_2);
        
        
        
        $keywordvideo_1 = $this->get('app.keywordvideo');
        $keywordvideoId_1 = $keywordvideo_1->isValid($em, $keywordId_1, $videoId);
            
        if ($request->isXMLHttpRequest()) {
            $response = array();
            $response[] = array(
                'keywordId' => "-",
                'keywordVideoId' => "-"
            );

            return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}