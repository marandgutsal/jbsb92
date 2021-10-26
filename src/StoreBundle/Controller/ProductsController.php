<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



class ProductsController extends Controller
{
    public function getProductsAction(Request $request)
    {
        $object = $_POST["object"];
        $first_result = $_POST["first_result"];
        $max_results = $_POST["max_results"];
        $divToDraw = $_POST["divToDraw"];
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        } else
        {
            $userId = 0;
        }
        
        $artist_id = 25;
        $location_id = 146;
        
//        getProducts(queryType, divToDraw, keyword);
//        $.post(url, {keyword: keyword, queryType: queryType}, function (data)
        
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $query_search_condition = "";
            $i=0;
            while(isset($object[$i][0]) && isset($object[$i][1]))
            {
                if ($i==0)
                {
                $query_search_condition .= "
                    WHERE 
                    ";
                } else
                {
                $query_search_condition .= "
                    or 
                    ";
                }

                $usertype = $object[$i][0];
                $keyword = $object[$i][1];


                $query_search_condition .= "
                    object.usertype_id = '$usertype' and object.keyword_id = '$keyword' 
                ";
                $i++;
            }
            
            
            $query_search = "
            SELECT DISTINCT 
                product.product_id, 
                product.product_name, 
                price.price_id as price_value, 
                currency.currency_name, 
                product.product_description, 
                product.product_image, 
                concat( 'Search: ') as individual_description 

                FROM 
                    product 

                INNER JOIN price ON price.price_id = product.product_price 
                INNER JOIN currency ON currency.currency_id = price.currency 
                

                INNER JOIN topicmemberproduct ON topicmemberproduct.product_id = product.product_id 
                INNER JOIN topicmember ON topicmember.topicmember_id = topicmemberproduct.topicmember_id 
                INNER JOIN object ON object.object_id = topicmember.object_id 
                $query_search_condition
            "; // user
            
            
            $query_all = "
                SELECT DISTINCT 
                    product.product_id, 
                    product.product_name, 
                    price.price_id as price_value, 
                    currency.currency_name, 
                    product.product_description, 
                    product.product_image, 
                    concat( 'All: ') as individual_description 

                    FROM 
                        product 
                        
                    INNER JOIN price ON price.price_id = product.product_price 
                    INNER JOIN currency ON currency.currency_id = price.currency 
                    
                "; // all
            
            $query_stock = "
                SELECT DISTINCT 
                    product.product_id, 
                    product.product_name, 
                    price.price_id as price_value, 
                    currency.currency_name, 
                    product.product_description, 
                    product.product_image, 
                    concat( 'Stock: ') as individual_description 
                    
                    FROM 
                        product 
                        
                    INNER JOIN price ON price.price_id = product.product_price 
                    INNER JOIN currency ON currency.currency_id = price.currency 
                    
                    INNER JOIN stock ON stock.product_id = product.product_id 
                "; // stock
            
                        
            $query_location = "
            SELECT DISTINCT 
                product.product_id, 
                product.product_name, 
                price.price_id as price_value, 
                currency.currency_name, 
                product.product_description, 
                product.product_image, 
                concat( 'Location: ') as individual_description 

                FROM 
                    product 

                INNER JOIN price ON price.price_id = product.product_price 
                INNER JOIN currency ON currency.currency_id = price.currency 

                INNER JOIN locationproduct ON locationproduct.product_id = product.product_id 

                WHERE locationproduct.location_id = '$location_id'
            "; // location
            
            
            
            $query_artist = "
            SELECT DISTINCT 
                product.product_id, 
                product.product_name, 
                price.price_id as price_value, 
                currency.currency_name, 
                product.product_description, 
                product.product_image, 
                concat( 'Artist: ') as individual_description 

                FROM 
                    product 

                INNER JOIN price ON price.price_id = product.product_price 
                INNER JOIN currency ON currency.currency_id = price.currency 

                INNER JOIN artistproduct ON artistproduct.product_id = product.product_id 

                WHERE artistproduct.artist_id = '$artist_id'
            "; // artist

            
            $query_user = "
            SELECT DISTINCT 
                product.product_id, 
                product.product_name, 
                price.price_id as price_value, 
                currency.currency_name, 
                product.product_description, 
                product.product_image, 
                concat( 'User: $userId') as individual_description 

