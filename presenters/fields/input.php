<div class="w-full mb-6">
  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>

  <input class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="<?= $name ?>" type="<?= $type ?>" name="<?= $name ?>" value="<?= $value ?>" <?= $attributes ?>>
  
  <p class="text-gray-600 text-xs italic"><?= $help ?></p>
</div>