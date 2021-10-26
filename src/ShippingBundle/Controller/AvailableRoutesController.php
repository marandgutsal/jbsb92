<?php

namespace ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



class AvailableRoutesController extends Controller
{
    public $k = 0;
    public $sendata_routes_size = 0;
    
    public function AvailableRoutesAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            
            $em2 = $this->getDoctrine()->getEntityManager();
            $db2 = $em2->getConnection();

            $originLocation = 2;
            $destinyLocation = 2;
            $package_maxAmount = 1;
            $xyz = 0;
            $callsToExecuteQuery_2 = 0;
            $sendata_routes = array();
            $sendata_users = array();
            $sale1 = array();

            $reachLocation = "local";
            $coverage = 2;
            
            //$sale1 = $this->get_sale();
//            $saleDetail = $this->get_saleDetail($sale);
            
            
            $sale1 = $this->getSale();
            
//            $sale = $this->identifyRange($originLocation, $destinyLocation);
            
//        $sale1[0] = array(
//            'sale_id_1' => "_",
//            'customer_id_1' => "_",
//            'sale_date_1' => "_",
//            'sale_total_1' => "_",
//            'sale_status_1' => "_"
//        );
        
        return new Response(
            json_encode($sale1), 
            200, 
            array('Content-Type' => 'application/json'));
        }
    }
    
    
    function executeQuery_2(
        $db2, 
        $query_order, 
        $originLocation, 
        $destinyLocation, 
        $package_maxAmount, 
        $xyz, 
        $callsToExecuteQuery_2, 
        $sendata_routes,
        $sendata_users)
    {
            $stmt2 = $db2->prepare($query_order);
            $params2 = array();
            $stmt2->execute($params2);

            $cursos2 = $stmt2->fetchAll();
            
            if ($cursos2)
            {
                
                foreach($cursos2 as $curso123) // routes_amount 
                {
                    $j=1;
                    for ($i = 0; $i < $package_maxAmount; $i++)
                    {
                        $sendata_routes[$xyz][$i]["package_id"] = $curso123["package_id_$j"];
                        $sendata_routes[$xyz][$i]["packageOrigin_id"] = $curso123["packageOrigin_id_$j"];
                        $sendata_routes[$xyz][$i]["location_id_Origin"] = $curso123["location_id_Origin_$j"];
                        $sendata_routes[$xyz][$i]["packageDestiny_id"] = $curso123["packageDestiny_id_$j"];
                        $sendata_routes[$xyz][$i]["location_id_Destiny"] = $curso123["location_id_Destiny_$j"];
                        $sendata_routes[$xyz][$i]["availableRoute_id"] = $curso123["availableRoute_id_$j"];
                        $sendata_routes[$xyz][$i]["availableRoute_openedDate"] = $curso123["availableRoute_openedDate_$j"];
                        $sendata_routes[$xyz][$i]["availableRoute_closedDate"] = $curso123["availableRoute_closedDate_$j"];
                        $sendata_routes[$xyz][$i]["user_id"] = $curso123["user_id_$j"];
                        $sendata_routes[$xyz][$i]["user_name"] = $curso123["user_name_$j"];
                        $sendata_routes[0][0]["routes_amount"] = $xyz;
                        $sendata_routes[$xyz][$i]["packages_amount"] = $package_maxAmount;
                        $sendata_routes[$xyz][$i]["package_position"] = $i;
                        $sendata_routes[$xyz][$i]["route_position"] = $xyz;

//                    $sendata_routes[$xyz][$i]["package_id"] = "_.._";
//                    $sendata_routes[$xyz][$i]["packageOrigin_id"] = "_.._";
//                    $sendata_routes[$xyz][$i]["location_id_Origin"] = "_.._";
//                    $sendata_routes[$xyz][$i]["packageDestiny_id"] = "_.._";
//                    $sendata_routes[$xyz][$i]["location_id_Destiny"] = "_.._";
//                    $sendata_routes[$xyz][$i]["availableRoute_id"] = "_.._";
//                    $sendata_routes[$xyz][$i]["availableRoute_openedDate"] = "_.._";
//                    $sendata_routes[$xyz][$i]["availableRoute_closedDate"] = "_.._";
//                    $sendata_routes[$xyz][$i]["user_id"] = "_.._";
//                    $sendata_routes[$xyz][$i]["user_name"] = "_.._";
//                    $sendata_routes[0][0]["routes_amount"] = "_.._";
//                    $sendata_routes[$xyz][$i]["packages_amount"] = "_.._";
//                    $sendata_routes[$xyz][$i]["package_position"] = "_.._";
//                    $sendata_routes[$xyz][$i]["route_position"] = "_.._";
                        $j++;
                    }

                    $xyz++; // posición de ruta 0:(2), 1:(1), 2:(1,2), 3:(1,3,2), 4:(1,2,2), 5:(1,1,3,4) 
                }
    
            }

            if($package_maxAmount < 4)
            {
                $package_maxAmount++;
            }

            
            
            
        if ($callsToExecuteQuery_2 < $package_maxAmount)
        {
            $callsToExecuteQuery_2++;

            $reachLocation = "local";
            $coverage = 2;
            $query_order = $this->getQueryString($originLocation, $destinyLocation, $package_maxAmount, $reachLocation, $coverage);
            $sendata_routes = $this->executeQuery_2(
            $db2, 
            $query_order, 
            $originLocation, 
            $destinyLocation, 
            $package_maxAmount, 
            $xyz, 
            $callsToExecuteQuery_2, 
            $sendata_routes,
            $sendata_users);
        }
        
        return $sendata_routes;
    }
    
            
    function getQueryString($originLocation, $destinyLocation, $package_maxAmount, $reachLocation, $coverage)
    {
        $string_a = "";
        $string_b = "";
        $string_c = "";
        $string_d = "";
        $string_e = "";
        $string_f = "";
        $string_b_1 = "";
        $string_b_2 = "";
        
        if ($reachLocation === "international")
        {
            $string_b_1 .= 
            "

            ";

            $string_b_2 .= 
            "

            ";
        } else if ($reachLocation === "national")
        {
            $string_b_1 .= 
            "
                CityOrigin_1.city_id as city_idOrigin_1, 
                DepartmentOrigin_1.department_id as department_idOrigin_1, 
                CountryOrigin_1.country_id as country_idOrigin_1, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_1.city_id as city_idDestiny_1, 
                DepartmentDestiny_1.department_id as department_idDestiny_1, 
                CountryDestiny_1.country_id as country_idDestiny_1, 
            ";
        } else if ($reachLocation === "departamental")
        {
            $string_b_1 .= 
            "
                CityOrigin_1.city_id as city_idOrigin_1, 
                DepartmentOrigin_1.department_id as department_idOrigin_1, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_1.city_id as city_idDestiny_1, 
                DepartmentDestiny_1.department_id as department_idDestiny_1, 
            ";
        } else if ($reachLocation === "local")
        {
            $string_b_1 .= 
            "
                CityOrigin_1.city_id as city_idOrigin_1, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_1.city_id as city_idDestiny_1, 
            ";
        }
                
        if ($package_maxAmount == 1)
        {
            $string_b .= 
            "
                SELECT DISTINCT  
                    Package_1.package_id as package_id_1,   
                    Package_1.package_reachLocation as package_reachLocation_1, 
                    PackageOrigin_1.packageOrigin_id as packageOrigin_id_1,   
                    LocationOrigin_1.location_id as location_id_Origin_1,   
                    $string_b_1 

                    PackageDestiny_1.packageDestiny_id as packageDestiny_id_1,   
                    LocationDestiny_1.location_id as location_id_Destiny_1, 
                    $string_b_2 

                    AvailableRoute_1.availableRoute_id as availableRoute_id_1, 
                    AvailableRoute_1.availableRoute_openedDate as availableRoute_openedDate_1, 
                    AvailableRoute_1.availableRoute_closedDate as availableRoute_closedDate_1, 
                    User_1.user_id as user_id_1, 
                    User_1.user_name as user_name_1 
                    
                    FROM Location as LocationOrigin_1 
            ";
        }
            
        for ($i = 1; $i < $package_maxAmount; $i++)
        {
            $package_amount = $package_maxAmount - $i;
            $string_b .= $this->get_string_b_1($package_amount, $reachLocation);
            $string_b .= $this->get_string_b_2($package_amount+1, $reachLocation);

            if ($i == $package_maxAmount - 1)
            {
                $string_b .= 
                "
                    SELECT DISTINCT  
                        Package_1.package_id as package_id_1,   
                        Package_1.package_reachLocation as package_reachLocation_1, 
                        PackageOrigin_1.packageOrigin_id as packageOrigin_id_1,   
                        LocationOrigin_1.location_id as location_id_Origin_1,   
                        $string_b_1 
                            
                        PackageDestiny_1.packageDestiny_id as packageDestiny_id_1,   
                        LocationDestiny_1.location_id as location_id_Destiny_1,  
                        $string_b_2 

                        AvailableRoute_1.availableRoute_id as availableRoute_id_1, 
                        AvailableRoute_1.availableRoute_openedDate as availableRoute_openedDate_1, 
                        AvailableRoute_1.availableRoute_closedDate as availableRoute_closedDate_1, 
                        User_1.user_id as user_id_1, 
                        User_1.user_name as user_name_1 
                        FROM Location as LocationOrigin_1 
                ";
            }
        }
        
        for ($i = 1; $i <= $package_maxAmount; $i++)
        {
            if ($i == 1)
            {
                $string_a .= 
                "
                    INNER JOIN PackageOrigin as PackageOrigin_1 ON PackageOrigin_1.location_id = LocationOrigin_1.location_id 

                    INNER JOIN Package as Package_1 ON PackageOrigin_1.package_id = Package_1.package_id 

                    INNER JOIN PackageDestiny as PackageDestiny_1 ON PackageDestiny_1.package_id = Package_1.package_id 
                    INNER JOIN Location as LocationDestiny_1 ON PackageDestiny_1.location_id = LocationDestiny_1.location_id 
                    
                    INNER JOIN PackageMessenger as PackageMessenger_1 ON PackageMessenger_1.package_id = Package_1.package_id 
                    
                    INNER JOIN AvailableRoute as AvailableRoute_1 ON AvailableRoute_1.packageMessenger_id = PackageMessenger_1.packageMessenger_id 
                    INNER JOIN User as User_1 ON User_1.user_id = PackageMessenger_1.messenger_id 
                ";  
                

                
                if ($reachLocation === "international")
                {
                    
                } else if ($reachLocation === "national")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_1 ON CityDestiny_1.city_id = LocationDestiny_1.city_id 
    INNER JOIN Department as DepartmentDestiny_1 ON DepartmentDestiny_1.department_id = CityDestiny_1.department_id 
    INNER JOIN Country as CountryDestiny_1 ON CountryDestiny_1.country_id = DepartmentDestiny_1.country_id 
                        

    INNER JOIN City as CityOrigin_1 ON CityOrigin_1.city_id = LocationOrigin_1.city_id 
    INNER JOIN Department as DepartmentOrigin_1 ON DepartmentOrigin_1.department_id = CityOrigin_1.department_id 
    INNER JOIN Country as CountryOrigin_1 ON CountryOrigin_1.country_id = DepartmentOrigin_1.country_id 
                    ";  
                } else if ($reachLocation === "departamental")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_1 ON CityDestiny_1.city_id = LocationDestiny_1.city_id 
    INNER JOIN Department as DepartmentDestiny_1 ON DepartmentDestiny_1.department_id = CityDestiny_1.department_id 
                        

    INNER JOIN City as CityOrigin_1 ON CityOrigin_1.city_id = LocationOrigin_1.city_id 
    INNER JOIN Department as DepartmentOrigin_1 ON DepartmentOrigin_1.department_id = CityOrigin_1.department_id 
                    ";  
                } else if ($reachLocation === "local")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_1 ON CityDestiny_1.city_id = LocationDestiny_1.city_id 

    INNER JOIN City as CityOrigin_1 ON CityOrigin_1.city_id = LocationOrigin_1.city_id 
                    ";  
                }
                
                
                

