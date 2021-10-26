<?php

namespace HomeBundle\Helper;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MatchNodes extends Controller {

    public $global_topicId = 0;
    
    public function isValid($db2, $originLocation, $destinyLocation)
    {
        $valor1 = $this->matchNodes($db2, $originLocation, $destinyLocation);
        return $valor1;
    }
    
    public function matchNodes($db2, $originLocation, $destinyLocation)
    {
        $l_111 = $this->correctTerritoriality($db2, $originLocation);
        $l_11 = $l_111[0];
        $i = $l_111[1];
        $node_origin = $l_111[2];
        
        
        $l_222 = $this->correctTerritoriality($db2, $destinyLocation);
        $l_22 = $l_222[0];
        $j = $l_222[1];
        $node_destiny = $l_222[2];
        
        
        if ($i < $j)
        {
            $limit = $j; 
        } else
        {
            $limit = $i;
        }
        
        $reach = 1;
        
        for ($f = 0; $f < $limit; $f++)
        {
            if (isset($l_11[$f]) && isset($l_22[$f]))
            {
                if ($l_11[$f] == $l_22[$f])
                {
                    $reach = $l_11[$f];
                    $vnd = $f + 1;
                    
                    if (isset($l_11[$vnd]))
                    {
                        $node_origin = $l_11[$vnd];
                    }

                    if (isset($l_22[$vnd]))
                    {
                        $node_destiny = $l_22[$vnd];
                    }
                }
            }
        }
        
        $cbdjk[0] = $node_origin;
        $cbdjk[1] = $node_destiny;
        $cbdjk[2] = $i;
        $cbdjk[3] = $j;
        $cbdjk[4] = $reach;
        $cbdjk[5] = $l_11;
        $cbdjk[6] = $l_22;
        
        return $cbdjk;
    }
    
    public function correctTerritoriality($db2, $location)
    {
        $i = 0;
        $l_1[$i] = 0;
        $p_1[$i] = 0;
        $t_1[$i] = 0;
        $br = 0;
        while ($br == 0)
        {
//            ($l_1[$i] != 1 && $p_1[$i] != 1 && $t_1[$i] != 1) ||
            $cds = $this->checkTerritoriality($db2, $location);
            $l_1[$i] = $cds[0];
            $p_1[$i] = $cds[1];
            $t_1[$i] = $cds[2];
            $location = $p_1[$i];
            
            if ($l_1[$i] == 1) // && $p_1[$i] == 1 && $t_1[$i] == 1
            {
                $br = 1;
            }
            $i++;
        }
        
        $jhk = $i - 1;
        
        for ($ii = 0; $ii <= $jhk; $ii++)
        {
            $fb = $jhk-$ii;
            $l_11[$ii] = $l_1[$fb];
//            $p_11[$ii] = $p_1[$fb];
//            $t_11[$ii] = $t_1[$fb];
            $fb--;
        }
        
        for ($m = 0; $m <= $jhk; $m++)
        {
            $this->cndis_123($db2, $l_11[$m]);
        }
        
        $cbdjk[0] = $l_11;
        $cbdjk[1] = $i;
        $cbdjk[2] = $location;
        
        return $cbdjk;
    }
    
    public function cndis_123($db2, $location)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            Location.location_id, 
            Location.location_parent, 
            Location.territoriality, 
            territoriality_child.territoriality_id as territoriality_child_1, 
            territoriality_parent.territoriality_id as territoriality_parent_1 
            
            FROM Location 
            
            INNER JOIN territoriality ON territoriality.territoriality_id = location.territoriality 
            
            INNER JOIN Location as Location_parent ON Location.location_parent = Location_parent.location_id 
            INNER JOIN territoriality as territoriality_parent ON territoriality_parent.territoriality_id = Location_parent.territoriality 
            INNER JOIN territoriality as territoriality_child ON territoriality_child.parent_id = territoriality_parent.territoriality_id 
            
            WHERE Location.location_id = '$location' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $location_id = $curso["location_id"];
            $location_parent = $curso["location_parent"];
            $territoriality = $curso["territoriality"];
            $territoriality_child_1 = $curso["territoriality_child_1"];
            $territoriality_parent_1 = $curso["territoriality_parent_1"];
        }
        
        if ($amountRecords != 0)
        {
            if ($location_id == 1)
            {
                $territoriality = 1;
                $this->updateTerritoriality($db2, $location_id, $territoriality);
            } else {
                $territoriality = $territoriality_child_1;
                $this->updateTerritoriality($db2, $location_id, $territoriality);
            }
        }
    }
    
    public function updateTerritoriality($db2, $location, $territoriality_child_1_q)
    {
        $query_nm = " 
            UPDATE `location` 
            SET 
            `territoriality`=$territoriality_child_1_q 

            WHERE 

            location_id = '$location' 
        ";

        $stmt_nm = $db2->prepare($query_nm);
        $params_nm = array();
        $stmt_nm->execute($params_nm);
    }
    
    public function checkTerritoriality($db2, $location)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            Location.location_id, 
            Location.location_parent, 
            Location.territoriality 
            
            FROM Location 
            
            WHERE Location.location_id = '$location' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $location_id = $curso["location_id"];
            $location_parent = $curso["location_parent"];
            $territoriality = $curso["territoriality"];
        }
        
        if ($amountRecords == 0)
        {
            $location_id = 1;
            $location_parent = 1;
            $territoriality = 1;
        }
        
        $cbdjk[0] = $location_id;
        $cbdjk[1] = $location_parent;
        $cbdjk[2] = $territoriality;
        
        return $cbdjk;
    }
    
    public function getTerritoriality($db2, $location)
    {
        $string_d_1 = "";
        $string_d_1 .= 
        "
        SELECT DISTINCT 
            Location.location_id, 
            Location.location_parent, 
            territoriality.territoriality_id 
            
            FROM Location 
            
            INNER JOIN territoriality ON Location.territoriality = territoriality.territoriality_id 
            
            WHERE Location.location_id = '$location' 
        ";

        $stmt2 = $db2->prepare($string_d_1);
        $params2 = array();
        $stmt2->execute($params2);

        $cursos2 = $stmt2->fetchAll();
        $amountRecords = count($cursos2);
        
        foreach($cursos2 as $curso)
        {
            $location_id = $curso["location_id"];
            $location_parent = $curso["location_parent"];
            $territoriality = $curso["territoriality_id"];
        }
        
        if ($amountRecords == 0)
        {
            $location_id = 1;
            $location_parent = 1;
            $territoriality = 1;
        }
        
        $cbdjk[0] = $location_id;
        $cbdjk[1] = $location_parent;
        $cbdjk[2] = $territoriality;
        
        return $cbdjk;
    }
}