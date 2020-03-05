<div class="w-full mb-6">
	<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>
    <select name="<?= $name ?>" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 single-select" <?= $attributes ?>>
        <?= $options ?>
    </select>
</div>