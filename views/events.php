
<div class="event" eid="<?= $params['eid'] ?>"  style="cursor:pointer">
    <h3><?=$params['name']?></h3>
    <div class="eventsmallpicture">
        <img src="<?= $params['pic'] ?>"/>
    </div>
    <div class="eventsmallinfo">
        
        <p>Start: <?= date('j.n.Y',strtotime($params['start_time'])); if(strtotime($params['end_time'])){ ?><br>Koniec: <?= date('j.n.Y',strtotime($params['end_time'])); } ?></p>
        <p>Uczestników <?= $params['attending_count'] ?></p>
        <p>więcej</p>
    </div>
    <div class="clear"></div>
</div>
