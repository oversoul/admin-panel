<div class="container">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
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