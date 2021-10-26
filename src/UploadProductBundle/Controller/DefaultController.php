<?php

namespace UploadProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use UploadProductBundle\Controller\derf;


//use App\Services\Checker;


use HomeBundle\Helper;





//namespace HomeBundle\Helper;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@UploadProduct/Default/index.html.twig');
    }
    
    public function uploadProductAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }

        
        $product_id = $_POST['product_id'];
        $carpeta = "files/products/".$userId."/";
        
        if (!file_exists($carpeta))
        {
            mkdir($carpeta, 0777);
        }
        
        opendir($carpeta);

        $image_status = "";
        
        $filenameImage = $_FILES['product_image']['tmp_name'];
        
        $typeImage = $_FILES['product_image']['type'];
        if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
            
            if($typeImage == "image/jpeg")
            {
                $destinationImage = $carpeta . $product_id . ".jpeg";
            }
            if($typeImage == "image/jpg")
            {
                $destinationImage = $carpeta . $product_id . ".jpg";
            }
            if($typeImage == "image/png")
            {
                $destinationImage = $carpeta . $product_id . ".png";
            }
            move_uploaded_file($filenameImage, $destinationImage);
        }
        
        $response = array();
        $response[0] = array(
            'image_status' => $image_status
        );
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
    
    public function updateProductAction(Request $request)
    {
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $productName = $_POST['productName_uploadProductInput'];
            $productPrice = $_POST['productPrice_uploadProductInput'];
            $productDescription = $_POST['productDescription_uploadProductTextarea'];
            $productImage = $_FILES['productImage_uploadProductInput']['name'];
            

            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
        
            if ($request->isXMLHttpRequest()) {
                
                $typeImage = $_FILES["productImage_uploadProductInput"]['type'];
                if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                    if($typeImage == "image/jpeg")
                    {
                        $imageType = ".jpeg";
                    }
                    if($typeImage == "image/jpg")
                    {
                        $imageType = ".jpg";
                    }
                    if($typeImage == "image/png")
                    {
                        $imageType = ".png";
                    }
                }

                $em2 = $this->getDoctrine()->getEntityManager();
                $db2 = $em2->getConnection();

                $product_1 = $this->get('app.product');
                $productId_1 = $product_1->isValid($em, $db2, 
                        $userId, 
                        $productName, 
                        $productPrice, 
                        $productDescription, 
                        $productImage,
                        $imageType);
                
                $response[0] = array(
                    'product_id' => $productId_1
                );
                
                return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
            }
        }
    }
    
    public function uploadSecondaryImagesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $amount_images = $_POST['amount_images'];
        $product_id = $_POST['product_id'];
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        $carpeta = "files/products/secondaryImages/".$userId."/";
        
        if (!file_exists($carpeta))
        {
            mkdir($carpeta, 0777);
        }
        opendir($carpeta);
        
        $i=0;
        foreach($_FILES["secondaryImages_uploadProductInput"]['tmp_name'] as $key => $tmp_name)
        {   
            $filenameImage = $_FILES["secondaryImages_uploadProductInput"]['tmp_name'][$key];

            $productImage_id = "currentImage_id".$i;
            $destination_productImage = $_POST[$productImage_id];

            $typeImage = $_FILES["secondaryImages_uploadProductInput"]['type'][$key];
            if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {

                if($typeImage == "image/jpeg")
                {
                    $destinationImage = $carpeta . $destination_productImage . ".jpeg";
                }
                if($typeImage == "image/jpg")
                {
                    $destinationImage = $carpeta . $destination_productImage . ".jpg";
                }
                if($typeImage == "image/png")
                {
                    $destinationImage = $carpeta . $destination_productImage . ".png";
                }

                move_uploaded_file($filenameImage, $destinationImage);
            }
            
            $i++;
        }
        
        
        $image_status = "";
        
        $response = array();
        $response[0] = array(
            'image_status' => $image_status
        );
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
    
    public function updateSecondaryImagesAction(Request $request)
    {
        $product_id = $_POST['product_id'];
        
        $em = $this->getDoctrine()->getManager();
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }

        $amountImages = 0;
        foreach($_FILES["secondaryImages_uploadProductInput"]['tmp_name'] as $key => $tmp_name)
        {
            $amountImages++;
        }
        
        
        $i = 0;
        foreach($_FILES["secondaryImages_uploadProductInput"]['tmp_name'] as $key => $tmp_name)
        {
            if ($_FILES["secondaryImages_uploadProductInput"]['name'][$key]) {
                
                $typeImage = $_FILES["secondaryImages_uploadProductInput"]['type'][$key];
                if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                    
                    if($typeImage == "image/jpeg")
                    {
                        $imageType = ".jpeg";
                    }
                    if($typeImage == "image/jpg")
                    {
                        $imageType = ".jpg";
                    }
                    if($typeImage == "image/png")
                    {
                        $imageType = ".png";
                    }
                    
                }
                
                $product = $em->getRepository('HomeBundle:Product')->findOneByProductId($product_id);
                
                $productImage = new \HomeBundle\Entity\Productimage();
                $productImage->setProduct($product);
                $productImage->setProductimageImage("");
                $em->persist($productImage);
                $em->flush();
                
                
                $new_imageName = $productImage->getProductimageId();
                $productImage->setProductimageImage($new_imageName.$imageType);
                $em->persist($productImage);
                $em->flush();
                
                $productimageId = $productImage->getProductimageId();
                $productimage = $productImage->getProductimageImage();
                
                $response[$i] = array(
                    'productimageId' => $productimageId,
                    'productimage' => $productimage,
                    'amountImages' => $amountImages
                );
                $i++;
            }
        }
        
        

        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
    
    
    
    
    
    
    
    
    
    
    public function getCurrentArtistInformationAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $username = $_POST['username'];
            
            $userInformation = $em->createQuery(
                "SELECT u.userId, u.userName, u.userProfilephoto, u.userFirstgivenname, u.userSecondgivenname, 
                u.userFirstfamilyname, u.userSecondfamilyname, u.userEmail, u.userBiography 
                FROM HomeBundle:User u 
                WHERE u.userName = '$username'"
            );
            $userInformation_v = $userInformation->getResult();
            
            if (isset($userInformation_v[0]['userId']))
            {
                $userId_value = $userInformation_v[0]['userId'];
                $userName_value = $userInformation_v[0]['userName'];
                $userProfilephoto_value = $userInformation_v[0]['userProfilephoto'];
                $userFirstgivenname_value = $userInformation_v[0]['userFirstgivenname'];
                $userSecondgivenname_value = $userInformation_v[0]['userSecondgivenname'];
                $userFirstfamilyname_value = $userInformation_v[0]['userFirstfamilyname'];
                $userSecondfamilyname_value = $userInformation_v[0]['userSecondfamilyname'];
                $userEmail_value = $userInformation_v[0]['userEmail'];
                $userBiography_value = $userInformation_v[0]['userBiography'];                
            } else
            {
                $userId_value = "_";
                $userName_value = "_";
                $userProfilephoto_value = "_";
                $userFirstgivenname_value = "_";
                $userSecondgivenname_value = "_";
                $userFirstfamilyname_value = "_";
                $userSecondfamilyname_value = "_";
                $userEmail_value = "_";
                $userBiography_value = "_";
            }
            
            
            $artistInformation = array();
            $artistInformation[0] = array(
                'userId' => $userId_value,
                'userName' => $userName_value,
                'userProfilephoto' => $userProfilephoto_value,
                'userFirstgivenname' => $userFirstgivenname_value,
                'userSecondgivenname' => $userSecondgivenname_value,
                'userFirstfamilyname' => $userFirstfamilyname_value,
                'userSecondfamilyname' => $userSecondfamilyname_value,
                'userEmail' => $userEmail_value,
                'userBiography' => $userBiography_value
            );
            
            return new Response(json_encode($artistInformation), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getCurrentArtistSongsAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $username = $_POST['username'];
            
            $songInformation = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoScore, u.userId, u.userName 
                FROM HomeBundle:Video v 

                JOIN HomeBundle:User u 
                WITH u.userId = v.user 

                WHERE u.userName = '$username'

                ORDER BY v.videoAmountViews DESC"
            )
            ->setFirstResult(0)
            ->setMaxResults(300);

            $songInformation_v = $songInformation->getResult();
            
                        
            $amountVideos = count($songInformation_v);
            
            
            $i = 0;
            while (isset($songInformation_v[$i]['videoId'])) {
                
                    if (
                        file_exists("files/".$songInformation_v[$i]['userId'].
                        "/".$songInformation_v[$i]['videoId'].
                        "/".$songInformation_v[$i]['videoImage'])
                        &&
                        file_exists("files/".$songInformation_v[$i]['userId'].
                        "/".$songInformation_v[$i]['videoId'].
                        "/".$songInformation_v[$i]['videoContent'])
                    )
                    {
                        $videoUpdatedate = $songInformation_v[$i]['videoUpdatedate'];
                        $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                        $videoAmountViews = $songInformation_v[$i]['videoAmountViews'];
                        $videoAmountViewsFormat = number_format($videoAmountViews);

                        $videoAmountComments = $songInformation_v[$i]['videoAmountComments'];
                        $videoAmountCommentsFormat = number_format($videoAmountComments);
                        
                        $videoId_Value = $songInformation_v[$i]['videoId'];
                        $videoName_Value = $songInformation_v[$i]['videoName'];
                        $videoDescription_Value = $songInformation_v[$i]['videoDescription'];
                        $videoImage_Value = $songInformation_v[$i]['videoImage'];
                        $videoContent_Value = $songInformation_v[$i]['videoContent'];
                        $videoUpdatedate_Value = $videoUpdatedateString;
                        $videoAmountViews_Value = $videoAmountViewsFormat;
                        $videoAmountComments_Value = $videoAmountCommentsFormat;
                        $videoScore_Value = $songInformation_v[$i]['videoScore'];
                        $userId_Value = $songInformation_v[$i]['userId'];
                        $userName_Value = $songInformation_v[$i]['userName'];
                        $amountVideos_Value = $amountVideos;
                        
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
                        $amountVideos_Value = $amountVideos;
                    }
                
                $videoFromUser[$i] = array(                    
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
                    'amountVideos' => $amountVideos_Value
                );
                $i++;
            }
            
            if (isset($songInformation_v[0]['videoId'])) {
                
            } else
            {
                $videoFromUser[0] = array(                    
                    'videoId' => "_",
                    'videoName' => "_",
                    'videoDescription' => "_",
                    'videoImage' => "_",
                    'videoContent' => "_",
                    'videoUpdatedate' => "_",
                    'videoAmountViews' => "_",
                    'videoAmountComments' => "_",
                    'videoScore' => "_",
                    'userId' => "_",
                    'userName' => "_",
                    'amountVideos' => "_"
                );
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function insertKeywordProductAction(Request $request)
    {
        $topic = array();
        $topicMember = array();
        $topic[0][0] = "_";
        if ($request->isXMLHttpRequest()) {
            $productId = $_POST['productId'];
//            $productId = 12345;
            $topicAmount = $_POST['topicAmount'];
            $i = 0;
            while ($i <= $topicAmount) {
                $stringTopicMemberAmount = "topicMemberAmount".$i;
                
                if (isset($_POST[$stringTopicMemberAmount]))
                {
                    $topicMemberAmount = $_POST[$stringTopicMemberAmount];
                    $j = 0;
                    
                    while($j < $topicMemberAmount) {
                        if(
                            isset($_POST['keywordTopic_input'.$i.'_'.$j]) && 
                            isset($_POST['objectTopic_select'.$i.'_'.$j])
                        )
                        {
                            $KEYWORD_NAME = $_POST['keywordTopic_input'.$i.'_'.$j];
                            $USERTYPE_NAME = $_POST['objectTopic_select'.$i.'_'.$j];
                            
    //                        // append objectId to object_set
    //                        $objectId[$i][$j] = $this->insertObject($KEYWORD_NAME, $USERTYPE_NAME, $em);
    //                        
                            $topicMember[$j][0] = $KEYWORD_NAME;
                            $topicMember[$j][1] = $USERTYPE_NAME;
    //                        
    //                        $topicMember[$j] = "_";
    //                        $topicMember[$j] = "_";
                        }
                        $topic[$i][0] = $topicMember;
                        $topic[$i][1] = $topicMemberAmount;
                        // object_set
    //                    $this->insertTopic($objectId, $em, $topicAmount, $topicMemberAmount);
                        $j++;
                    }
                }
                $i++;
            }
            
            $em = $this->getDoctrine()->getManager();
            $em1 = $this->getDoctrine()->getManager('scores');
            $checker_1 = $this->get('app.checker');
            $topicId = $checker_1->isValid($em, $topic, $topicAmount, $productId);
            
            
            $users2 = array();
            $users2[0] = array(
                'variable' => $topicId
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    public function insertTopic($objectId, $em, $topicAmount, $topicMemberAmount)
    {
        $i = 0;
        while ($i <= $topicAmount) {

            $query_d .= "
                WHERE 
                ";

            $j = 0;
            while($j <= $topicMemberAmount) {
                $query_b .= "
                    JOIN HomeBundle:Topic t_$i._.$j 
                    WITH t.topicId = t_$i._.$j.topic 
                    ";
                
                $query_c .= "
                    JOIN HomeBundle:Object o_$i._.$j 
                    WITH tm.object = o_$i._.$j.objectId 
                    ";
                
                $query_d .= "
                    o_$i._.$j.objectId = $objectId 
                    ";
                
                if ($j < $topicMemberAmount)
                {
                    $query_d .= "
                        and 
                        ";
                }
            }
            
            $query = "
                SELECT DISTINCT 
                    t.topicId, 
                    tm.topicmemberId 
                    
                    FROM HomeBundle:Topic t 
                    
                    JOIN HomeBundle:Topicmember tm 
                    WITH tm.topic = t.topicId 
                    $query_b
                    $query_c
                    $query_d
                ";
            $query_i = $query->getResult();
            
            
            if (!isset($query_i[0]['topicId'])) {
                $selectedTopic = new \HomeBundle\Entity\Topic();
                $em->persist($selectedTopic);
                $em->flush();
                $topicId = $selectedTopic->getTopicId();
                
                
                
                
                
            } else
            {
                $topicId = $query_i[0]['topicId'];
            }
            return $topicId;
        }
            
    }
    
    public function insertObject($KEYWORD_NAME, $USERTYPE_NAME, $em)
    {
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($KEYWORD_NAME);
        $userType = $em->getRepository('HomeBundle:Usertype')->findOneByUsertypeClass($USERTYPE_NAME);
        
        if (!$keyword)
        {
            $selectedKeyword = new \HomeBundle\Entity\Keyword();
            $selectedKeyword->setKeywordContent($KEYWORD_NAME);
            $selectedKeyword->setKeywordScore(0);
            $em->persist($selectedKeyword);
            $em->flush();
            $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($KEYWORD_NAME);
        }
                        
        $object = $em->createQuery(
            "SELECT DISTINCT 
                o.objectId, o.objectScore, 
                k.keywordId, k.keywordContent, 
                ut.usertypeId, ut.usertypeClass 

            FROM HomeBundle:Object o 

            JOIN HomeBundle:Keyword k 
            WITH o.keyword = o.objectId 

            JOIN HomeBundle:Usertype ut 
            WITH o.usertype = ut.usertypeId 

            WHERE k.keywordContent = '$KEYWORD_NAME' and ut.usertypeClass = '$USERTYPE_NAME' 
            "
        );
        
        $object_i = $object->getResult();

        if (!isset($object_i[0]['objectId'])) {
            $selectedObject = new \HomeBundle\Entity\Object();
            $selectedObject->setKeyword($keyword);
            $selectedObject->setUsertype($userType);
            $selectedObject->setObjectScore(0);
            $em->persist($selectedObject);
            $em->flush();
            $objectId = $selectedObject->getObjectId();
        } else
        {
            $objectId = $object_i[0]['objectId'];
        }
        return $objectId;
    }
    
    public function insertKeyword($em, $productKeyword_Value)
    {
        $kewywordInformation = $em->createQuery(
            "SELECT DISTINCT k.keywordId, k.keywordContent 
            FROM HomeBundle:Keyword k 

            WHERE k.keywordContent = '$productKeyword_Value'
            "
        );

        $kewywordInformation_v = $kewywordInformation->getResult();
        if (isset($kewywordInformation_v[0]['keywordId']))
        {
            $keyword_id = $kewywordInformation_v[0]['keywordId'];
        } else
        {
            $keyword = new \HomeBundle\Entity\Keyword();
            $keyword->setKeywordContent($productKeyword_Value);
            $keyword->setKeywordScore(0);
            $em->persist($keyword);
            $em->flush();

            $keyword_id = $keyword->getKeywordId();
        }
        return $keyword_id;
    }
    
    public function insertKeywordProduct($em, $keyword_id, $product_id)
    {
        $productKewywordInformation = $em->createQuery(
            "SELECT DISTINCT kp.keywordproductId 
            FROM HomeBundle:Keywordproduct kp 

            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = kp.keyword 

            WHERE k.keywordId = '$keyword_id' 
            "
        );

        $productKewywordInformation_v = $productKewywordInformation->getResult();

        if (isset($productKewywordInformation_v[0]['keywordproductId']))
        {

        } else
        {
            $product = $em->getRepository('HomeBundle:Product')->findOneByProductId($product_id);
            $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordId($keyword_id);

            $keywordProduct = new \HomeBundle\Entity\Keywordproduct();
            $keywordProduct->setKeyword($keyword);
            $keywordProduct->setProduct($product);
            $em->persist($keywordProduct);
            $em->flush();
        }
    }

    public function getProductTypeAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $productType_value = $_POST['productType_value'];
//            WHERE pt.producttypeName = '$productType_value' 
            $productTypeInformation = $em->createQuery(
                "SELECT DISTINCT pt.producttypeName, pt.producttypeId 
                FROM HomeBundle:Producttype pt 

                WHERE pt.producttypeName LIKE '%$productType_value%' 
                
                ORDER BY pt.producttypeScore DESC"
            )
            ->setFirstResult(0)
            ->setMaxResults(30);

            $productTypeInformation_v = $productTypeInformation->getResult();
            $productTypeVideosAmount = count($productTypeInformation_v);
            
            $i = 0;
            while (isset($productTypeInformation_v[$i]['producttypeId'])) {
                $producttypeId_value = $productTypeInformation_v[$i]['producttypeId'];
                $producttypeName_value = $productTypeInformation_v[$i]['producttypeName'];
                
                $productType[$i] = array(                    
                    'producttypeId' => $producttypeId_value,
                    'producttypeName' => $producttypeName_value,
                    'productTypeVideosAmount' => $productTypeVideosAmount
                );
                $i++;
            }


            if (isset($productTypeInformation_v[0]['producttypeId'])) {
                $producttypeId_value = $productTypeInformation_v[0]['producttypeId'];
                $this->increase_score_productType($producttypeId_value, $em);
            } else
            {
                $this->insert_productType($productType_value, $em);
                $productType[0] = array(
                    'producttypeId' => "_",
                    'producttypeName' => "_",
                    'productTypeVideosAmount' => $productTypeVideosAmount
                );
            }
            
            return new Response(json_encode($productType), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function increase_score_productType($producttypeId_value, $em)
    {
        $productType = $em->getRepository('HomeBundle:Producttype')->findOneByProducttypeId($producttypeId_value);
        $score = $productType->getProducttypeScore();
        $newScore = $score + 1;
        $productType->setProducttypeScore($newScore);
        $em->persist($productType);
        $em->flush();
    }
    
    public function insert_productType($productType_value, $em)
    {
        $productType = new \HomeBundle\Entity\Producttype();
        $productType->setProducttypeName($productType_value);
        $productType->setProducttypeScore(0);
        $em->persist($productType);
        $em->flush();
    }
    

    
    public function drawImagesAboutStockAction(Request $request)
    {
        $productId = $_POST['productId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $stockInformation_images = $em->createQuery(
                "SELECT p.productId, pi.productimageId, pi.productimageImage, u.userId 
                FROM HomeBundle:Product p 

                JOIN HomeBundle:Productimage pi 
                WITH pi.product = p.productId 

                JOIN HomeBundle:User u 
                WITH u.userId = p.user 

                WHERE p.productId = '$productId'"
            );
            $stockInformation_images_v = $stockInformation_images->getResult();

            $amountImages = count($stockInformation_images_v);
            
            $i = 0;
            while (isset($stockInformation_images_v[$i]['productId'])) {

                if ($stockInformation_images_v) {
                    if (
                        file_exists("files/products/secondaryImages/".$stockInformation_images_v[$i]['userId'].
                        "/".$stockInformation_images_v[$i]['productId'].
                        "/".$stockInformation_images_v[$i]['productimageImage'])
                    )
                    {
                        $productimageImage_Value = $stockInformation_images_v[$i]['productimageImage'];
                    }
                    else
                    {
                        $productimageImage_Value = "_";
                    }
                    $productimageId_Value = $stockInformation_images_v[$i]['productimageId'];
                    $userId_Value = $stockInformation_images_v[$i]['userId'];
                    $productId_Value = $stockInformation_images_v[$i]['productId'];
                } else {
                    $productimageId_Value = "_";
                    $productimageImage_Value = "_";
                    $userId_Value = "_";
                    $productId_Value = "_";
                }

                $sendData[$i] = array(
                    'productimageId' => $productimageId_Value,
                    'productimageImage' => $productimageImage_Value,
                    'userId' => $userId_Value,
                    'productId' => $productId_Value,
                    'amountImages' => $amountImages
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $sendData[0] = array(
                    'productimageId' => "_",
                    'productimageImage' => "_",
                    'userId' => "_",
                    'productId' => "_",
                    'amountImages' => $amountImages
                );
            }
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getStockId($stockId)
    {
        $em = $this->getDoctrine()->getManager();

        $stockInformation = $em->createQuery(
            "SELECT s.stockId 
            FROM HomeBundle:Stock s 
            WHERE s.stockId = '$stockId'"
        );
        $stockInformation_v = $stockInformation->getResult();
        
        if ($stockInformation_v[0]['stockId'])
        {
            $stockId_value = $stockInformation_v[0]['stockId'];               
        } else
        {
            $stockId_value = "_";
        }
        
        return $stockId_value;
    }
}