
<?php
    $description = str_replace('\n', '<br>', $params['description']);
    $description = wordwrap($description, 600," <a class='moredescription' href='#'>więcej</a><br>");
    $desc = explode("<br>", $description);
?>
<div id ="event">
    <div class="eventdetails">
        <a class="zamknij" href="#">Zamknij</a>
        <h3><?php echo $params['name'] ?></h3>
        <p>Data startu: <?= date('M j G Y',strtotime($params['start_time'])); if(strtotime($params['end_time'])){?>, Data zakończenia <?= date('M j G Y',strtotime($params['end_time'])); } ?> </p>
        <p><img src="<?= $params['pic_big'] ?>"/></p>
        <p>Udział bierze <?= $params['attending_count'] ?> osób</p
        
        <p><h4>Opis wydarzenia</h4>
        <?php for($i=0;$i<sizeof($desc);$i++){ ?>
        <div <?php if($i>0){ echo "hidden='true'"; } ?> id="eventdescription<?= $i ?>">
            
            <?php echo $desc[$i] ?></div></p>
        <?php } ?>
        <?php if($params['ticket_uri']): ?>
        <p><a href="<?= $params['ticket_uri'] ?>">Zdobądź bilety</a></p>
        <?php endif; ?>
        <p>
            <h4>Szczegóły miejsca</h4>
            <?= $params['location_street'] ?><br>
            <?= $params['location_city'].' '.$params['location_zip'] ?>
        </p>
    </div>
</div>

