<div id ="event">
    <div class="eventdetails">
        <a class="zamknij" href="#">Zamknij</a>
        <h3><?php echo $params['name'] ?></h3>
        <p>Data startu: <?= date('M j G:i:s Y',strtotime($params['start_time'])); ?>, Data zakończenia <?= date('M j G:i:s Y',strtotime($params['end_time'])); ?> </p>
        <p><img src="<?= $params['pic'] ?>"/></p>
        <p>Udział bierze <?= $params['attending_count'] ?> osób</p>
        <p><h4>Opis wydarzenia</h4>
            <?php echo $params['description'] ?></p>
        <?php if($params['ticket_uri']): ?>
        <p><a href="<?= $params['ticket_uri'] ?>">Zdobądź bilety</a></p>
        <?php endif; ?>
        <p>
            <h4>Szczegóły miejsca</h4>
            <?= $params['street'] ?><br>
            <?= $params['city'].' '.$params['zip'] ?>
        </p>
    </div>
</div>

