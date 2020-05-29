<div class="container">
    <h1>De lijst van paarden</h1>
    <ul>
        <?php foreach($horses as $horse){?>
        <li>
            <a src=""><?=$horse['name'] ?></a>
        </li>
    <?php }?>
    </ul>
</div>