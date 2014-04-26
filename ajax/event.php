<?php
require '../init.php';

$eid = 5;

$sql = 'SELECT * FROM event AS e LEFT JOIN location AS l ON e.location_id=l.id WHERE e.eid = '.$eid.'';
$result=mysql_query($sql);
$event = null;
while($w=mysql_fetch_assoc($result)){
        $event=$w;
        echo getView('event', $event);
}
//var_dump($sql);
?>
