<?php

namespace SignUpBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class set_keywordLocation extends Controller {

    public $global_topicId = 0;
//    $locationData = $insertLocation_1->isValid($em, $locationParent, $language, $insertedLocation);
    public function isValid($em, $locationParent, $language, $insertedLocation)
    {
        $valor1 = 1;
        
        
        
//        $keyword = new \HomeBundle\Entity\Keyword();
//        $keyword->setKeywordContent("tagdjdkd");
//        $keyword->setKeywordScore(3);
//        $em->persist($keyword);
//        $em->flush();
        
//        $valor1 = $this->insertKeywordlocation($em, $locationParent, $language, $insertedLocation);
        return $valor1;
    }
    
    public function insertKeywordlocation($em, $locationParent, $language, $insertedLocation)
    {
        $gdbc = $insertedLocation[0];
        
        $keyword = new \HomeBundle\Entity\Keyword();
        $keyword->setKeywordContent($gdbc);
        $keyword->setKeywordScore(3);
        $em->persist($keyword);
        $em->flush();
        
        //////////////////////////////////////////////////////////////////
        
        // for or while with the array: 
        $locationData[0] = "a";
        $locationData[1] = "b";
        $locationData[2] = "c";
        $locationData[3] = "d";
        $locationData[4] = "e";
        
        $locationId_data[] = array();
        
        $amountrecoverLocations = 0;
        
        for ($i=0; $i<=4; $i++)
        {
            $identifier = $locationData[$i];
            
            $location = $em->createQuery(
                "SELECT lo.locationId, lo.locationName, lp.locationId locationParent, 
                    k.keywordContent 
                FROM HomeBundle:Keywordlocation kl 

                JOIN HomeBundle:Location lo 
                WITH kl.location = lo.locationId 

                JOIN HomeBundle:Keyword k 
                WITH kl.keyword = k.keywordId 

                JOIN HomeBundle:Language la 
                WITH kl.language = la.languageId 

                JOIN HomeBundle:Location lp 
                WITH lp.locationId = lo.locationParent 

                WHERE lo.locationParent = $locationParent and 
                la.languageId = $language and 
                k.keywordContent = $identifier 
                "
            );
            $location_v = $location->getResult();

            $amountLocations = count($location_v);

            if ($amountLocations == 1)
            {
                $locationId_data[$i] = $location_v[$i]['locationId'];
                
                if ($locationId_data[0] && $locationId_data[0] == $locationId_data[$i])
                {
                    $amountrecoverLocations++;    
                }
            }
        }
        
        if($amountrecoverLocations == 4) // because is the only recover
        {
            // insert all diferent keywordLocation
            for ($i=0; $i<=4; $i++)
            {
                $identifier = $locationData[$i];
                
                $language_e = $em->getRepository('HomeBundle:Language')->findOneByLanguageId($language);
                $keyword_e = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($identifier);

                $locationParent_e = $em->getRepository('HomeBundle:Location')->findOneByLocationId($locationParent);
                $locationParent_id = $locationParent_e->getLocationId();

                $newLocation = $em->getRepository('HomeBundle:Location')
                    ->findOneBy(array(
                        'locationName' => $identifier,
                        'locationParent' => $locationParent_id
                ));

                if(!$newLocation)
                {
                    $newLocation = new \HomeBundle\Entity\Location();
                    $newLocation->setLocationName($identifier);
                    $newLocation->setLocationParent($locationParent_e);
                    $em->persist($newLocation);
                    $em->flush();
                }

//                insertedLocation[0]
                
                $keywordLocation = new \HomeBundle\Entity\Keywordlocation();
                $keywordLocation->setKeyword($keyword_e);
                $keywordLocation->setLanguage($language_e);
                $keywordLocation->setLocation($newLocation);
                $em->persist($keywordLocation);
                $em->flush();
            }
        }
    }
    
}