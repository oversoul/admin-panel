<?php if ($view->errors): ?>
	<div class="rounded bg-red-500 text-white text-sm font-bold px-4 py-3 mb-4" role="alert">
	    <?php foreach ($view->errors as $error): ?>
	        <p class="my-2"><?= $error ?></p>
	    <?php endforeach ?>
    </div>
<?php endif ?>