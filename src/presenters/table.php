<div class="container">
    <div class="pb-5">
        <p class="display-3"><?=$page->name?></p>
    </div>

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><?=$page->description?></h3>
                </div>
                <div class="col text-right">
                    <?= Aecodes\AdminPanel\Layouts\View::make('partials/top-bar', compact('page')) ?>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <?php foreach ($columns as $column): ?>
                        <?=$column->renderTitle()?>
                    <?php endforeach;?>
                </thead>
                <tbody>
                    <?php if ( count($rows) === 0 ): ?>
                    <tr class="text-center text-muted">
                        <td colspan="<?= count($columns) ?>">
                            No rows found
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($rows as $source): ?>
                            <tr>
                                <?php foreach ($columns as $column): ?>
                                    <?=$column->renderValue($source)?>
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