                FROM 
                    product 

                INNER JOIN price ON price.price_id = product.product_price 
                INNER JOIN currency ON currency.currency_id = price.currency 

                INNER JOIN topicmemberproduct ON topicmemberproduct.product_id = product.product_id 
                INNER JOIN usertopicmember ON usertopicmember.topicmember_id = topicmemberproduct.topicmember_id 
                
                WHERE usertopicmember.user_id = '$userId'
            "; // user
            

            
            
            
            
            
            
            $query = "
            SELECT DISTINCT 
                product_id, 
                product_name, 
                price_value, 
                currency_name, 
                product_description, 
                product_image, 
                count(product_id) as found_product_id, 
                GROUP_CONCAT(individual_description) as found_total_description 
                
                FROM 
                (
                    ".
                    $query_search.
                    "
                    UNION ALL 
                    ".
                    $query_stock.
                    "
                    UNION ALL 
                    ".
                    $query_location.
                    "
                    UNION ALL 
                    ".
                    $query_artist.
                    "
                    UNION ALL 
                    ".
                    $query_user.
                    "
                    UNION ALL 
                    ".
                    $query_all.
                    "
                ) TBL
            GROUP BY product_id 
            ORDER BY found_product_id DESC 
            LIMIT $first_result, $max_results 
            ";
            
            
            
            
            
            
            
            $stmt2 = $db2->prepare($query);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            $amountRecords = count($cursos2);
            
            $alias[0] = 'product_id';
            $alias[1] = 'product_name';
            $alias[2] = 'price_value';
            $alias[3] = 'currency_name';
            $alias[4] = 'product_description';
            $alias[5] = 'product_image';
            $alias[6] = 'amountRecords';
            $alias[7] = 'score';
            $alias[8] = 'description';
            
            $em = $this->getDoctrine()->getManager();
            
            $j = 0;
            foreach($cursos2 as $curso)
            {
                $price_id = $curso["price_value"];
                $requested_currency = 1;
                $currency_1 = $this->get('app.currency');
                $new_price_array = $currency_1->isValid($em, $db2, $requested_currency, $price_id);
                
                $price_value = $new_price_array[4];
                $currency_value = $new_price_array[3];
                
//                $new_price_array[0] = $new_priceId;
//                $new_price_array[1] = $new_amount;
//                $new_price_array[2] = $new_currencyId;
//                $new_price_array[3] = $new_currencyName;
//                $new_price_array[4] = $PRICE;
                
                $sendData[$j] = array(
                    'product_id' => $curso["product_id"],
                    'product_name' => $curso["product_name"],
                    'price_value' => $price_value,
                    'currency_name' => $currency_value,
                    'product_description' => $curso["product_description"],
                    'product_image' => $curso["product_image"],
                    'amountRecords' => $amountRecords,
                    'score' => $curso["found_product_id"],
                    'description' => $curso["found_total_description"],
                    'alias' => $alias
                );
                $j++;
            }

