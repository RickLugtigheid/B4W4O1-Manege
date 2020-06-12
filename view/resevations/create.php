<form action="<?=URL?>resevations/store" method="post" class="form-group container mt-5 img-thumbnail">
    <input type="hidden" value="<?php foreach($horse as $data){echo $data['id'];}?>" name="id">
    Kies een tijd: <input type="datetime-local" name="time" class="form-control">
    <!-- Op naam: <input type="text" name="name" class="form-control"> -->
    <button type="submit" class="btn btn-primary text-light">Reseveer</button>
</form>
<div class="img-thumbnail container">
    <b>Prijs: <?=HUURPRIJS_PAARD?>euro</b>
</div>