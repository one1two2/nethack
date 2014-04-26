<div id ="event">
    <div class="eventdetails">
        <a class="zamknij" href="#">Zamknij</a>
        <h3><?php echo $params['name'] ?></h3>
        <p>Data startu: <?= $params['start_time'] ?>, Data zakończenia <?= $params['end_time'] ?> </p>
        <p>Udział bierze <?= $params['attending_count'] ?> osób</p>
        <p><h5>Opis wydarzenia</h5>
            <?php echo $params['description'] ?></p>
        <?php if($params['ticket_uri']): ?>
        <p><a href="<?= $params['ticket_uri'] ?>">Zdobądź bilety</a></p>
        <?php endif; ?>
        <p>
            <h5>Szczegóły miejsca</h5>
            <?= $params['street'] ?><br>
            <?= $params['city'].' '.$params['zip'] ?>
        </p>
    </div>
</div>

