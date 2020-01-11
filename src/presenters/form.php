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
                    <?= Aecodes\AdminPanel\View::make('partials/top-bar', compact('page')) ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <?= Aecodes\AdminPanel\View::make('partials/form-errors', compact('formErrors')) ?>
    
        <div class="card-body">
            <div class="<?= $class ?>">
                <form method="<?= $method ?>" action="<?= $action ?>" enctype="multipart/form-data">
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