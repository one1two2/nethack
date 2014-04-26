<?php
require '../init.php';

if(array_key_exists('eid', $_GET)===true){
    
    $eid=filter_input(INPUT_GET, 'eid', FILTER_VALIDATE_INT);
    
    $sql = 'SELECT * FROM event AS e LEFT JOIN location AS l ON e.location_id=l.id WHERE e.eid = '.$eid.'';
    $result=mysql_query($sql);
    $event = null;
    while($w=mysql_fetch_assoc($result)){
        $event=$w;
        echo getView('event', $event);
    }

}
//var_dump($sql);
?>
