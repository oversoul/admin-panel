<?php if (!$multiple): ?>
<div class="w-full mb-6">
	<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>
    <select name="<?= $name ?>" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" <?= $attributes ?>>
        <?= $options ?>
    </select>
</div>
<?php else: ?>

<div class="w-full mb-6 relative">
	<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>
	<div x-data='{ ...fields.multiSelect, tags: <?= json_encode($value ?? []) ?>, choices: <?= json_encode($options ?? []) ?>  }' x-init="filterTags">

	    <template x-for="tag in tags">
	        <input type="hidden" name="<?= $name ?>[]" :value="tag">
	    </template>

        <div class="flex flex-wrap border border-gray-200 py-2 px-2 rounded">
            <template x-for="(tag, i) in tags" :key="tag">
                <span class="inline-flex items-center text-sm bg-blue-200 p-1 mr-2 rounded text-blue-900">
                    <span x-text="tag"></span>
                    <button type="button" class="text-blue-500 leading-none text-lg ml-2" @click.prevent="removeTag(i)">&times;</button>
                </span>
            </template>

            <input
                placeholder="Add tag..."
                @focus="displayOptions()"
                @keydown.backspace="popTag(event)"
                @keydown.enter.prevent="addTag(event)"
                @click.prevent.away="showOptions = false"
                class="inline-flex items-center text-sm p-1 mr-2"
            >
        </div>
        <div x-show="showOptions" class="border absolute left-0 right-0 rounded mt-1 bg-white py-1 shadow">
            <template x-for="choice in availableTags">
                <p x-text="choice" @click="addTag(choice)" class="p-2 hover:bg-gray-400"></p>
            </template>
        </div>
    </div>
</div>
<?php endif ?>
