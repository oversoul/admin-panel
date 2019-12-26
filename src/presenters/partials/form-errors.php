<?php if ($formErrors): ?>
    <div class="alert alert-danger">
    <?php foreach ($formErrors as $error): ?>
        <div class="py-2"><?=$error?></div>
    <?php endforeach;?>
    </div>
<?php endif;?>