<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Store/Default/index.html.twig');
    }
    
    public function pruebasdfAction()
    {

//        
//            $em = $this->getDoctrine()->getEntityManager();
//            $db = $em->getConnection();
//            $query = "SELECT DISTINCT country_id, country_name, "
//                    . "count(country_name) as cantidad, "
//                    . "count(*) as amountCountries FROM Country";
//            $stmt = $db->prepare($query);
//            $params = array();
//            $stmt->execute($params);
//            
//            $cursos = $stmt->fetchAll();
//            
//            $j=0;
//            foreach($cursos as $curso)
//            {
//                $sendData[] = array(
//                    'countryId' => $curso["country_id"],
//                    'countryName' => $curso["country_name"],
//                    'cantidad' => $curso["cantidad"],
//                    'amountCountries' => $curso["amountCountries"]
//                );
//                $j++;
////                print_r("este es el array: ".$sendData);
//            }
        

    }


    public function addToShoppingCartAction(Request $request)
    {
        $productId = $_POST["productId"];
        $amountProducts = $_POST["amountProducts"];
        
//        $productId = 91;
//        $amountProducts = 1;
        
//        $productId = 125;
//        $amountProducts = 3;
        
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            
            $query0 = "
                SELECT DISTINCT 
                    `stock_id`, `stock_price` 
                    FROM 
                    `stock` 
                    WHERE `product_id` = '$productId' and `stock_amount` >= $amountProducts 
            ";
            
            $stmt0 = $db2->prepare($query0);
            $params0 = array();
            $stmt0->execute($params0);
            
            $cursos0 = $stmt0->fetchAll();
            
            foreach($cursos0 as $curso)
            {
                $stock_id = $curso["stock_id"];
                $stock_price = $curso["stock_price"];
            }
            
            $todayDate = date("Y-m-d\TH:i:sP");
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
            }
            
            $query2 = "
                INSERT INTO `selectedProduct`(
                `user_id`, 
                `stock_id`, 
                `selectedProduct_date`, 
                `selectedProduct_amount`, 
                `selectedProduct_price`) 
                VALUES (
                '$userId',
                '$stock_id',
                '$todayDate',
                '$amountProducts',
                '$stock_price')
            ";
            
            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $users2[0] = array(
                'selectedproductId' => "_",
                'selectedproductDate' => "_",
                'selectedproductAmount' => "_"
            );
            
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function deleteSelectedProductAction(Request $request)
    {
        $selectedProductId = $_POST["selectedProductId"];
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            $query0 = "
                DELETE FROM `selectedProduct` WHERE `selectedProduct`.`selectedProduct_id` = $selectedProductId
            ";
            
            $stmt0 = $db2->prepare($query0);
            $params0 = array();
            $stmt0->execute($params0);
            
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getSelectedProductsAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $userId = $_SESSION['loginSession'];
            
            $selectedProduct = $em->createQuery(
                "SELECT DISTINCT 
                    sp.selectedproductId, 
                    sp.selectedproductDate, 
                    sp.selectedproductAmount, 
                    p.productId, 
                    p.productName, 
                    p.productDescription, 
                    p.productImage, 
                    
                    pr1.amount as productPrice_amount, 
                    cu1.currencyValue as productPrice_currencyValue, 
                    cu1.currencyName as productPrice_currency, 
                    
                    pr2.amount as stockPrice_amount, 
                    cu2.currencyValue as stockPrice_currencyValue, 
                    cu2.currencyName as stockPrice_currency, 
                    
                    pr3.amount as selectedproductPrice_amount, 
                    cu3.currencyValue as selectedproductPrice_currencyValue, 
                    cu3.currencyName as selectedproductPrice_currency 
                    
                FROM HomeBundle:Selectedproduct sp 
                
                JOIN HomeBundle:Stock s 
                WITH s.stockId = sp.stock 
                
                JOIN HomeBundle:Product p 
                WITH p.productId = s.product 

                JOIN HomeBundle:User u 
                WITH u.userId = sp.user 
                

                JOIN HomeBundle:Price pr1 
                WITH pr1.priceId = p.productPrice 
                JOIN HomeBundle:Currency cu1 
                WITH pr1.currency = cu1.currencyId 
                
                JOIN HomeBundle:Price pr2 
                WITH pr2.priceId = s.stockPrice 
                JOIN HomeBundle:Currency cu2 
                WITH pr2.currency = cu2.currencyId 
                
                JOIN HomeBundle:Price pr3 
                WITH pr3.priceId = sp.selectedproductPrice 
                JOIN HomeBundle:Currency cu3 
                WITH pr3.currency = cu3.currencyId 
                
                WHERE u.userId = '$userId' and sp.sale IS NULL
                    
                GROUP BY sp.selectedproductId 
                ORDER BY sp.selectedproductId ASC 
                "
            );

            $selectedProductInstance = $selectedProduct->getResult();
            $amountSelectedProducts = count($selectedProductInstance);
            
            $i = 0;
            while (isset($selectedProductInstance[$i]['selectedproductId'])) {
                $selectedproductDate = $selectedProductInstance[$i]['selectedproductDate'];
                $selectedproductDateString = $selectedproductDate->format('d-M-Y');

                $selectedproductId_Value = $selectedProductInstance[$i]['selectedproductId'];
                $selectedproductDate_Value = $selectedproductDateString;
                $selectedproductAmount_Value = $selectedProductInstance[$i]['selectedproductAmount'];
                
                $productId_Value = $selectedProductInstance[$i]['productId'];
                $productName_Value = $selectedProductInstance[$i]['productName'];
                $productDescription_Value = $selectedProductInstance[$i]['productDescription'];
                $productImage_Value = $selectedProductInstance[$i]['productImage'];
                
                $productPrice_amount_Value = $selectedProductInstance[$i]['productPrice_amount'];
                $productPrice_currencyValue_Value = $selectedProductInstance[$i]['productPrice_currencyValue'];
                $productPrice_currency_Value = $selectedProductInstance[$i]['productPrice_currency'];
                $stockPrice_amount_Value = $selectedProductInstance[$i]['stockPrice_amount'];
                $stockPrice_currencyValue_Value = $selectedProductInstance[$i]['stockPrice_currencyValue'];
                $stockPrice_currency_Value = $selectedProductInstance[$i]['stockPrice_currency'];
                $selectedproductPrice_amount_Value = $selectedProductInstance[$i]['selectedproductPrice_amount'];
                $selectedproductPrice_currencyValue_Value = $selectedProductInstance[$i]['selectedproductPrice_currencyValue'];
                $selectedproductPrice_currency_Value = $selectedProductInstance[$i]['selectedproductPrice_currency'];
                
                $productPrice_label = $productPrice_amount_Value * $productPrice_currencyValue_Value;
                $stockPrice_label = $stockPrice_amount_Value * $stockPrice_currencyValue_Value;
                $selectedproductPrice_label = $selectedproductPrice_amount_Value * $selectedproductPrice_currencyValue_Value;
                
                if (file_exists("files/products/".$selectedProductInstance[$i]['productImage']))
                {
                    $productImage_Value = $selectedProductInstance[$i]['productImage'];
                } else
                {
                    $productImage_Value = "decline.png";
                }

                $sendData[$i] = array(
                    'selectedproductId' => $selectedproductId_Value,
                    'selectedproductDate' => $selectedproductDate_Value,
                    'selectedproductAmount' => $selectedproductAmount_Value,
                    'productId' => $productId_Value,
                    'productName' => $productName_Value,
                    'productDescription' => $productDescription_Value,
                    'productImage' => $productImage_Value,
                    
                    'productPrice_amount' => $productPrice_amount_Value,
                    'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
                    'productPrice_currency' => $productPrice_currency_Value,
                    'productPrice_label' => $productPrice_label,
                    
                    'stockPrice_amount' => $stockPrice_amount_Value,
                    'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
                    'stockPrice_currency' => $stockPrice_currency_Value,
                    'stockPrice_label' => $stockPrice_label,
                    
                    'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
                    'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
                    'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
                    'selectedproductPrice_label' => $selectedproductPrice_label,
                    
                    'amountSelectedProducts' => $amountSelectedProducts
                );

                $i++;
            }

            if ( $i === 0 )
            {
                $selectedproductId_Value = "_";
                $selectedproductDate_Value = "_";
                $selectedproductAmount_Value = "_";
                $productId_Value = "_";
                $productName_Value = "_";
                $productDescription_Value = "_";
                $productImage_Value = "_";
                
                $productPrice_amount_Value = "_";
                $productPrice_currencyValue_Value = "_";
                $productPrice_currency_Value = "_";
                $productPrice_label = "_";
                
                $stockPrice_amount_Value = "_";
                $stockPrice_currencyValue_Value = "_";
                $stockPrice_currency_Value = "_";
                $stockPrice_label = "_";
                
                $selectedproductPrice_amount_Value = "_";
                $selectedproductPrice_currencyValue_Value = "_";
                $selectedproductPrice_currency_Value = "_";
                $selectedproductPrice_label = "_";
                
                $sendData[0] = array(
                    'selectedproductId' => $selectedproductId_Value,
                    'selectedproductDate' => $selectedproductDate_Value,
                    'selectedproductAmount' => $selectedproductAmount_Value,
                    'productId' => $productId_Value,
                    'productName' => $productName_Value,
                    'productDescription' => $productDescription_Value,
                    'productImage' => $productImage_Value,
                    
                    'productPrice_amount' => $productPrice_amount_Value,
                    'productPrice_currencyValue_Value' => $productPrice_currencyValue_Value,
                    'productPrice_currency' => $productPrice_currency_Value,
                    'productPrice_label' => $productPrice_label,
                    
                    'stockPrice_amount' => $stockPrice_amount_Value,
                    'stockPrice_currencyValue_Value' => $stockPrice_currencyValue_Value,
                    'stockPrice_currency' => $stockPrice_currency_Value,
                    'stockPrice_label' => $stockPrice_label,
                    
                    'selectedproductPrice_amount' => $selectedproductPrice_amount_Value,
                    'selectedproductPrice_currencyValue_Value' => $selectedproductPrice_currencyValue_Value,
                    'selectedproductPrice_currency' => $selectedproductPrice_currency_Value,
                    'selectedproductPrice_label' => $selectedproductPrice_label,
                    
                    'amountSelectedProducts' => $amountSelectedProducts
                );
            }
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function identifyKeywordAction(Request $request)
    {
        $keyword = $_POST["keyword"]; // keywordProduct (search engine) - keywordUser (user list)
        $video = $_POST["video"]; // keywordVideo (c1)
        $artist = $_POST["artist"]; // keywordArtist (c2)
        $productType = $_POST["productType"]; // keywordProductType (b1)
        
        if ($request->isXMLHttpRequest()) {
        
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();
            $query_keyword = "
                SELECT DISTINCT 
                    concat( 
                        'Keyword: ', 
                        '(', 
                            Keyword.keyword_id, 
                            ' - ', 
                            Keyword.keyword_content, 
                            ' - ', 
                            Product.product_id, 
                        ')' 
                    ) as individual_description, 
                    Product.product_id as found_product_id 

                    FROM
                        Keyword as Keyword

                        INNER JOIN KeywordProduct ON Keyword.keyword_id = KeywordProduct.keyword_id 
                        INNER JOIN Product ON Product.product_id = KeywordProduct.product_id 
                    WHERE Keyword.keyword_content = '$keyword' 
                    GROUP BY individual_description";
            $query_artist = "
                SELECT DISTINCT 
                    concat( 
                        'KeywordArtist: ', KeywordArtist.keywordArtist_id, 
                        '(', 
                            User.user_id, 
                            ' - ', 
                            User.user_name, 
                            ' - ', 
                            Keyword.keyword_id, 
                            ' - ', 
                            Keyword.keyword_content, 
                            ' - ', 
                            Product.product_id, 
                        ')' 
                    ) as individual_description, 
                    Product.product_id as found_product_id 

                    FROM
                        Keyword 

                        INNER JOIN KeywordArtist ON KeywordArtist.keyword_id = Keyword.keyword_id 
                        INNER JOIN User ON KeywordArtist.user_id = User.user_id 
                        INNER JOIN Product ON Product.artist_id = User.user_id 

                    WHERE KeywordArtist.user_id = '$artist' 
                    GROUP BY individual_description ";
            $query_productType = "
                SELECT DISTINCT 
                    concat( 
                        'KeywordProductType: ', KeywordProductType.keywordProductType_id, 
                        '(', 
                            ProductType.productType_id, 
                            ' - ', 
                            ProductType.productType_name, 
                            ' - ', 
                            Keyword.keyword_id, 
                            ' - ', 
                            Keyword.keyword_content, 
                            ' - ', 
                            Product.product_id, 
                        ')' 
                    ) as individual_description, 
                    Product.product_id as found_product_id 
                    
                    FROM
                        Keyword 
                        
                    INNER JOIN KeywordProductType ON KeywordProductType.keyword_id = Keyword.keyword_id 
                    INNER JOIN ProductType ON ProductType.productType_id = KeywordProductType.productType_id 
                    INNER JOIN Product ON Product.productType_id = ProductType.productType_id 

                    WHERE ProductType.productType_id = '$productType' 
                    GROUP BY individual_description ";
            $query_song = "
                SELECT DISTINCT 
                    concat( 
                        'KeywordVideo: ', KeywordVideo.keywordVideo_id, 
                        '(', 
                            Video.video_id, 
                            ' - ', 
                            Video.video_name, 
                            ' - ', 
                            Keyword.keyword_id, 
                            ' - ', 
                            Keyword.keyword_content, 
                            ' - ', 
                            Product.product_id, 
                        ')' 
                    ) as individual_description, 
                    Product.product_id as found_product_id 
                    
                    FROM
                        Keyword 
                        
                    INNER JOIN KeywordVideo ON KeywordVideo.keyword_id = Keyword.keyword_id 
                    INNER JOIN Video ON Video.video_id = KeywordVideo.video_id 
                    INNER JOIN Product ON Product.song_id = Video.video_id 

                    WHERE Video.video_id = '$video' 
                    GROUP BY individual_description ";
            $query2 = "
                SELECT DISTINCT
                    description, 
                    found_product_id, 
                    found_product_score, 
                    found_sales_amount, 
                    found_search_results, 
                    found_images_amount, 
                    Product.product_name as found_product_name, 
                    Product.product_price as found_product_price, 
                    Product.product_description as found_product_description, 
                    Product.product_image as found_product_image, 
                    sum(Product.product_id) as found_total_products 
                FROM 
                (
                SELECT DISTINCT
                    description, 
                    found_product_id, 
                    found_product_score, 
                    found_sales_amount, 
                    found_search_results, 
                    count(ProductImage.ProductImage_id) as found_images_amount 
                FROM
                (
                    SELECT DISTINCT 
                        description, 
                        found_product_id, 
                        IFNULL(CAST(avg(ProductScore.productScore_punctuation) AS INT), 0) as found_product_score, 
                        found_sales_amount, 
                        found_search_results 
                    FROM 
                    ( 
                        SELECT DISTINCT 
                            description, 
                            found_product_id, 
                            count(SellingProduct.product_id) as found_sales_amount, 
                            found_search_results 
                        FROM 
                        ( 

                            SELECT DISTINCT 
                                GROUP_CONCAT(individual_description) as description, 
                                found_product_id, 
                                count(individual_description) as found_search_results 
                            FROM 
                            (
                            ".
                            $query_keyword.
                            "
                            UNION ALL 
                            ".
                            $query_artist.
                            "
                            UNION ALL 
                            ".
                            $query_productType.
                            "
                            UNION ALL 
                            ".
                            $query_song.
                            "
                            ) TBL
                            GROUP BY found_product_id 
                            ORDER BY found_search_results DESC 
                        ) T
                        LEFT JOIN SellingProduct ON SellingProduct.product_id = found_product_id 
                        GROUP BY found_product_id 
                        ORDER BY found_sales_amount DESC 
                    ) TV
                    LEFT JOIN ProductScore ON ProductScore.product_id = found_product_id 
                    GROUP BY found_product_id 
                    ORDER BY found_product_score DESC 
                ) TVT
                LEFT JOIN ProductImage ON ProductImage.product_id = found_product_id 
                GROUP BY found_product_id 
                ORDER BY found_images_amount DESC 
                )TBTB
            LEFT JOIN Product ON Product.product_id = found_product_id 
            GROUP BY Product.product_id 
            ORDER BY Product.product_id DESC 
            LIMIT 0, 50 
            ";
            
            
            $stmt2 = $db2->prepare($query2);
            $params2 = array();
            $stmt2->execute($params2);
            
            $cursos2 = $stmt2->fetchAll();
            
            foreach($cursos2 as $curso)
            {
                if (file_exists("files/products/".$curso["found_product_image"]))
                {
                    $found_product_image = $curso["found_product_image"];
                } else
                {
                    $found_product_image = "decline.png";
                }
                $sendData[] = array(
                    'description' => $curso["description"],
                    'found_sales_amount' => $curso["found_sales_amount"],
                    'found_product_score' => $curso["found_product_score"],
                    'found_search_results' => $curso["found_search_results"],
                    'found_images_amount' => $curso["found_images_amount"],
                    'found_product_id' => $curso["found_product_id"],
                    'found_product_name' => $curso["found_product_name"],
                    'found_product_price' => $curso["found_product_price"],
                    'found_product_description' => $curso["found_product_description"],
                    'found_product_image' => $found_product_image,
                    'found_total_products' => $curso["found_total_products"]
                );
            }
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function get_artist($em, $keyword)
    {
        $artist_query = $em->createQuery(
            "SELECT DISTINCT a.userId, k.keywordId, k.keywordContent, ka.keywordartistId 
            FROM HomeBundle:User a 

            JOIN HomeBundle:Keywordartist ka 
            WITH a.userId = ka.user 

            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = ka.keyword 

            WHERE k.keywordContent = '$keyword' 

            ORDER BY 
            a.userScore DESC 
            "
        )
        ->setFirstResult(0)
        ->setMaxResults(1);

        $artist_queryInstance = $artist_query->getResult();
    }
    
    
    public function get_productType($em, $keyword)
    {
        $productType_query = $em->createQuery(
            "SELECT DISTINCT pt.producttypeId, k.keywordId, k.keywordContent, kpt.keywordproducttypeId
            FROM HomeBundle:Producttype pt 

            JOIN HomeBundle:Keywordproducttype kpt 
            WITH pt.producttypeId = kpt.producttype 

            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = kpt.keyword 

            WHERE k.keywordContent = '$keyword' 

            ORDER BY 
            pt.producttypeScore DESC 
            "
        )
        ->setFirstResult(0)
        ->setMaxResults(1);

        $productType_queryInstance = $productType_query->getResult();
    }
    
    
    public function get_video($em, $keyword)
    {
        $video_query = $em->createQuery(
            "SELECT DISTINCT v.videoId, k.keywordId, k.keywordContent, kv.keywordvideoId 
            FROM HomeBundle:Video v 

            JOIN HomeBundle:Keywordvideo kv 
            WITH v.videoId = kv.video 

            JOIN HomeBundle:Keyword k 
            WITH k.keywordId = kv.keyword 

            WHERE k.keywordContent = '$keyword' 

            ORDER BY 
            v.videoScore DESC 
            "
        )
        ->setFirstResult(0)
        ->setMaxResults(1);

        $video_queryInstance = $video_query->getResult();
    }
    
    public function getProductDetailsAction(Request $request)
    {
        $productId = $_POST["productId"];
        if ($request->isXMLHttpRequest()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $selectedProduct = $em->createQuery(
                "SELECT DISTINCT pi.productimageId, pi.productimageImage, u.userId 
                FROM HomeBundle:Product p 
                
                JOIN HomeBundle:Productimage pi 
                WITH p.productId = pi.product 
                
                JOIN HomeBundle:User u 
                WITH p.user = u.userId 
                
                WHERE p.productId = '$productId'
                "
            );

            $selectedProductInstance = $selectedProduct->getResult();

            $amountImages = count($selectedProductInstance);

            $i = 0;
            while (isset($selectedProductInstance[$i]['productimageId'])) {
                
                $productimageId_Value = $selectedProductInstance[$i]['productimageId'];
                $productimageImage_Value = $selectedProductInstance[$i]['productimageImage'];
                $userId_Value = $selectedProductInstance[$i]['userId'];

                $sendData[$i] = array(
                    'productimageId' => $productimageId_Value, 
                    'productimageImage' => $productimageImage_Value, 
                    'userId' => $userId_Value, 
                    'amountImages' => $amountImages 
                );

                $i++;
            }

            if ( $i === 0 )
            {
                $sendData[$i] = array(
                    'productimageId' => 0, 
                    'productimageImage' => "decline.png", 
                    'userId' => 0, 
                    'amountImages' => 0 
                );
            }
            return new Response(json_encode($sendData), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    function editWindowStoreAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $modestoreId = $_POST["modestoreId"];
            $windowId = $_POST["windowId"];
            
            $em = $this->getDoctrine()->getManager();
            
            if (isset($_SESSION['loginSession'])) {
                $userId = $_SESSION['loginSession'];
                
                if ($userId == 0)
                {
                } else 
                {
                    if ($windowId == 0)
                    {
//                        $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
//                        $window = new \HomeBundle\Entity\Window();
                    } else {
                        $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);
                        $window = $em->getRepository('HomeBundle:Window')->findOneByWindowId($windowId);
                        $modeStore = $em->getRepository('HomeBundle:Modestore')->findOneByModestoreId($modestoreId);
                        $window->setWindowModestore($modeStore);

                        $em->persist($window);
                        $em->flush();
                    }
                }
            } else
            {
                
            }
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona123...456"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}
