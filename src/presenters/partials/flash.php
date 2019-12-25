<?php if ($flashMessage): ?>
    <div class="alert alert-<?=$flashMessage['type']?>">
        <?=$flashMessage['message']?>
    </div>
<?php endif;?>