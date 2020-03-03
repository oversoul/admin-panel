<div class="w-full mb-6" data-image x-data="{...fields.imageUpload, image: '<?= $value ?>' }">
    <div x-show="image" class="relative">
        <img :src="image" class="w-40 h-40 rounded" />
        <button class="bg-red-500 hover:bg-red-600 focus:shadow-outline focus:outline-none text-white font-bold px-2 rounded absolute top-0" @click.prevent="hideImage()">x</button>
    </div>

    <div x-show="!image" class="drop-area" @click="$refs.file.click()" @dragover.prevent x-on:drop.prevent="setupImage(event.dataTransfer)">
        <input name="<?= $name ?>" type="file" x-ref="file" @change="setupImage(event.target)" />

        <strong>Drop files here or click to upload</strong>
    </div>
</div>