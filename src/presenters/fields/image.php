<div class="w-full mb-6" xmlns:x-on="http://www.w3.org/1999/xhtml">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>
    <?php if ($multiple === ''): ?>

        <div x-data="{...fields.imageUpload, image: '<?= $value ?>' }">
            <div x-show="image" class="relative">
                <img :src="image" class="w-40 h-40 rounded" alt="<?= $value ?>"/>
                <button
                    @click.prevent="hideImage()"
                    class="bg-red-500 hover:bg-red-600 focus:shadow-outline focus:outline-none text-white font-bold px-2 rounded absolute top-0"
                >x</button>
            </div>

            <div
                x-show="!image"
                @click="$refs.file.click()" @dragover.prevent x-on:drop.prevent="setupImage(event.dataTransfer)"
                class="flex h-40 w-40 p-2 relative rounded text-center items-center justify-center border-4 border-dashed"
            >
                <input name="<?= $name ?>" class="hidden" type="file" x-ref="file" @change="setupImage(event.target)"/>

                <strong class="text-sm">Drop files here or click to upload</strong>
            </div>
        </div>
    <?php else: ?>
        <div x-data='{ ...fields.imagesUpload, images: <?= $value ?> }'>

            <div class="flex flex-wrap -mx-2">
                <template x-for="(image, index) in images" :key="index">
                    <div class="relative m-2">
                        <img :src="image" class="object-cover w-40 h-40 rounded" :alt="image" />
                        <button
                            @click.prevent="hideImage(index)"
                            class="bg-red-500 hover:bg-red-600 focus:shadow-outline focus:outline-none text-white font-bold px-2 rounded absolute top-0"
                        >x</button>
                    </div>
                </template>
            </div>

            <div
                @dragover.prevent
                @click="$refs.file.click()"
                x-on:drop.prevent="setupImage(event.dataTransfer)"
                class="flex h-40 p-2 relative rounded text-center items-center justify-center border-4 border-dashed"
            >
                <input name="<?= $name ?>[]" class="hidden" multiple type="file" x-ref="file" @change="setupImage(event.target)"/>

                <strong>Drop files here or click to upload</strong>
            </div>
        </div>
    <?php endif ?>
</div>
