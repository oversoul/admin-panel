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
                    <?php require __DIR__ . '/partials/top-bar.php';?>
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

                    <?php foreach ($rows as $source): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <?=$column->renderValue($source, $page)?>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
        </div>
    </div>
</div>