            if ($j == 0)
            {
                $sendData[] = array(
                    'product_id' => 0,
                    'product_name' => "_",
                    'price_value' => 0,
                    'currency_name' => "_",
                    'product_description' => "_",
                    'product_image' => "_",
                    'amountRecords' => $amountRecords,
                    'score' => 0,
                    'description' => "_",
                    'alias' => $alias
                );
            }
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function categories()
    {
        if ($divToDraw == "searchList-storeBundle")
        {
            $query = "
                    JOIN HomeBundle:Topicmemberproduct tmp 
                    WITH tmp.product = p.productId 

                    JOIN HomeBundle:Topicmember tm 
                    WITH tm.topicmemberId = tmp.topicmember 

                    JOIN HomeBundle:Object o 
                    WITH o.objectId = tm.object 
                    ";

            $i=0;
            while(isset($object[$i][0]) && isset($object[$i][1]))
            {
                if ($i==0)
                {
                $query .= "
                    WHERE 
                    ";
                } else
                {
                $query .= "
                    or 
                    ";
                }

                $usertype = $object[$i][0];
                $keyword = $object[$i][1];

                $query .= "
                    o.usertype = '$usertype' and o.keyword = '$keyword' 
                    ";
                $i++;
            }

//                $query .= "
//                        WHERE 
//                        o.usertype = '4' and o.keyword = '959' 
//                        
//                        or 
//                        o.usertype = '11' and o.keyword = '959' 
//                        
//                        or 
//                        o.usertype = '16' and o.keyword = '959' 
//                        ";

        }



        if ($divToDraw == "userList-storeBundle")
        {
            $query = "
                    JOIN HomeBundle:Keywordproduct kp 
                    WITH kp.product = p.productId 

                    JOIN HomeBundle:Keyword k 
                    WITH k.keywordId = kp.keyword 

                    JOIN HomeBundle:Keyworduser ku 
                    WITH ku.keyword = kp.keyword 
                    ";
        }



        if ($divToDraw == "locationList-storeBundle")
        {
            $query = "
                    JOIN HomeBundle:Locationproduct lp 
                    WITH lp.product = p.productId 

                    JOIN HomeBundle:Location l 
                    WITH l.locationId = lp.location 
                    ";
        }



        if ($divToDraw == "artistList-storeBundle")
        {
            $query = "
                    JOIN HomeBundle:Artistproduct ap 
                    WITH ap.product = p.productId 

                    JOIN HomeBundle:User a 
                    WITH a.userId = ap.artist 
                    ";
        }

        $video = 159;

        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
//                $locationId = $em->getRepository('HomeBundle:Location')->findOneByUserId($userId);
            $locationId = 1;
        }


        $topic123 = $em->createQuery(
            "
            SELECT DISTINCT 
                p.productId, p.productName, 
                pr.priceId as productPrice, p.productDescription, 
                p.productImage 

                FROM HomeBundle:Product p 

                JOIN HomeBundle:Price pr 
                WITH pr.priceId = p.productPrice 

                JOIN HomeBundle:Stock st 
                WITH st.product = p.productId 

                JOIN HomeBundle:Association a 
                WITH a.product = p.productId 

                JOIN HomeBundle:Usertopicmember utm 
                WITH utm.topicmember = a.topicmember 

                ORDER BY p.productId 
            "
        )
        ->setFirstResult($first_result)
        ->setMaxResults($max_results);


        $query = "";



//                    $query


//                    WHERE a.video = '$video' or 
//                    a.location = '$locationId' or 
//                    utm.user = '$userId' 


//            11 location (or parents)  locationId
//            4 artist (or omit)        artistId
//            16 keyword (or omit)      keywordId from userId


        $topic_i = $topic123->getResult();

        $amountTopics = 0;
        while (isset($topic_i[$amountTopics]['productId'])) {
            $amountTopics++; 
        }

