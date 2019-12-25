<?php if ($formErrors): ?>
    <div class="alert alert-danger">
    <?php foreach ($formErrors as $error): ?>
        <div><?=$error?></div>
    <?php endforeach;?>
    </div>
<?php endif;?>