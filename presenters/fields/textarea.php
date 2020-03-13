<div class="w-full mb-6">
  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>"><?= $title ?></label>

  <textarea
  	id="<?= $name ?>"
  	name="<?= $name ?>"
	class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
  	<?= $attributes ?>
  ><?= $value ?></textarea>
</div>
