<div class="container">
    <div class="pb-5">
        <p class="display-3"><?=$page->name?></p>
    </div>

    <div class="card shadow">
        <?php if ( $page->description != ''): ?>
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><?=$page->description?></h3>
                </div>
                <div class="col text-right">
                    <?php require $viewPath . "/partials/top-bar.php" ?>
                </div>
            </div>
        </div>
        <?php endif ?>
    
        <div class="card-body">
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
        </div>
    </div>
</div>