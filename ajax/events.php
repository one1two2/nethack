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

$query='SELECT * FROM event AS e LEFT JOIN location AS l ON e.location_id=l.id';
$result=mysql_query($query);
$array=array();
while($w=mysql_fetch_assoc($result)){
    
    $array[]=$w;
}


echo json_encode($array);