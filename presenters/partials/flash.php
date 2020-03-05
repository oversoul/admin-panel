<?php if ($view->flashMessage): ?>
    <div class="rounded text-white text-sm font-bold px-4 py-3 mb-4 bg-<?=$view->flashMessage['type']?>-500">
        <?=$view->flashMessage['message']?>
    </div>
<?php endif;?>