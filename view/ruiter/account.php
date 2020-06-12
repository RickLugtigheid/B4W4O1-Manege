<div class="container img-tumbnail mt-5">
    <?php
    session_start();
    if($_SESSION["ruiter"] != null){?>
    <h3 class="mb-3">Welkom <?=$_SESSION["ruiter"]?></h3>
    <button class="btn btn-info"><a href="<?= URL ?>ruiter/loguit" class="text-white">Loguit</a></button>
    <button class="btn btn-danger"><a href="<?= URL ?>ruiter/delete" class="text-white">Verwijder u account</a></button>
    
    <div class="img-thumbnail container mt-3">
        <h3>U heeft al gereseveerd voor de volgende tijden: </h3>
        <?php foreach ($data as $row){?>
            <b><?=$row['start_time']?></b><br>
        <?php }?>
    </div>
    
    <?php }else{?>
    <button class="btn btn-info"><a href="<?= URL ?>ruiter/login" class="text-white">Login</a></button>
    <button class="btn btn-info"><a href="<?= URL ?>ruiter/create" class="text-white">Nieuw account</a></button>
    <?php }?>
</div>