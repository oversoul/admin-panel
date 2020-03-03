<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
    <table class="min-w-full">
        <thead>
            <?php foreach ($table->columns as $column): ?>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    <?= $column->renderTitle() ?>
                </th>
            <?php endforeach;?>
        </thead>
        <tbody class="bg-white">
            <?php if ( count($table->rows) === 0 ): ?>
                <tr class="text-center text-gray h-40">
                    <td colspan="<?= count($table->columns) ?>">
                        No rows found
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($table->rows as $source): ?>
                    <tr>
                        <?php foreach ($table->columns as $column): ?>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"><?= $column->renderValue($source) ?></td>
                        <?php endforeach;?>
                    </tr>
                <?php endforeach;?>
            <?php endif ?>
        </tbody>
    </table>

    <div class="card-footer py-4">
        <?= $table->footer ?>
    </div>
</div>