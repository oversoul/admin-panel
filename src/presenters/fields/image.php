<div class="form-group" x-data="{...fields.imageUpload, image: '<?= $value ?>' }">
    <div x-show="image" class="image">
        <img :src="image" class="img-thumbnail w-100" />
        <button class="btn btn-danger btn-sm btn-close" @click.prevent="hideImage()">x</button>
    </div>

    <div x-show="!image" class="drop-area" @click="$refs.file.click()" @dragover.prevent
        x-on:drop.prevent="setupImage(event.dataTransfer)">
        <input name="<?= $name ?>" type="file" x-ref="file" @change="setupImage(event.target)" />

        <strong>Drop files here or click to upload</strong>
    </div>
</div>