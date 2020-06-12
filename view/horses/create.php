<form action="<?=URL?>horses/store" method="post" class="form-group container mt-5 img-thumbnail">
    <label> Naam: </label> <input type="text" name="name" class="form-control">
    <label> Ras: </label> <input type="text" name="race" class="form-control">
    <label> Leeftijd: </label> <input type="number" name="age" class="form-control">
    <label> Schofthoogte in cm: </label> <input type="number" name="height" class="form-control">
    <label> Geschikt voor springsport: </label> <input type="checkbox" name="sport" class="form-control">
    <button type="submit" class="btn btn-primary text-light">voegtoe</button>
</form>