        if ($topic_i) {
            $i = 0;

            while (isset($topic_i[$i]['productId'])) {
                $productId = $topic_i[$i]['productId'];
                $productName = $topic_i[$i]['productName'];
                $productPrice = $topic_i[$i]['productPrice'];
                $productDescription = $topic_i[$i]['productDescription'];
                $productImage = $topic_i[$i]['productImage'];
                $amountTopics_Value = $amountTopics;

                $users2[$i] = array(
                    'productId' => $productId,
                    'productName' => $productName,
                    'productPrice' => $productPrice,
                    'productDescription' => $productDescription,
                    'productImage' => $productImage,
                    'amount' => $amountTopics_Value
                );
                $i++;
            }

        } else
        {
            $users2[0] = array(
                'productId' => "_",
                'productName' => "_",
                'productPrice' => "_",
                'productDescription' => "_",
                'productImage' => "_",
                'amount' => $amountTopics
            );
        }
    }
    
    
    
    
    
    
    public function getExtraQuery()
    {

        if ($queryType == "location")
        {
            $location = $em->getRepository('HomeBundle:Location')
                ->findOneBy(array(
                    'locationId' => $data
                ));
            $association = $location->getLocationId(); // location
            $attribute = "a.location";
        } else if ($queryType == "user")
        {
            $user = $em->getRepository('HomeBundle:User')
                ->findOneBy(array(
                    'userId' => $data
                ));
            $association = $user->getUserId(); // user
            $attribute = "a.user";
        } else if ($queryType == "search")
        {
            $keyword = $em->getRepository('HomeBundle:Keyword')
                    ->findOneBy(array(
                        'keywordContent' => $data
                    ));
            $association = $keyword->getKeywordId(); // search
            $attribute = "a.keyword";
        } else if ($queryType == "fans")
        {
            $video = $em->getRepository('HomeBundle:Video')
                    ->findOneBy(array(
                        'videoId' => $data
                    ));
            $association = $video->getVideoId(); // video
            $attribute = "a.video";
        } else if ($queryType == "artist")
        {
            $artist = $em->getRepository('HomeBundle:User')
                ->findOneBy(array(
                    'userId' => $data
                ));
            $association = $artist->getUserId(); // user
            $attribute = "a.artist";
        }
        

//                SELECT DISTINCT 
//                    p.productId, p.productName, 
//                    pr.priceId as productPrice, p.productDescription, 
//                    p.productImage, tm.topicmemberId 
//            
//                    FROM HomeBundle:Keyword k 
//
//                    JOIN HomeBundle:Object o 
//                    WITH o.keyword = k.keywordId 
//
//                    JOIN HomeBundle:Topicmember tm 
//                    WITH tm.object = o.objectId 
//
//                    JOIN HomeBundle:Topicmemberproduct tmp 
//                    WITH tmp.topicmember = tm.topicmemberId 
//
//                    JOIN HomeBundle:Product p 
//                    WITH tmp.product = p.productId 
//                    
//                    JOIN HomeBundle:Usertype ut 
//                    WITH o.usertype = ut.usertypeId 
//
//                    JOIN HomeBundle:Associationtopicmember atm 
//                    WITH atm.topicmember = tm.topicmemberId 
//                    
//                    JOIN HomeBundle:Association a 
//                    WITH a.associationId = atm.association 
//                    
//                    JOIN HomeBundle:Price pr 
//                    WITH pr.priceId = p.productPrice 
//                            
//                    WHERE $attribute = '$association' 
            
    }


    public function insertObjectAction(Request $request)
    {
        $keyword_post = $_POST["keyword"];
        $userType_post = $_POST["userType"];
        
        $em = $this->getDoctrine()->getManager();
            
        $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($keyword_post);
        $userType = $em->getRepository('HomeBundle:Usertype')->findOneByUsertypeClass($userType_post);
        
        if (!$keyword)
        {
            $selectedKeyword = new \HomeBundle\Entity\Keyword();
            $selectedKeyword->setKeywordContent($keyword_post);
            $selectedKeyword->setKeywordScore(0);
            $em->persist($selectedKeyword);
            $em->flush();
            $keyword = $em->getRepository('HomeBundle:Keyword')->findOneByKeywordContent($keyword_post);
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

            WHERE k.keywordContent = '$keyword_post' and ut.usertypeClass = '$userType_post' 
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
        }

        if ($request->isXMLHttpRequest()) {

            $users2[0] = array(
                'topicId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getUserTypeAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $usertype = $em->createQuery(
                "SELECT DISTINCT 
                    ut.usertypeId, ut.usertypeClass 

                FROM HomeBundle:Usertype ut 
                "
            );
            
            $usertype_i = $usertype->getResult();
            
            $amountUsertypes = 0;
            while (isset($usertype_i[$amountUsertypes]['usertypeId'])) {
                $amountUsertypes++;
            }
            
            if ($usertype_i) {
                $i = 0;

                while (isset($usertype_i[$i]['usertypeId'])) {
                    $usertypeId = $usertype_i[$i]['usertypeId'];
                    $usertypeClass = $usertype_i[$i]['usertypeClass'];
                    $amountUsertypes_Value = $amountUsertypes;

                    $users2[$i] = array(
                        'usertypeId' => $usertypeId,
                        'usertypeClass' => $usertypeClass,
                        'amountUsertypes' => $amountUsertypes_Value
                    );
                    $i++;
                }
            } else
            {
                $users2[0] = array(
                    'usertypeId' => "_",
                    'usertypeClass' => "_",
                    'amountUsertypes' => $amountUsertypes_Value
                );
            }
                
            
//            $amountUserTypes_Value = 0;
//            $users2[0] = array(
//                'userTypeId' => "_",
//                'userTypeClass' => "_",
//                'amountUserTypes' => $amountUserTypes_Value
//            );
//            
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}