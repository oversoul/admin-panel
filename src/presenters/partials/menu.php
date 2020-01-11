<?php foreach ($menus as $menu): ?>
<li class="<?= empty($menu['children']) ? 'nav-item' : 'nav-item dropdown' ?>">
    <a href="<?=$menu['url']?>" <?= empty($menu['children']) ? 'class="nav-link"' : 'class="nav-link dropdown-toggle" data-toggle="dropdown"' ?>"><?=$menu['name']?></a>

    <?php if (!empty($menu['children'])): ?>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a href="<?=$menu['url']?>" class="dropdown-item"><?=$menu['name']?></a>
    <?php foreach ($menu['children'] as $sub): ?>
        <a class="dropdown-item" href="<?=$sub['url']?>"><?=$sub['name']?></a>
    <?php endforeach;?>
    </div>
    <?php endif;?>
</li>
<?php endforeach?>
<li class="nav-item">
    <a class="nav-link" href="javascript:{}" onclick="triggerDestroyForm(event, '/auth/logout')">Logout</a>
</li>