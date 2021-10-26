<?php

namespace SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Session/Default/index.html.twig');
    }
    
    public function checkSessionAction(Request $request) {
//        session_unset();
//        session_destroy();
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
//                $amountFollowers = $this->get_amountFollowers($userId, $em);
//                $amountInfluencers = $this->get_amountInfluencers($userId, $em);
//                $amountVideos = $this->get_amountVideos($userId, $em);
//                $amountSpecificLists = $this->get_amountSpecificLists($userId, $em);

//                $user = $em->createQuery(
//                    "SELECT u.userId, u.userName, u.userFirstgivenname, 
//                    u.userSecondgivenname, u.userFirstfamilyname, u.userSecondfamilyname, 
//                    u.userEmail, u.userPassword, u.userBiography, l.locationId 
//                    FROM HomeBundle:User u 
//                    JOIN HomeBundle:Location l 
//                    WITH l.locationId = u.location 
//                    WHERE u.userId = $userId"
//                );
//
//                $users = $user->getResult();
//
//                $userId_Value = $users[0]['userId'];
//                $locationId_Value = $users[0]['locationId'];
//                $userName_Value = $users[0]['userName'];
//                $userFirstgivenname_Value = $users[0]['userFirstgivenname'];
//                $userSecondgivenname_Value = $users[0]['userSecondgivenname'];
//                $userFirstfamilyname_Value = $users[0]['userFirstfamilyname'];
//                $userSecondfamilyname_Value = $users[0]['userSecondfamilyname'];
//                $userEmail_Value = $users[0]['userEmail'];
//                $userPassword_Value = $users[0]['userPassword'];
//                $userBiography_Value = $users[0]['userBiography'];
//
//                $users2[] = array(
//                    'sessionStatus' => "1",
//                    'sessionId' => $userId_Value,
//                    'locationId' => $locationId_Value,
//                    'userName' => $userName_Value,
//                    'userFirstgivenname' => $userFirstgivenname_Value,
//                    'userSecondgivenname' => $userSecondgivenname_Value,
//                    'userFirstfamilyname' => $userFirstfamilyname_Value,
//                    'userSecondfamilyname' => $userSecondfamilyname_Value,
//                    'userEmail' => $userEmail_Value,
//                    'userPassword' => $userPassword_Value,
//                    'userBiography' => $userBiography_Value,
//                    'amountFollowers' => $amountFollowers,
//                    'amountInfluencers' => $amountInfluencers,
//                    'amountVideos' => $amountVideos,
//                    'amountSpecificLists' => $amountSpecificLists
//                );
                $users2[] = array(
                    'userId' => $userId
                );
            }
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function get_amountFollowers($userId, $em)
    {
        $followers = $em->createQuery(
            "SELECT u.userId 
            FROM HomeBundle:Follow f 
            JOIN HomeBundle:User u 
            WITH f.followInfluencer = u.userId 
            WHERE u.userId = '$userId'"
        );
        $followers_v = $followers->getResult();

        $amountFollowers = 0;
        while (isset($followers_v[$amountFollowers]['userId'])) {
            $amountFollowers++; // 
        }
        return $amountFollowers;
    }
    
    public function get_amountInfluencers($userId, $em)
    {
        $influencers = $em->createQuery(                    
            "SELECT u.userId 
            FROM HomeBundle:Follow f 
            JOIN HomeBundle:User u 
            WITH f.followFollower = u.userId 
            WHERE u.userId = '$userId'"
        );
        $influencers_v = $influencers->getResult();

        $amountInfluencers = 0;
        while (isset($influencers_v[$amountInfluencers]['userId'])) {
            $amountInfluencers++; // 
        }
        return $amountInfluencers;
    }
    
    public function get_amountVideos($userId, $em)
    {
        $videos = $em->createQuery(
            "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
            v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
            v.videoAmountComments, v.videoScore 
            FROM HomeBundle:Video v 
            JOIN HomeBundle:User u 
            WITH v.user = u.userId 
            WHERE u.userId = '$userId'"
        );
        $videos_v = $videos->getResult();

        $amountVideos = 0;
        while (isset($videos_v[$amountVideos]['videoId'])) {
            $amountVideos++; // this is a link to show the videos that belong to the user
        }
        return $amountVideos;
            
    }
    
    public function get_amountSpecificLists($userId, $em)
    {
        $specific_list = $em->createQuery(
            "SELECT sl.specificlistId, sl.specificlistName 
            FROM HomeBundle:Specificlist sl 
            JOIN HomeBundle:User u 
            WITH sl.user = u.userId 
            WHERE u.userId = '$userId'"
        );
        $specific_list_v = $specific_list->getResult();

        $amountSpecificLists = 0;
        while (isset($specific_list_v[$amountSpecificLists]['specificlistId'])) {
            $amountSpecificLists++; // this is another function, and another div 
        }

        return $amountSpecificLists;
    }
    
    
    
    
    
    
    

    public function logInUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $user_name = $_POST['user_name'];
        $user_password = $_POST["user_password"];

        $geolocalization33 = $_SERVER["REMOTE_ADDR"];

        if ($request->isXMLHttpRequest()) {

            $user = $em->createQuery(
                "SELECT u.userId, u.userName 
                FROM HomeBundle:User u 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );

            $users = $user->getResult();

            if (!$users) {
//                vacio
                $users2 = array();
                $users2[] = array(
                    'id' => "0",
                    'userName' => "0"
                );
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            } else {
//                lleno    
//                insertar login de sesion 
                $_SESSION['loginSession'] = $users[0]['userId'];

                $userId22 = $_SESSION['loginSession'];
                $userId = "start";

                $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId22);

                $login = new \HomeBundle\Entity\Login;
                
                $todayDate = date("Y-m-d");
                $todayDatetime_format = date_create_from_format('Y-m-d', $todayDate);
                
                $login->setLoginGeolocalization($geolocalization33);
                $login->setLoginHour($todayDatetime_format);
                $login->setUser($user);

                $em->persist($login);
                $em->flush();
                
                $users2 = array();
                $users2[] = array(
                    'id' => $users[0]['userId'],
                    'userName' => $users[0]['userName'],
                    'prueba123' => $userId
                );
                
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            }
        }
    }

    public function logOutUserAction(Request $request) {
        session_unset();
        session_destroy();
        if ($request->isXMLHttpRequest()) {
            $users2[] = array();
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    
    
    public function uploadProfilePhotoAction(Request $request)
    {
        $user_name = $_POST['user_name'];
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('HomeBundle:User')->findOneByUserName($user_name);
        $userId = $user->getUserId();
        
        $carpeta = "files/users/profilePhotos/" . $userId . "/";
        if (!file_exists($carpeta))
        {
            mkdir($carpeta, 0777);
        }
        opendir($carpeta);
        
        $filenameImage = $_FILES['user_profilePhoto_signUpInput']['tmp_name'];
        $destinationImage = $carpeta . $userId;
        $typeImage = $_FILES['user_profilePhoto_signUpInput']['type'];
        
        if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
            if ($typeImage == "image/jpeg")
            {
                $destinationImage_2 = $destinationImage . ".jpeg";
            }
            if ($typeImage == "image/jpg")
            {
                $destinationImage_2 = $destinationImage . ".jpg";
            }
            if ($typeImage == "image/png")
            {
                $destinationImage_2 = $destinationImage . ".png";
            }
            move_uploaded_file($filenameImage, $destinationImage_2);
        } else {
            //            $product_image = "xxx";
            //            ejecutar una acción que le diga al usuario que no se pudo subir la imagen
        }
        
        $response = array();
        $response[] = array(
            'variable' => "_._"
        );
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }
}