//            $reachLocation_1 = 
//            "
//                INNER JOIN City as City_1 ON City_1.city_id = LocationDestiny_1.city_id 
//                and City_1.city_id = LocationOrigin_1.city_id 
//                
//                INNER JOIN City as City_1 ON City_1.city_id = LocationDestiny_1.city_id 
//                and City_1.city_id = LocationOrigin_1.city_id 
//                INNER JOIN Department as Department_1 ON Department_1.department_id = City_1.department_id 
//
//                INNER JOIN City as City_1 ON City_1.city_id = LocationDestiny_1.city_id 
//                and City_1.city_id = LocationOrigin_1.city_id 
//                INNER JOIN Department as Department_1 ON Department_1.department_id = City_1.department_id 
//                INNER JOIN Country as Country_1 ON Country_1.country_id = Department_1.country_id 
//            ";
//            
//            $reachLocation_2 = 
//            "
//                department.country_id = $originCountry 
//                city.department_id = $originDepartment 
//                location.city_id = $originCity 
//            ";
            
                
                
//                WHERE CityOrigin_1.city_id = '1' and CityDestiny_1.city_id = '1' 
            } else
            {
                $previous_value = $i - 1;
                $string_a .= 
                "
                ) Z_$i 
                    INNER JOIN Location as LocationOrigin_$i ON location_id_Destiny_$previous_value = LocationOrigin_$i.location_id 
                    INNER JOIN PackageOrigin as PackageOrigin_$i ON PackageOrigin_$i.location_id = LocationOrigin_$i.location_id 

                    INNER JOIN Package as Package_$i ON PackageOrigin_$i.package_id = Package_$i.package_id 

                    INNER JOIN PackageDestiny as PackageDestiny_$i ON PackageDestiny_$i.package_id = Package_$i.package_id 
                    INNER JOIN Location as LocationDestiny_$i ON PackageDestiny_$i.location_id = LocationDestiny_$i.location_id 
                        
                    INNER JOIN PackageMessenger as PackageMessenger_$i ON PackageMessenger_$i.package_id = Package_$i.package_id 
                
                    INNER JOIN AvailableRoute as AvailableRoute_$i ON AvailableRoute_$i.packageMessenger_id = PackageMessenger_$i.packageMessenger_id 
                    INNER JOIN User as User_$i ON User_$i.user_id = PackageMessenger_$i.messenger_id 
               
                ";
                
                if ($reachLocation === "international")
                {
                    
                } else if ($reachLocation === "national")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_$i ON CityDestiny_$i.city_id = LocationDestiny_$i.city_id 
    INNER JOIN Department as DepartmentDestiny_$i ON DepartmentDestiny_$i.department_id = CityDestiny_$i.department_id 
    INNER JOIN Country as CountryDestiny_$i ON CountryDestiny_$i.country_id = DepartmentDestiny_$i.country_id 
                        

    INNER JOIN City as CityOrigin_$i ON CityOrigin_$i.city_id = LocationOrigin_$i.city_id 
    INNER JOIN Department as DepartmentOrigin_$i ON DepartmentOrigin_$i.department_id = CityOrigin_$i.department_id 
    INNER JOIN Country as CountryOrigin_$i ON CountryOrigin_$i.country_id = DepartmentOrigin_$i.country_id 
                    ";  
                } else if ($reachLocation === "departamental")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_$i ON CityDestiny_$i.city_id = LocationDestiny_$i.city_id 
    INNER JOIN Department as DepartmentDestiny_$i ON DepartmentDestiny_$i.department_id = CityDestiny_$i.department_id 
                        

    INNER JOIN City as CityOrigin_$i ON CityOrigin_$i.city_id = LocationOrigin_$i.city_id 
    INNER JOIN Department as DepartmentOrigin_$i ON DepartmentOrigin_$i.department_id = CityOrigin_$i.department_id 
                    ";  
                } else if ($reachLocation === "local")
                {
                    $string_a .= 
                    "
    INNER JOIN City as CityDestiny_$i ON CityDestiny_$i.city_id = LocationDestiny_$i.city_id 

    INNER JOIN City as CityOrigin_$i ON CityOrigin_$i.city_id = LocationOrigin_$i.city_id 
                    ";  
                }
                
                
