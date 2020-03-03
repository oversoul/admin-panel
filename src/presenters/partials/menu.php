<?php foreach ($view->menu as $menu): ?>
    <a href="<?= $menu['url'] ?>" class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300"><?= $menu['name'] ?></a>
<?php endforeach ?>