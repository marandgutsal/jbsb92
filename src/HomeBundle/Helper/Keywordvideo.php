<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Keywordvideo extends Controller {

    public $global_topicId = 0;
    
    public function isValid($em, $keywordId_1, $videoId)
    {
        $valor1 = $this->set_keywordVideo($em, $keywordId_1, $videoId);
        
        return $valor1;
    }
    
    public function set_keywordVideo($em, $keywordId_1, $videoId)
    {
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keywordId_1);
        $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId);
        
        $keywordVideo = new \HomeBundle\Entity\Keywordvideo;
        $keywordVideo->setKeyword($keyword);
        $keywordVideo->setVideo($video);
        $em->persist($keywordVideo);
        $em->flush();
        $keywordVideo_id = $keywordVideo->getKeywordvideoId();
        
        return $keywordVideo_id;
    }
}