//                WHERE CityOrigin_$i.city_id = '1' and CityDestiny_$i.city_id = '1' 
                        
            }
            
        }
        
        for ($i = 1; $i <= $package_maxAmount; $i++)
        {
            if ($package_maxAmount === 1)
            {
                $next_value = 1;
                $origin = "LocationOrigin_$next_value.location_id";
                $destiny = "LocationDestiny_$i.location_id";
//                $origin = "location_id_Origin_$next_value";
//                $destiny = "location_id_Destiny_$i";
            } else if ($package_maxAmount > 1)
            {
                $next_value = $i + 1;
                $bucles_amount = $package_maxAmount - 1;
                if ($i === $bucles_amount)
                {
                    $origin = "LocationOrigin_$next_value.location_id";
                    $destiny = "location_id_Destiny_$i";
//                    $origin = "location_id_Origin_$next_value";
//                    $destiny = "location_id_Destiny_$i";
                } else if ($i < $bucles_amount)
                {
                    $origin = "location_id_Origin_$next_value";
                    $destiny = "location_id_Destiny_$i";
                }
            }
            
            if ($i == 1)
            {
                $string_c .= "
                    $origin = $destiny 
                ";
            }
            else if ($i == $package_maxAmount)
            {
                
            }
            else 
            {
                $string_c .= "
                    and $origin = $destiny 
                ";
            }
            
            if ($i == $package_maxAmount)
            {
                if ($package_maxAmount == 1)
                {
//                    $string_c .= "
//                        PackageOrigin_1.location_id = '$originLocation' 
//                        and PackageDestiny_$package_maxAmount.location_id = '$destinyLocation' 
//                    ";
                    $string_c .= "
                        and LocationOrigin_1.location_id = '$originLocation' 
                        and LocationDestiny_$package_maxAmount.location_id = '$destinyLocation' 
                    ";
//                    $string_c .= "
//                        location_id_Origin_1 = '$originLocation' 
//                        and location_id_Destiny_$package_maxAmount = '$destinyLocation' 
//                    ";
//                    $string_c .= "
//                        location_id_Origin_1 = '$originLocation' 
//                        and location_id_Destiny_$package_maxAmount = '$destinyLocation' 
//                    ";
                } else 
                {
                    
                    
                    
//                    $string_c .= "
//                        PackageOrigin_1.location_id = '$originLocation' 
//                        and PackageDestiny_$package_maxAmount.location_id = '$destinyLocation' 
//                    ";
                    $string_c .= "
                        and location_id_Origin_1 = '$originLocation' 
                        and LocationDestiny_$package_maxAmount.location_id = '$destinyLocation' 
                    ";
//                    $string_c .= "
//                        location_id_Origin_1 = '$originLocation' 
//                        and location_id_Destiny_$package_maxAmount = '$destinyLocation' 
//                    ";
//                    $string_c .= "
//                        location_id_Origin_1 = '$originLocation' 
//                        and location_id_Destiny_$package_maxAmount = '$destinyLocation' 
//                    ";
                }
            }
            
            if ($i == $package_maxAmount)
            {
                $string_f .= "
                    package_id_$i 
                ";
            } else
            {
                $string_f .= "
                    package_id_$i, 
                ";
            }
            
        }
        
        for ($i = 1; $i <= $package_maxAmount; $i++)
        {
            if ($i == $package_maxAmount)
            {

                if ($reachLocation === "international")
                {
                    $string_d .= "";
                } else if ($reachLocation === "national")
                {
                    $string_d .= 
                    "
                        CountryOrigin_$i.country_id = $coverage and
                        CountryDestiny_$i.country_id = $coverage 
                    ";
                } else if ($reachLocation === "departamental")
                {
                    $string_d .= 
                    "
                        DepartmentOrigin_$i.department_id = $coverage and 
                        DepartmentDestiny_$i.department_id = $coverage 
                    ";
                } else if ($reachLocation === "local")
                {    
                    $string_d .= 
                    "
                        CityOrigin_$i.city_id = $coverage and 
                        CityDestiny_$i.city_id = $coverage 
                    ";
                }

            } else
            {

                if ($reachLocation === "international")
                {
                    $string_d .= "";
                } else if ($reachLocation === "national")
                {
                    $string_d .= 
                    "
                        country_idOrigin_$i = $coverage and 
                        country_idDestiny_$i = $coverage and 
                    ";
                } else if ($reachLocation === "departamental")
                {
                    $string_d .= 
                    "
                        department_idOrigin_$i = $coverage and 
                        department_idDestiny_$i = $coverage and 
                    ";
                } else if ($reachLocation === "local")
                {    
                    $string_d .= 
                    "
                        city_idOrigin_$i = $coverage and 
                        city_idDestiny_$i = $coverage and 
                    ";
                }

            }
        }
                    
                    
                  
        
        
        
        
        
        
        
        for ($i = 1; $i <= $package_maxAmount; $i++)
        {
            if ($i == $package_maxAmount)
            {
                $string_e .= "
                    Package_$i.package_reachLocation = '$coverage' 
                ";
            } else
            {
                $string_e .= "
                    package_reachLocation_$i = '$coverage' and 
                ";
            }
        }
        
        
        
        
        $query_order = 
            "
                $string_b
                $string_a

                WHERE 
                $string_c
                and
                $string_d
                and
                $string_e
                    
                    
                
                GROUP BY $string_f 
                ORDER BY $string_f DESC 
            ";

        return $query_order;
        
    }
            
    function get_string_b_1($package_amount, $reachLocation)
    {
        $string_b1 = "";
        $string_b1 .= 
        "SELECT DISTINCT 
            ";
        for ($j = 1; $j <= $package_amount; $j++)
        {
            $string_b_1 = "";
            $string_b_2 = "";

            if ($reachLocation === "international")
            {
                $string_b_1 .= 
                "

                ";

                $string_b_2 .= 
                "

                ";
            } else if ($reachLocation === "national")
            {
                $string_b_1 .= 
                "
                    city_idOrigin_$j, 
                    department_idOrigin_$j, 
                    country_idOrigin_$j, 
                ";

                $string_b_2 .= 
                "
                    city_idDestiny_$j, 
                    department_idDestiny_$j, 
                    country_idDestiny_$j, 
                ";
            } else if ($reachLocation === "departamental")
            {
                $string_b_1 .= 
                "
                    city_idOrigin_$j, 
                    department_idOrigin_$j, 
                ";

                $string_b_2 .= 
                "
                    city_idDestiny_$j, 
                    department_idDestiny_$j, 
                ";
            } else if ($reachLocation === "local")
            {
                $string_b_1 .= 
                "
                    city_idOrigin_$j, 
                ";

                $string_b_2 .= 
                "
                    city_idDestiny_$j, 
                ";
            }
        
            $string_b1 .= 
            "
            package_id_$j, 
            package_reachLocation_$j, 
            packageOrigin_id_$j, 
            location_id_Origin_$j, 
            $string_b_1

            packageDestiny_id_$j,   
            location_id_Destiny_$j, 
            $string_b_2
                
            availableRoute_id_$j, 
            availableRoute_openedDate_$j, 
            availableRoute_closedDate_$j, 
            user_id_$j,  
            user_name_$j, 

            ";
        }
        
        return $string_b1;
                    
    }
    
    function get_string_b_2($package_amount, $reachLocation)
    {

        $string_b_1 = "";
        $string_b_2 = "";

        if ($reachLocation === "international")
        {
            $string_b_1 .= 
            "

            ";

            $string_b_2 .= 
            "

            ";
        } else if ($reachLocation === "national")
        {
            $string_b_1 .= 
            "
                CityOrigin_$package_amount.city_id as city_idOrigin_$package_amount, 
                DepartmentOrigin_$package_amount.department_id as department_idOrigin_$package_amount, 
                CountryOrigin_$package_amount.country_id as country_idOrigin_$package_amount, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_$package_amount.city_id as city_idDestiny_$package_amount, 
                DepartmentDestiny_$package_amount.department_id as department_idDestiny_$package_amount, 
                CountryDestiny_$package_amount.country_id as country_idDestiny_$package_amount, 
            ";
        } else if ($reachLocation === "departamental")
        {
            $string_b_1 .= 
            "
                CityOrigin_$package_amount.city_id as city_idOrigin_$package_amount, 
                DepartmentOrigin_$package_amount.department_id as department_idOrigin_$package_amount, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_$package_amount.city_id as city_idDestiny_$package_amount, 
                DepartmentDestiny_$package_amount.department_id as department_idDestiny_$package_amount, 
            ";
        } else if ($reachLocation === "local")
        {
            $string_b_1 .= 
            "
                CityOrigin_$package_amount.city_id as city_idOrigin_$package_amount, 
            ";

            $string_b_2 .= 
            "
                CityDestiny_$package_amount.city_id as city_idDestiny_$package_amount, 
            ";
        }

        $string_b1 = "";
        $string_b1 .= 
        "
            Package_$package_amount.package_id as package_id_$package_amount,   
            Package_$package_amount.package_reachLocation as package_reachLocation_$package_amount,  
            PackageOrigin_$package_amount.packageOrigin_id as packageOrigin_id_$package_amount,   
            LocationOrigin_$package_amount.location_id as location_id_Origin_$package_amount,   
            $string_b_1

            PackageDestiny_$package_amount.packageDestiny_id as packageDestiny_id_$package_amount,   
            LocationDestiny_$package_amount.location_id as location_id_Destiny_$package_amount,  
            $string_b_2

            AvailableRoute_$package_amount.availableRoute_id as availableRoute_id_$package_amount, 
            AvailableRoute_$package_amount.availableRoute_openedDate as availableRoute_openedDate_$package_amount, 
            AvailableRoute_$package_amount.availableRoute_closedDate as availableRoute_closedDate_$package_amount, 
            User_$package_amount.user_id as user_id_$package_amount,  
            User_$package_amount.user_name as user_name_$package_amount    
            FROM ( 
        ";

        return $string_b1;
    }
    
    function identifyRange($originLocation, $destinyLocation)
    {
//        $reachLocation = "international";
//        $coverage = 2;
//        $query_order = $this->getQueryString(
//                $originLocation, 
//                $destinyLocation, 
//                $package_maxAmount, 
//                $reachLocation, 
//                $coverage);
//        $sendata_routes = $this->executeQuery_2(
//            $db2, 
//            $query_order, 
//            $originLocation, 
//            $destinyLocation, 
//            $package_maxAmount, 
//            $xyz, 
//            $callsToExecuteQuery_2, 
//            $sendata_routes,
//            $sendata_users);   
        $sale = $this->getSale();
//        $ItemRoute = $this->getItemRoute($sale, $originLocation, $destinyLocation);
//        $DeliveryRoute = $this->getDeliveryRoute($ItemRoute);
        
        return $sale;
        
    }
    
    function getSale()
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        
        $commercial = $em2->getRepository('HomeBundle:Commercial')->findOneByUser($userId);
        $commercial_id = $commercial->getCommercialId();
        
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            Sale_1.sale_id as sale_id_1, 
            Sale_1.customer_id as customer_id_1, 
            Sale_1.sale_date as sale_date_1, 
            Sale_1.sale_total as sale_total_1, 
            Sale_1.sale_status as sale_status_1, 
            SaleDetail_1.saleDetail_id as saleDetail_id_1, 
            SaleDetail_1.product_id as product_id_1, 
            SaleDetail_1.store_id as store_id_1, 
            SaleDetail_1.saleDetail_amount as saleDetail_amount_1, 
            product.product_name as product_name_1, 
            product.product_description as product_description_1, 
            product.product_image as product_image_1, 
            branch.location_id as branch_location_1, 
            Customer.location_id as customer_location_1 

            FROM sale as Sale_1 
            INNER JOIN SaleDetail as SaleDetail_1 ON SaleDetail_1.sale_id = Sale_1.sale_id 
            INNER JOIN product ON product.product_id = SaleDetail_1.product_id 

            INNER JOIN Commercial as Customer on Customer.commercial_id = Sale_1.customer_id 

            INNER JOIN branch ON branch.branch_id = SaleDetail_1.store_id 

            WHERE Customer.commercial_id = '$commercial_id' 
        ";
                
        $db2 = $em2->getConnection();
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;
        
        $geolocalization = $this->get_sale_geolocalization($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $branch_location = $curso["branch_location_1"];
            $trajectory = $this->get_respectlyTrajectory($branch_location);
            
            $sendata_sale[$i] = array(
                'sale_id_1' => $curso["sale_id_1"],
                'customer_id_1' => $curso["customer_id_1"],
                'sale_date_1' => $curso["sale_date_1"],
                'sale_total_1' => $curso["sale_total_1"],
                'sale_status_1' => $curso["sale_status_1"],
                'saleDetail_id_1' => $curso["saleDetail_id_1"],
                'product_id_1' => $curso["product_id_1"],
                'saleDetail_amount_1' => $curso["saleDetail_amount_1"],
                'product_name_1' => $curso["product_name_1"],
                'product_description_1' => $curso["product_description_1"],
                'product_image_1' => $curso["product_image_1"],
                'branch_location_1' => $curso["branch_location_1"],
                'customer_location_1' => $curso["customer_location_1"],
                'trajectory' => $trajectory
            );
            $i++;
        }

        if ($i == 0)
        {
            $sendata_sale[0] = array(
                'sale_id_1' => "_",
                'customer_id_1' => "_",
                'sale_date_1' => "_",
                'sale_total_1' => "_",
                'sale_status_1' => "_",
                'saleDetail_id_1' => "_",
                'product_id_1' => "_",
                'saleDetail_amount_1' => "_",
                'product_name_1' => "_",
                'product_description_1' => "_",
                'product_image_1' => "_",
                'branch_location_1' => "_",
                'customer_location_1' => "_",
                'trajectory' => "_"
            );
        }
        
        return $sendata_sale;
    }
    
    function get_respectlyTrajectory($branch_location)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        
        $child_entity = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($branch_location);
        $parent_entity_id = $child_entity->getLocationId();
        $parent_entity_name = $child_entity->getLocationName();
        $geolocalization[0] = $parent_entity_id;
        $parent_id = $child_entity->getLocationParent();
        $parent_entity = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($parent_id);
        $parent_entity_id = $parent_entity->getLocationId();
        $parent_entity_name = $parent_entity->getLocationName();
        $geolocalization[1] = $parent_entity_id;
        
        $i = 2;
        while($parent_entity_id !== 1)
        {
            $child_entity = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($parent_entity_id);
            $parent_id = $child_entity->getLocationParent();
            $parent_entity = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($parent_id);
            $parent_entity_id = $parent_entity->getLocationId();
            $parent_entity_name = $parent_entity->getLocationName();
            $geolocalization[$i] = $parent_entity_id;
            $i++;
        }
        
        return $geolocalization;
    }
    
    
    function get_sale_geolocalization($cursos2)
    {
        $em2 = $this->getDoctrine()->getEntityManager();
        $geolocalization[0][0] = 0;
        $i = 0;
        foreach($cursos2 as $curso)
        {
//            $geolocalization[$i][0] = $i;
            $branch_location = $curso["branch_location_1"];
            $j = 0;
            
            $location = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($branch_location);
            $locationParent = $location->getLocationParent();

            while($locationParent === TRUE)
            {

            if($locationParent === TRUE)
            {
            $location = $em2->getRepository('HomeBundle:Location')->findOneByLocationId($locationParent);
            $locationParent = $location->getLocationParent();
//            $geolocalization[$i][$j] = $locationParent;
            $geolocalization[$i][$j] = 0;
            } else {
            $locationParent = FALSE;
            }
            
            $j++;
            }
            $i++;
        }
        return $geolocalization;
    }
    
    function getTrajectory_taste($saleDetail_id)
    {
        $string_d_1 .= 
        "
            SELECT DISTINCT 
                trajectory.trajectory_id as trajectory_id, 
                trajectory.shipping_id as shipping_id, 
                trajectory.shipment_id as shipment_id, 
                trajectory.backordersRate_id as backordersRate_id, 
                trajectory.send_date as send_date, 
                trajectory.deliverate_date as deliverate_date, 
                
                shipping.shipping_id as shipping_id, 
                shipping.courier_id as courier_id, 
                shipping.vehicle_id as vehicle_id, 
                
                shipment.shipment_id as shipment_id, 
                shipment.shipment_amount as shipment_amount, 

                Origin.commercial_id as origin_id, 
                Origin.userType_id as origin_userType_id, 
                UserTypeOrigin.userType_class as origin_userType_class, 
                
                Destiny.commercial_id as destiny_id, 
                Destiny.userType_id as destiny_userType_id, 
                UserTypeDestiny.userType_class as destiny_userType_class, 
                
                saleDetail.saleDetail_id as saleDetail_id, 
                saleDetail.saleDetail_amount as saleDetail_amount 
                
                FROM trajectory 
                INNER JOIN shipping ON shipping.shipping_id = trajectory.shipping_id 
                INNER JOIN shipment ON shipment.shipment_id = trajectory.shipment_id 
                INNER JOIN backordersRate ON backordersRate.backordersRate_id = trajectory.backordersRate_id 
                
                INNER JOIN commercial as Origin ON Origin.commercial_id = trajectory.origin_id 
                INNER JOIN commercial as Destiny ON Destiny.commercial_id = trajectory.origin_id 
                
                INNER JOIN userType as UserTypeOrigin ON Origin.userType_id = UserTypeOrigin.userType_id 
                INNER JOIN userType as UserTypeDestiny ON Destiny.userType_id = UserTypeDestiny.userType_id 
                
                INNER JOIN saleDetail ON saleDetail.saleDetail_id = shipment.saleDetail_id 
                
                WHERE saleDetail.saleDetail_id = '$saleDetail_id' 
        ";
        
        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $trajectory[$i] = array(
                'trajectory_id' => $curso["trajectory_id"],
                'shipping_id' => $curso["shipping_id"],
                'shipment_id' => $curso["shipment_id"],
                'backordersRate_id' => $curso["backordersRate_id"],
                'send_date' => $curso["send_date"],
                'deliverate_date' => $curso["deliverate_date"],
                'shipping_id' => $curso["shipping_id"],
                'courier_id' => $curso["courier_id"],
                'vehicle_id' => $curso["vehicle_id"],
                'shipment_id' => $curso["shipment_id"],
                'shipment_amount' => $curso["shipment_amount"],
                'origin_id' => $curso["origin_id"],
                'origin_userType_id' => $curso["origin_userType_id"],
                'origin_userType_class' => $curso["origin_userType_class"],
                'destiny_id' => $curso["destiny_id"],
                'destiny_userType_id' => $curso["destiny_userType_id"],
                'destiny_userType_class' => $curso["destiny_userType_class"],
                'saleDetail_id' => $curso["saleDetail_id"],
                'saleDetail_amount' => $curso["saleDetail_amount"]
            );
            $i++;
        }
        
        return $trajectory;
    }
            
    function getItemRoute($originLocation, $destinyLocation)
    {
//        $supplying = $this->getSupplying($destinyLocation);
        
        $string_d_1 = "";
                    
        $string_d_1 .= 
        "
            SELECT DISTINCT  
                Package_1.package_id as package_id_1, 
                Package_1.package_reachLocation as package_reachLocation_1, 
                
                PackageOrigin_1.packageOrigin_id as packageOrigin_id_1, 
                LocationOrigin_1.location_id as location_id_Origin_1, 
                CityOrigin_1.city_id as city_idOrigin_1, 
                DepartmentOrigin_1.department_id as department_idOrigin_1, 
                CountryOrigin_1.country_id as country_idOrigin_1, 

                PackageDestiny_1.packageDestiny_id as packageDestiny_id_1, 
                LocationDestiny_1.location_id as location_id_Destiny_1, 
                CityDestiny_1.city_id as city_idDestiny_1, 
                DepartmentDestiny_1.department_id as department_idDestiny_1, 
                CountryDestiny_1.country_id as country_idDestiny_1, 
                
                PackageMessenger_1.package_id as packageMessenger_id_1, 
                Shipping_1.shipping_id as shipping_id_1, 
                Shipping_1.courier_id as courier_id_1, 
                Shipping_1.vehicle_id as vehicle_id_1, 
                
                FROM Location as LocationOrigin_1 

                INNER JOIN PackageOrigin as PackageOrigin_1 ON PackageOrigin_1.location_id = LocationOrigin_1.location_id 

                INNER JOIN Package as Package_1 ON PackageOrigin_1.package_id = Package_1.package_id 

                INNER JOIN PackageDestiny as PackageDestiny_1 ON PackageDestiny_1.package_id = Package_1.package_id 
                INNER JOIN Location as LocationDestiny_1 ON PackageDestiny_1.location_id = LocationDestiny_1.location_id 

                INNER JOIN PackageMessenger as PackageMessenger_1 ON PackageMessenger_1.package_id = Package_1.package_id 
                INNER JOIN Shipping as Shipping_1 ON Shipping_1.packageMessenger_id = PackageMessenger_1.packageMessenger_id 
                
                WHERE 
                
                LocationOrigin_1.location_id = '$originLocation' and 
                LocationDestiny_1.location_id = '$destinyLocation' 
        ";  


        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $sendata_users[$i] = array(
                'package_id_1' => $curso["package_id_1"],
                'package_reachLocation_1' => $curso["package_reachLocation_1"],
                'packageOrigin_id_1' => $curso["packageOrigin_id_1"],
                'location_id_Origin_1' => $curso["location_id_Origin_1"],
                'city_idOrigin_1' => $curso["city_idOrigin_1"],
                'department_idOrigin_1' => $curso["department_idOrigin_1"],
                'country_idOrigin_1' => $curso["country_idOrigin_1"],
                'packageDestiny_id_1' => $curso["packageDestiny_id_1"],
                'location_id_Destiny_1' => $curso["location_id_Destiny_1"],
                'city_idDestiny_1' => $curso["city_idDestiny_1"],
                'department_idDestiny_1' => $curso["department_idDestiny_1"],
                'country_idDestiny_1' => $curso["country_idDestiny_1"],
                'packageMessenger_id_1' => $curso["packageMessenger_id_1"],
                'shipping_id_1' => $curso["shipping_id_1"],
                'courier_id_1' => $curso["courier_id_1"],
                'vehicle_id_1' => $curso["vehicle_id_1"]
            );
            $i++;
        }
        
        return $sendata_users;
    }
            
    function getUsers_2()
    {
        $sendata_users = array();
        for ($i = 0; $i < 5; $i++)
        {
            $sendata_users[$i] = array(
                'user_id' => "_123456...".$i." ...",
                'user_name' => "_",
                'amount_trajectories' => "_",
                'average_trajectory_time' => "_",
                'amount_anomalies' => "_",
                'last_loggin_duration' => "_",
                'amount_time_logged' => "_"
            );
        }
        return $sendata_users;
    }
    
    function getUsers($package_id, $sendata_users)
    {
        $string_a = "";
        $string_b_1 = "";
        $string_b_2 = "";
        $string_c_1 = "";
        $string_c_2 = "";
        $string_d_1 = "";
        $string_d_2 = "";
        
        
        
        $string_d_1 .= 
        "SELECT DISTINCT 
            user_id, 
            user_name, 
            amount_trajectories, 
            average_trajectory_time, 
            amount_anomalies, 
            MAX(SendingStatus.sendingStatus_available) as datetime_login, 
            MAX(SendingStatus.sendingStatus_unavailable) as datetime_logout, 
            
            DATEDIFF(
            IFNULL(MAX(SendingStatus.sendingStatus_unavailable), NOW()), 
            MAX(SendingStatus.sendingStatus_available)
            ) as last_loggin_duration, 
            
            sum(
                DATEDIFF(
                    IFNULL(SendingStatus.sendingStatus_unavailable, 
                    SendingStatus.sendingStatus_available 
                    ),
                    SendingStatus.sendingStatus_available 
                )
            ) as amount_time_logged 
            
            FROM
            (
        ";

        $string_d_2 .= 
        "
        ) TBR 

        LEFT JOIN SendingStatus ON SendingStatus.sendingStatus_user_id = user_id 

        GROUP BY user_id 
        ORDER BY 
            amount_trajectories DESC, 
            average_trajectory_time DESC, 
            last_loggin_duration DESC, 
            amount_anomalies ASC, 
            amount_time_logged DESC 
        ";
        
        $string_c_1 .= 
        "SELECT DISTINCT 
            user_id, 
            user_name, 
            amount_trajectories, 
            average_trajectory_time, 
            count(Anomaly.anomaly_id) as amount_anomalies 
                
        FROM
        (
        ";
        
        $string_c_2 .= 
        "
        ) TB
        
            LEFT JOIN Trajectory ON Trajectory.messenger_id = user_id 
            LEFT JOIN Anomaly ON Anomaly.trajectory_id = Trajectory.trajectory_id 

            GROUP BY user_id 
        ";
        
        $string_b_1 .= 
        "SELECT DISTINCT 
            user_id, 
            user_name, 
            count(Trajectory.trajectory_id) as amount_trajectories, 

            IFNULL(
                CAST(
                    avg(
                        DATEDIFF
                        (
                            Trajectory.trajectory_settingProduct, 
                            Trajectory.trajectory_gettingProduct
                        )
                    ) AS INT), 
                0) as average_trajectory_time 
                
        FROM
        (
        ";
        
        $string_b_2 .= 
        "
        ) T

        LEFT JOIN Trajectory ON Trajectory.messenger_id = user_id 

        GROUP BY user_id 
        ";
        
        $string_a .= 
        "SELECT DISTINCT 
            User.user_id as user_id, 
            User.user_name as user_name 

            FROM Package 
            LEFT JOIN PackageMessenger ON PackageMessenger.package_id = $package_id 
            INNER JOIN User ON User.user_id = PackageMessenger.messenger_id 

            GROUP BY user_id 
            ORDER BY user_id DESC 
        ";

        
        
        $query_order = 
            "
                $string_d_1
                $string_c_1
                $string_b_1
                $string_a
                $string_b_2
                $string_c_2
                $string_d_2
            ";


        $em2 = $this->getDoctrine()->getEntityManager();
        $db2 = $em2->getConnection();
        $stmt2 = $db2->prepare($query_order);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $i = 0;
        foreach($cursos2 as $curso)
        {
            $sendata_users[$i] = array(
                'user_id' => $curso["user_id"],
                'user_name' => $curso["user_name"],
                'amount_trajectories' => $curso["amount_trajectories"],
                'average_trajectory_time' => $curso["average_trajectory_time"],
                'amount_anomalies' => $curso["amount_anomalies"],
                'last_loggin_duration' => $curso["last_loggin_duration"],
                'amount_time_logged' => $curso["amount_time_logged"]
            );
            $i++;
        }
        
        return $sendata_users;
        
    }
}