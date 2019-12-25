<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <?php foreach($columns as $column): ?>
                <?= $column->renderTitle() ?>
            <?php endforeach; ?>
        </thead>
        <tbody>

            <?php foreach($rows as $source): ?>
                <tr>
                    <?php foreach($columns as $column): ?>
                        <?= $column->renderValue($source) ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>