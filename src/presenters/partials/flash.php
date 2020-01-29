<?php if ($view->flashMessage): ?>
    <div class="alert alert-<?=$view->flashMessage['type']?>">
        <?=$view->flashMessage['message']?>
    </div>
<?php endif;?>