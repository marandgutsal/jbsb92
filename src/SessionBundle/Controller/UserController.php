<?php

namespace SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function getUserAction(Request $request) {
        if ($request->isXMLHttpRequest()) {
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                "
                SELECT DISTINCT 
                    u.userId, 
                    u.userProfilephoto, 
                    u.userName, 
                    u.userFirstgivenname, 
                    u.userSecondgivenname, 
                    u.userFirstfamilyname, 
                    u.userSecondfamilyname, 
                    u.userEmail, 
                    u.userPassword, 
                    u.userBiography, 
                    u.userScore, 
                    l.locationId, 
                    t.territorialityId 
                    
                    FROM HomeBundle:User u 
                    
                    JOIN HomeBundle:Location l 
                    WITH l.locationId = u.location 
                    
                    JOIN HomeBundle:Territoriality t 
                    WITH t.territorialityId = l.territoriality 
                    
                    WHERE u.userId = '$userId'"
                );
                
                $specificlistvideo = $query->getResult();
                
                $userId_value = $specificlistvideo[0]['userId'];
                $userProfilephoto_value = $specificlistvideo[0]['userProfilephoto'];
                $userName_value = $specificlistvideo[0]['userName'];
                $userFirstgivenname_value = $specificlistvideo[0]['userFirstgivenname'];
                $userSecondgivenname_value = $specificlistvideo[0]['userSecondgivenname'];
                $userFirstfamilyname_value = $specificlistvideo[0]['userFirstfamilyname'];
                $userSecondfamilyname_value = $specificlistvideo[0]['userSecondfamilyname'];
                $userEmail_value = $specificlistvideo[0]['userEmail'];
                $userPassword_value = $specificlistvideo[0]['userPassword'];
                $userBiography_value = $specificlistvideo[0]['userBiography'];
                $userScore_value = $specificlistvideo[0]['userScore'];
                $locationId_value = $specificlistvideo[0]['locationId'];
                $territorialityId_value = $specificlistvideo[0]['territorialityId'];
                
                
                
                $alias[0] = 'userId';
                $alias[1] = 'userProfilephoto';
                $alias[2] = 'userName';
                $alias[3] = 'userFirstgivenname';
                $alias[4] = 'userSecondgivenname';
                $alias[5] = 'userFirstfamilyname';
                $alias[6] = 'userSecondfamilyname';
                $alias[7] = 'userEmail';
                $alias[8] = 'userPassword';
                $alias[9] = 'userBiography';
                $alias[10] ='userScore';
                $alias[11] ='locationId';
                $alias[12] ='territorialityId';
                
                $users2[] = array(
                    'userId' => $userId_value, 
                    'userProfilephoto' => $userProfilephoto_value, 
                    'userName' => $userName_value, 
                    'userFirstgivenname' => $userFirstgivenname_value, 
                    'userSecondgivenname' => $userSecondgivenname_value, 
                    'userFirstfamilyname' => $userFirstfamilyname_value, 
                    'userSecondfamilyname' => $userSecondfamilyname_value, 
                    'userEmail' => $userEmail_value, 
                    'userPassword' => $userPassword_value, 
                    'userBiography' => $userBiography_value, 
                    'userScore' => $userScore_value, 
                    'locationId' => $locationId_value, 
                    'territorialityId' => $territorialityId_value, 
                    'alias' => $alias
                );
            } 
