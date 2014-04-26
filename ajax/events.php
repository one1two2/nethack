<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of events
 *
 * @author dominik
 */
require_once '../init.php';



if(array_key_exists('lat', $_GET)===true && array_key_exists('lat', $_GET)===true){
    
    $pointLat=filter_input(INPUT_GET, 'lat', FILTER_VALIDATE_FLOAT);
    $pointLng=filter_input(INPUT_GET, 'lng', FILTER_VALIDATE_FLOAT);
    $radius=filter_input(INPUT_GET, 'r', FILTER_VALIDATE_INT);
    $sort=filter_input(INPUT_GET, 'r', FILTER_SANITIZE_STRING);
    
    $order_by='attending_count';
    if($sort==='date'){
        $order_by='start_time';
    }
    else if($sort==='nearest'){
         $order_by='distance_in_km';
    }
    //$pointLat=$_GET['lat'];
    //$pointLng=$_GET['lng'];
    
    //echo$pointLat.' | '.$pointLng.' | '.$radius;
    
    $query='SELECT *, 111.045 * DEGREES(ACOS(COS(RADIANS('.$pointLat.'))
                * COS(RADIANS(latitude))
                * COS(RADIANS('.$pointLng.') - RADIANS(longitude))
                + SIN(RADIANS('.$pointLat.'))
                * SIN(RADIANS(latitude)))) AS distance_in_km
                FROM event AS e LEFT JOIN location AS l ON e.location_id=l.id
                WHERE latitude
                BETWEEN '.$pointLat.'  - ('.$radius.' / 111.045)
                    AND '.$pointLat.'  + ('.$radius.' / 111.045)
               AND longitude
                BETWEEN '.$pointLng.' - ('.$radius.' / (111.045 * COS(RADIANS('.$pointLat.'))))
                    AND '.$pointLng.' + ('.$radius.' / (111.045 * COS(RADIANS('.$pointLat.'))))
             ORDER BY '.$order_by;
    //echo $query;
    $result=mysql_query($query);
    $array=array();
    while($w=mysql_fetch_assoc($result)){
        $w['html']=getView('events',$w);
        
        $array[]=$w;
    }


    echo json_encode($array);
}

