<div class="<?= $size ?> m-auto">
    <form method="<?= $method ?>" action="<?= $action ?>">
        <?php if($real_method): ?>
        <input type="hidden" name="_method" value="<?= $real_method ?>">
        <?php endif; ?>
        <?php foreach($inputs as $item): ?>
            <?= $item->build($source); ?>
        <?php endforeach; ?>
    </form>
</div>
