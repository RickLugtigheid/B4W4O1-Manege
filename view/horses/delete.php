<form action="<?=URL?>horses/remove" method="post" class="form-group container mt-5">
    <input type="hidden" value="<?=$data?>" name="id">
    <label>Weet je zeker dat je dit paard wil verwijderen?</label>
    <button type="submit" class="btn btn-danger">Verwijder</button>
</form>