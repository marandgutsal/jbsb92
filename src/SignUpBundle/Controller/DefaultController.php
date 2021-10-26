<?php

namespace SignUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use SignUpBundle\Helper;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@SignUp/Default/index.html.twig');
    }
    
    public function signUpAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $user_name_signUpInput = $_POST['user_name'];
            $user_firstGivenName_signUpInput = $_POST['user_firstGivenName'];
            $user_secondGivenName_signUpInput = $_POST['user_secondGivenName'];
            $user_firstFamilyName_signUpInput = $_POST['user_firstFamilyName'];
            $user_secondFamilyName_signUpInput = $_POST['user_secondFamilyName'];
            $user_email_signUpInput = $_POST['user_email'];
            $user_password_signUpInput = $_POST['user_password'];
            $user_biography_signUpTextarea = $_POST['user_biography'];
            $user_profilePhoto_signUpInput = $_POST['user_profilePhoto'];
            $user_location_signUpInput = $_POST['user_location'];
            
            $filenameImage_data = $_FILES['user_profilePhoto_file']['name'];
            $filenameImage = $_FILES['user_profilePhoto_file']['tmp_name'];
            $typeImage = $_FILES['user_profilePhoto_file']['type'];
            $typeImage_name = "";
            if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                if($typeImage == "image/jpeg")
                {
                    $typeImage_name = ".jpeg";
                }
                if($typeImage == "image/jpg")
                {
                    $typeImage_name = ".jpg";
                }
                if($typeImage == "image/png")
                {
                    $typeImage_name = ".png";
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            
            $location = $em->getRepository('HomeBundle:Location')->findOneByLocationId($user_location_signUpInput);
            
            // unicidad del correo electronico, username 
            
            $query = $em->createQuery(
                "SELECT u.userId, u.userProfilephoto, u.userName, u.userFirstgivenname, 
                        u.userSecondgivenname, u.userFirstfamilyname, u.userSecondfamilyname, 
                        u.userEmail, u.userPassword, u.userBiography, u.userScore, lo.locationId 
                FROM HomeBundle:User u 
                
                JOIN HomeBundle:Location lo 
                WITH lo.locationId = u.location 
                
                WHERE u.userName = '$user_name_signUpInput' or u.userEmail = '$user_email_signUpInput' 
                "
            );
            $user_v = $query->getResult();
            
            if (isset($user_v[0]['userId'])) {
                $user_id = $user_v[0]['userId'];
                $user_name = $user_v[0]['userName'];
                $user_firstGivenName = $user_v[0]['userFirstgivenname'];
                $user_secondGivenName = $user_v[0]['userSecondgivenname'];
                $user_firstFamilyName = $user_v[0]['userFirstfamilyname'];
                $user_secondFamilyName = $user_v[0]['userSecondfamilyname'];
                $user_email = $user_v[0]['userEmail'];
                $user_password = $user_v[0]['userPassword'];
                $user_biography = $user_v[0]['userBiography'];
                $user_location = $user_v[0]['locationId'];
                $user_profilePhoto = $user_v[0]['userProfilephoto'];
            } else {
                $user = new \HomeBundle\Entity\User;
                $user->setUserProfilephoto($user_profilePhoto_signUpInput);
                $user->setUserName($user_name_signUpInput);
                $user->setUserFirstgivenname($user_firstGivenName_signUpInput);
                $user->setUserSecondgivenname($user_secondGivenName_signUpInput);
                $user->setUserFirstfamilyname($user_firstFamilyName_signUpInput);
                $user->setUserSecondfamilyname($user_secondFamilyName_signUpInput);
                $user->setUserEmail($user_email_signUpInput);
                $user->setUserPassword($user_password_signUpInput);
                $user->setUserBiography($user_biography_signUpTextarea);
                $user->setUserScore(0);
                $user->setLocation($location);
                $em->persist($user);
                $em->flush();
                
                $user_id = $user->getUserId();
                $user_name = $user->getUserName();
                $user_firstGivenName = $user->getUserFirstgivenname();
                $user_secondGivenName = $user->getUserSecondgivenname();
                $user_firstFamilyName = $user->getUserFirstfamilyname();
                $user_secondFamilyName = $user->getUserSecondfamilyname();
                $user_email = $user->getUserEmail();
                $user_password = $user->getUserPassword();
                $user_biography = $user->getUserBiography();
                $user_location = $user->getLocation();
                $user_profilePhoto = $user->getUserProfilephoto();
                
                $user->setUserProfilephoto($user_id.$typeImage_name);
                $em->persist($user);
                $em->flush();
            }
            
            $users2[0] = array(
                'userId' => $user_id,
                'userProfilephoto' => $user_profilePhoto,
                'userName' => $user_name,
                'userFirstgivenname' => $user_firstGivenName,
                'userSecondgivenname' => $user_secondGivenName,
                'userFirstfamilyname' => $user_firstFamilyName,
                'userSecondfamilyname' => $user_secondFamilyName,
                'userEmail' => $user_email,
                'userPassword' => $user_password,
                'userBiography' => $user_biography,
                'location' => $user_location
            );
            
//            $users2[0] = array();
            
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function byParent($locationParent)
    {
        $query_keyword = "
        SELECT DISTINCT 
            lo.location_id as locationId, 
            lo.location_name as locationName, 
            lp.location_id as locationParent, 
            lo.territoriality as territorialityChild, 
            lp.territoriality as territorialityParent 
            
            FROM Location as lo 
            
            INNER JOIN Location as lp ON lp.location_id = lo.location_parent 
            
            INNER JOIN Territoriality as t ON t.parent_id = lp.territoriality 
            
            WHERE lo.location_parent = $locationParent 
                
            and lo.territoriality = t.territoriality_id 
            
            GROUP BY lo.location_id 
            ORDER BY lo.location_id DESC 
            LIMIT 0, 300 
        ";
        
        return $query_keyword;
    }
    
    public function bySearch($insertedLocation, $language, $locationParent)
    {
        $respectly_string = "";
        $i = 0;
        while (isset($insertedLocation[$i])) {

            if ($i==0) {
                $respectly_string .= " and ( ";
            }
            $respectly_string .= " k.keyword_content = '$insertedLocation[$i]' ";
            $j = $i + 1;
            if (isset($insertedLocation[$j])) {
                $respectly_string .= " or ";
            } else {
                $respectly_string .= " ) ";
            }
                
            $i++;
        }
        
        $query_keyword = "
        SELECT DISTINCT 
            lo.location_id as locationId, 
            lo.location_name as locationName, 
            lp.location_id as locationParent, 
            k.keyword_content as keywordContent, 
            lo.territoriality as territoriality 

            FROM Keywordlocation as kl 

            INNER JOIN Location as lo ON kl.location_id = lo.location_id 
            INNER JOIN Keyword as k ON kl.keyword_id = k.keyword_id 
            INNER JOIN Language as la ON kl.language_id = la.language_id 
            INNER JOIN Location as lp ON lp.location_id = lo.location_parent 
            
            INNER JOIN Territoriality as t ON t.parent_id = lp.territoriality 
            
            WHERE lp.location_id = $locationParent and 
            la.language_id = $language 
            $respectly_string 
                
            and lo.territoriality = t.territoriality_id 

            GROUP BY lo.location_id 
            ORDER BY lo.location_id DESC 
            LIMIT 0, 300 
        ";
        
        return $query_keyword;
    }
    
    public function getTerritoriality($locationParent)
    {
        $territoriality_query = "
        SELECT DISTINCT 
            lo.territoriality as territorialityParent, 
            t_ch.territoriality_id as territorialityChild 
            
            FROM Location as lo 
            
            INNER JOIN Territoriality as t ON t.territoriality_id = lo.territoriality 
            
            INNER JOIN Territoriality as t_ch ON t_ch.parent_id = t.territoriality_id 
            
            WHERE lo.location_parent = $locationParent 
        ";
        
        $em2 = $this->getDoctrine()->getEntityManager();
        $db3 = $em2->getConnection();
        
        $stmt2 = $db3->prepare($territoriality_query);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $territoriality = 1;
        foreach($cursos2 as $curso)
        {
            $territoriality = $curso["territorialityChild"];
        }
        return territoriality;
    }
    
    public function getLocationAction(Request $request)
    {
        $locationParent = $_POST["locationParent"];
        $language = $_POST["language"];
        $insertedLocation = $_POST["insertedLocation"];
        $event = $_POST["event"];
        $territoriality = $_POST["territoriality"];
        
        $territoriality++;
        
        ////////////////////////////////////////////////////////////////////////////
        
        if ($request->isXMLHttpRequest()) {
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            if ($insertedLocation[0] === "02%ds_A")
            {
                $query_keyword = $this->byParent($locationParent);
            } else
            {
                $query_keyword = $this->bySearch($insertedLocation, $language, $locationParent);
            }
            
            $stmt2 = $db2->prepare($query_keyword);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $j = 0;
            foreach($cursos2 as $curso)
            {
                $locationData[] = array(
                    'locationId' => $curso["locationId"],
                    'locationName' => $curso["locationName"],
                    'locationParent' => $curso["locationParent"]
                );
                
                $j++;
            }
            
            $territoriality_name = $this->getTerritoriality_name($language, $territoriality);
            if ($territoriality >= 8 && $territoriality <= 10)
            {
                $option_id[0] = "other";
                $option_id[1] = "finish";
                
                $option_name[0] = "other ".$territoriality_name;
                $option_name[1] = "finish here";
            } else if ($territoriality >= 0 && $territoriality <= 10)
            {
                $option_id[0] = "other";
                $option_name[0] = "other ".$territoriality_name;
            } else
            {
                $option_id[0] = "other";
                $option_name[0] = "other ".$territoriality_name;
            }
            
            if ($j == 0)
            {
                if ($event == "insert_newChild")
                {
                    $process = "emptyChild";
                }
                if ($event == "getChild_bySearch")
                {
                    $process = "insertLocationIcon";
                }
                if ($event == "getChild_byParent")
                {
                    $process = "finishLocationIcon";
                }
                $amountRecords = 0;
                $locationData[] = array(
                    'locationId' => 0,
                    'locationName' => 0,
                    'locationParent' => 0
                );
            } else
            {
                $process = "newLocationChild";
            }
            
            $options[] = array(
                'optionId' => $option_id,
                'optionName' => $option_name,
                'process' => $process,
                'amountLocations' => $amountRecords,
                'territoriality' => $territoriality
            );
            
            $locationData_3456[0] = array(
                'locationData' => $locationData,
                'options' => $options
            );
            return new Response(json_encode($locationData_3456), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getTerritoriality_name($language, $territoriality)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();

        $query_keyword = "
            SELECT DISTINCT 
                k.keyword_content as keywordContent, 
                t.territoriality_id as territorialityId 
                
                FROM Keyword as k 
                INNER JOIN Keywordterritoriality as kt ON kt.keyword_id = k.keyword_id 
                INNER JOIN Language as l ON l.language_id = kt.language_id 
                INNER JOIN Territoriality as t ON kt.territoriality_id = t.territoriality_id 
                
                WHERE l.language_id = $language and t.territoriality_id = $territoriality 
        ";

        $stmt2 = $db2->prepare($query_keyword);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $territoriality_name = " - ";
        foreach($cursos2 as $curso)
        {
            $territoriality_name = $curso["keywordContent"];
        }
        
        return $territoriality_name;
    }
    
    
    public function searchLanguageAction(Request $request)
    {
        $language = $_POST["language"];
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $language = $em->getRepository('HomeBundle:Language')->findOneByLanguageName($language);
            $languageId = $language->getLanguageId();
            $languageName = $language->getLanguageName();
            
            $locationData[] = array(
                'languageId' => $languageId, 
                'languageName' => $languageName
            );
//            $locationData[] = array(
//                'languageId' => $languageId
//            );
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function insertLocationAction(Request $request)
    {
        $array_geoposition = $_POST["array_geoposition"];
        $description_geoposition = $_POST["description_geoposition"];
        $language = $_POST["language"];
        
        $em = $this->getDoctrine()->getManager();
        
        $location_id = $this->insertNewLocation($array_geoposition, $description_geoposition, $language);
        
        $locationData[] = array(
            'total' => 1, 
            'location_id' => $location_id, 
            'location_name' => "_" 
        );
        
        if ($request->isXMLHttpRequest()) {
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function insertNewLocation($array_geoposition, $description_geoposition, $language_id)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $i = 0;
        while (isset($array_geoposition[$i]))
        {
            if ($description_geoposition[$i] == "a") // insert location (have to insert, to exist)
            {
                if ($i > 0)
                {
                    $k = $i - 1;
                    
                    $location_parent = $array_geoposition[$k];
                } else
                {
                    $location_parent = 1;
                }
                $territoriality_id = $this->get_territoriality_id($location_parent, $db2);
                $new_location_name = $array_geoposition[$i][0];
                
                $locationChild_Id = $this->check_location($new_location_name, $location_parent, $territoriality_id);
                $this->insert_keywordLocation($locationChild_Id, $array_geoposition[$i], $language_id);
                
                $array_geoposition[$i] = $locationChild_Id;
                $description_geoposition[$i] = "b";
            }
            $i++;
        }
        return $locationChild_Id;
    }
    
    public function get_territoriality_id($locationParent, $db2)
    {
        $query_keyword = "
        SELECT DISTINCT 
            t_child.territoriality_id as territorialityChild 
            
            FROM Location as lp 

            INNER JOIN Territoriality as t ON t.parent_id = lp.territoriality 
            
            INNER JOIN Territoriality as t_child ON t_child.territoriality_id = t.territoriality_id 
            
            WHERE lp.location_id = $locationParent 
        ";
        
        $stmt2 = $db2->prepare($query_keyword);
        $params2 = array();
        $stmt2->execute($params2);
        
        $cursos2 = $stmt2->fetchAll();
        
        $territoriality_id = 1;
        foreach($cursos2 as $curso)
        {
            $territoriality_id = $curso["territorialityChild"];
        }
        
        return $territoriality_id;
    }
    
    public function check_location($location_name, $location_parent, $territoriality_id)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        
        //////////////////////////////////////////////////////////////////////////////////////
        
        $query2 = "
        SELECT DISTINCT 
            lo.location_id as locationId 
            
            FROM Location as lo 
            
            WHERE lo.location_name = '$location_name' and 
                lo.location_parent = '$location_parent' and 
                lo.territoriality = '$territoriality_id' 
                
            GROUP BY lo.location_id 
            ORDER BY lo.location_id DESC 
            LIMIT 0, 300 
        ";
        
        $stmt2 = $db2->prepare($query2);
        $params2 = array();
        $stmt2->execute($params2);
        
        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        foreach($cursos2 as $curso)
        {
            $locationId = $curso["locationId"];
        }
        
        if ($amountRecords == 0)
        {
            $query1 = "
                INSERT INTO `location`(
                `location_name`, 
                `location_parent`, 
                `territoriality`) 
                VALUES (
                '$location_name',
                '$location_parent',
                '$territoriality_id')
            ";

            $stmt1 = $db2->prepare($query1);
            $params1 = array();
            $stmt1->execute($params1);
            
            $locationId = $this->check_location($location_name, $location_parent, $territoriality_id);
        }
        
        return $locationId;
    }
    
    public function check_keyword($keyword)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $query1 = "
        SELECT DISTINCT 
            k.keyword_id as keywordId 

            FROM Keyword as k 

            WHERE k.keyword_content = '$keyword' 
        ";

        $stmt2 = $db2->prepare($query1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $keyword_id = $curso["keywordId"];
        }
        
        if ($amountRecords == 0)
        {
            $query11 = "
                INSERT INTO `keyword`( 
                `keyword_content`, 
                `keyword_score`) 
                VALUES ( 
                '$keyword', 
                '0') 
            ";

            $stmt1 = $db2->prepare($query11);
            $params1 = array();
            $stmt1->execute($params1);
            
            $keyword_id = $this->check_keyword($keyword);
        }
        
        return $keyword_id;
    }
    
    public function check_keywordLocation($keyword, $locationChild_Id, $language_id)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $query1 = "
        SELECT DISTINCT 
            kl.keywordLocation_id as keywordLocationId, 
            k.keyword_content as keywordContent, 
            lo.location_id as locationId 
            
            FROM Keyword as k 
            
            INNER JOIN Keywordlocation as kl ON kl.keyword_id = k.keyword_id 
            INNER JOIN Location as lo ON lo.location_id = kl.location_id 
            
            INNER JOIN Language as la ON la.language_id = kl.language_id 
            
            WHERE k.keyword_id = '$keyword' and 
                lo.location_id = '$locationChild_Id' and 
                la.language_id = '$language_id' 
        ";

        $stmt2 = $db2->prepare($query1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $keywordLocation_id = $curso["keywordLocationId"];
        }
        
        if ($amountRecords == 0)
        {
            $query2 = "
                INSERT INTO `keywordLocation`(
                `location_id`, 
                `keyword_id`, 
                `language_id`) 
                VALUES (
                '$locationChild_Id',
                '$keyword',
                '$language_id')
            ";
            
            $stmt1 = $db2->prepare($query2);
            $params1 = array();
            $stmt1->execute($params1);
            
            $keywordLocation_id = $this->check_keywordLocation($keyword, $locationChild_Id, $language_id);
        }
        return $keywordLocation_id;
    }
    
    public function insert_keywordLocation($locationChild_Id, $array_geoposition, $language_id)
    {
        $j = 0;
        while (isset($array_geoposition[$j]))
        {
            $keyword = $this->check_keyword($array_geoposition[$j]);
            ////////////////////////////////////////////////////////////////////////////////////////////
            $keywordLocation = $this->check_keywordLocation($keyword, $locationChild_Id, $language_id);
            $j++;
        }
    }
    
    public function getTerritorialityAction(Request $request)
    {
        $territorialityParentId = $_POST["territorialityParentId"];
        $language = $_POST["language"];
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $query_keyword = "
            SELECT DISTINCT 
                k.keyword_content as keywordContent, 
                child.territoriality_id as territorialityId 
                
                FROM Keyword as k 
                INNER JOIN Keywordterritoriality as kt ON kt.keyword_id = k.keyword_id 
                INNER JOIN Language as l ON l.language_id = kt.language_id 
                INNER JOIN Territoriality as t ON kt.territoriality_id = t.territoriality_id 
                
                INNER JOIN Territoriality as child ON child.parent_id = t.territoriality_id 
                
                WHERE l.language_id = $language and t.territoriality_id = $territorialityParentId 
            ";
            
            $stmt2 = $db2->prepare($query_keyword);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);

            $j = 0;
            foreach($cursos2 as $curso)
            {
                $locationData[] = array(
                    'keywordContent' => $curso["keywordContent"],
                    'territorialityId' => $curso["territorialityId"],
                    'amountLocations' => $amountRecords
                );
                $j++;
            }

            if ($j == 0)
            {
                $locationData[] = array(
                    'keywordContent' => "_",
                    'territorialityId' => "_",
                    'amountLocations' => 1
                );
            }
            
            return new Response(json_encode($locationData), 200, array('Content-Type' => 'application/json'));
        }
    }
}