<div class="container mt-5">
    <button class="btn btn-primary"><a href="<?=URL?>horses/create" class="text-light">nieuw paard</a></button>
    <h1>De lijst van paarden</h1>
    <ul class="list-group">
        <?php foreach($horses as $horse){?>
        <li class="list-group-item">
            <a class="text-info" style="width: 25%;" href="<?= URL."resevations/details/".$horse['id'] ?>"><?=$horse['name'] ?></a>
            <button class="btn-sm btn-danger float-right"><a class="text-white" href="<?= URL."horses/delete/".$horse['id'] ?>">Verwijder paard</a></button>
            <button class="btn-sm btn-warning float-right"><a class="text-white" href="<?= URL."horses/update/".$horse['id'] ?>">Bewerk paard</a></button>
        </li>
    <?php }?>
    </ul>
</div>