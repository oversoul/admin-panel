<div class="container">
    <div class="pb-5">
        <p class="display-3"><?= $page->name ?></p>
    </div>

    <div class="card shadow">
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

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <?php foreach ($table->columns as $column): ?>
                        <?= $column->renderTitle() ?>
                    <?php endforeach;?>
                </thead>
                <tbody>
                    <?php if ( count($table->rows) === 0 ): ?>
                    <tr class="text-center text-muted">
                        <td colspan="<?= $columns->count() ?>">
                            No rows found
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($table->rows as $source): ?>
                            <tr>
                                <?php foreach ($table->columns as $column): ?>
                                    <?= $column->renderValue($source) ?>
                                <?php endforeach;?>
                            </tr>
                        <?php endforeach;?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
        </div>
    </div>
</div>