//            else
//            {
//                $alias[0] = 'userId';
//                $alias[1] = 'userProfilephoto';
//                $alias[2] = 'userName';
//                $alias[3] = 'userFirstgivenname';
//                $alias[4] = 'userSecondgivenname';
//                $alias[5] = 'userFirstfamilyname';
//                $alias[6] = 'userSecondfamilyname';
//                $alias[7] = 'userEmail';
//                $alias[8] = 'userPassword';
//                $alias[9] = 'userBiography';
//                $alias[10] ='userScore';
//                $alias[11] ='locationId';
//                $alias[12] ='territorialityId';
//                
//                $users2[] = array(
//                    'userId' => "_", 
//                    'userProfilephoto' => "_", 
//                    'userName' => "_", 
//                    'userFirstgivenname' => "_", 
//                    'userSecondgivenname' => "_", 
//                    'userFirstfamilyname' => "_", 
//                    'userSecondfamilyname' => "_", 
//                    'userEmail' => "_", 
//                    'userPassword' => "_", 
//                    'userBiography' => "_", 
//                    'userScore' => "_", 
//                    'locationId' => "_", 
//                    'territorialityId' => "_", 
//                    'alias' => $alias
//                );
//            }
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getParentsLocationAction(Request $request)
    {
        $locationId = $_POST['locationId'];
            
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $i = 0;
            $location_detail = $this->getLocation_123($locationId, $em);
            $locationParent_value = $location_detail[0]['locationParent'];
            $locationId_value = $location_detail[0]['locationId'];
            $location[$i] = $locationId_value;
            
            $sendData[0]["location".$i] = $location[$i];
            $alias[$i] = "location".$i;
            
            while ($locationId_value != 1)
            {
                $i++;
                $location_detail = $this->getLocation_123($locationParent_value, $em);
                $locationParent_value = $location_detail[0]['locationParent'];
                $locationId_value = $location_detail[0]['locationId'];
                $location[$i] = $locationId_value;
                
                $sendData[0]["location".$i] = $location[$i];
                $alias[$i] = "location".$i;
            }
            
            $sendData[0]["alias"] = $alias;
            
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getLocation_123($locationId, $em)
    {
        $query = $em->createQuery(
        "
        SELECT DISTINCT 
            l.locationId, 
            lp.locationId locationParent 

            FROM HomeBundle:Location l 
            
            JOIN HomeBundle:Location lp 
            WITH lp.locationId = l.locationParent 

            WHERE l.locationId = '$locationId'"
        );

        $specificlistvideo = $query->getResult();
        $locationId_value = $specificlistvideo[0]['locationId'];
        $locationParent_value = $specificlistvideo[0]['locationParent'];

        $users2[0] = array(
            'locationId' => $locationId_value, 
            'locationParent' => $locationParent_value 
        );
        return $users2;
    }
    
    public function getChildrenLocationAction(Request $request)
    {
//                alert("\n - i: "+i+"\n - j: "+j+
//                  "\n - locationId: "+locationId+
//                  "\n - locationName: "+locationName+
//                  "\n - locationParent: "+locationParent+
//                  "\n - keywordContent: "+keywordContent+
//                  "\n - amountLocations: "+amountLocations
//                );
        
        
        
        
//        $stmt2 = $db2->prepare($query_keyword);
//        $params2 = array();
//        $stmt2->execute($params2);
//
//        $cursos2 = $stmt2->fetchAll();
//        $amountRecords = count($cursos2);
        
        
        
        
        
        
//    INNER JOIN Location as lo ON kl.location_id = lo.location_id 
//    INNER JOIN Keyword as k ON kl.keyword_id = k.keyword_id 
        
        
        $locationId = $_POST['locationId'];
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $query = $em->createQuery(
            "
            SELECT DISTINCT 
                l.locationId, 
                l.locationName, 
                lp.locationId locationParent 

                FROM HomeBundle:Location l 

                JOIN HomeBundle:Location lp 
                WITH lp.locationId = l.locationParent 

                WHERE lp.locationId = '$locationId'"
            );

            $specificlistvideo = $query->getResult();
            
            $amountLocations = count($specificlistvideo);
            
            $i = 0;
            while (isset($specificlistvideo[$i]['locationId'])) {
                $locationId_value = $specificlistvideo[$i]['locationId'];
                $locationName_value = $specificlistvideo[$i]['locationName'];
                $locationParent_value = $specificlistvideo[$i]['locationParent'];
                $keywordContent_value = "";
//                $keywordContent_value = $specificlistvideo[$i]['keywordContent'];
            
                $users2[$i] = array(
                    'locationId' => $locationId_value, 
                    'locationName' => $locationName_value, 
                    'locationParent' => $locationParent_value, 
                    'keywordContent' => $keywordContent_value, 
                    'amountLocations' => $amountLocations 
                );
            }
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
//    SELECT DISTINCT 
//        lo.location_id as locationId, 
//        lo.location_name as locationName, 
//        lp.location_id as locationParent, 
//        k.keyword_content as keywordContent 
//
//        FROM Keywordlocation as kl 
//
//        INNER JOIN Location as lo ON kl.location_id = lo.location_id 
//        INNER JOIN Keyword as k ON kl.keyword_id = k.keyword_id 
//        INNER JOIN Language as la ON kl.language_id = la.language_id 
//        INNER JOIN Location as lp ON lp.location_id = lo.location_parent 
//        WHERE lo.location_parent = $locationParent and 
//        la.language_id = $language 
//        $respectly_string 
//        GROUP BY lo.location_id 
//        ORDER BY lo.location_id DESC 
//        LIMIT 0, 300 
}