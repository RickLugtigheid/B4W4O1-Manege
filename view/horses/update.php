<form action="<?=URL?>horses/edit" method="post" class="form-group container mt-5 img-thumbnail">
    <input type="hidden" name="id" value="<?=$id?>">
    <label> Naam: </label> <input type="text" name="name" class="form-control" value="<?=$name?>">
    <label> Ras: </label> <input type="text" name="race" class="form-control" value="<?=$race?>">
    <label> Leeftijd: </label> <input type="number" name="age" class="form-control" value="<?=$age?>">
    <label> Schofthoogte in cm: </label> <input type="number" name="height" class="form-control" value="<?=$height?>">
    <label> Geschikt voor springsport: </label> <input type="checkbox" name="sport" class="form-control" <?php if($canSport != 0){echo "checked";}?>>
    <button type="submit" class="btn btn-primary text-light">update</button>
</form>