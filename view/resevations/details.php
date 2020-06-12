<div class="container mt-5">
    <div class="img-thumbnail mb-4">
        <h3><?=$name?></h3>
        <b>Ras: <?=$race?></b>
        <br>
        <b>Spring hoogte: <?=$height?></b>
        <br>
        <?php if($canSport == 1){?>
            <b>Geschrikt voor springsport</b>
        <?php }else{?>
            <b>Ongeschrikt voor springsport</b>
        <?php }?>
    </div>
    <!-- laat de tijden zien waar het paard al gehuurd is -->
    <div class="img-thumbnail mb-4">
        <h3>Dit paard is al gehuurd voor de volgende tijden</h3>
        <?php foreach($resevations as $res){?>
            <b><?= $res['start_time']?></b> <br>
        <?php }?>
    </div>

    <div class="img-thumbnail mb-4">
        <h4>Huur <?=$name?></h4>
        <button class="btn btn-primary"><a href="<?= URL."resevations/create/".$id ?>" class="text-light">Huur dit paard</a></button>
    </div>
</div>