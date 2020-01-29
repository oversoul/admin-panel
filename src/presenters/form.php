<div class="container">
    <div class="pb-5">
        <p class="display-3"><?= $page->name ?></p>
    </div>

    <div class="card shadow">
        <?php if ( $page->description != ''): ?>
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><?= $page->description ?></h3>
                </div>
                <div class="col text-right">
                    <?= $view->partial('partials/top-bar') ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <?= $view->partial('partials/form-errors') ?>
    
        <div class="card-body">
            <div class="<?= $form->class ?>">
                <form method="<?= $form->method ?>" action="<?= $form->action ?>" enctype="multipart/form-data">
                    <?= $view->globalFormFields ?>
                    <?php if($form->real_method): ?>
                    <input type="hidden" name="_method" value="<?= $form->real_method ?>">
                    <?php endif; ?>
                    <?= $form->inputs ?>
                </form>
            </div>
        </div>
    </div>
</div>