<div id="event">
    <h3><?=$params['name']?></h3>
    <div class="eventsmallpicture">
        <img src="<?= $params['pic'] ?>"/>
    </div>
    <div class="eventsmallinfo">
        
        <p><?= date('j.n.Y',strtotime($params['start_time'])); ?>, <?= date('j.n.Y',strtotime($params['end_time'])); ?></p>
        <p>Uczestników <?= $params['attending_count'] ?></p>
        <p><?= mb_substr($params['description'],0,50); ?> <a class="wiecej" eid="<?= $params['eid'] ?>" href="#">więcej</a></p>
    </div>
</div>