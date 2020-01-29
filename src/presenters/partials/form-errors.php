<?php if ($view->errors): ?>
    <div class="alert-danger py-2 px-4">
    <?php foreach ($view->errors as $error): ?>
        <div class="py-2"><?= $error ?></div>
    <?php endforeach ?>
    </div>
<?php endif ?>