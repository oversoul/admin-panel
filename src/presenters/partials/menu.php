<?php foreach ($menus as $menu): ?>
<li class="nav-item">
    <a class="nav-link" href="<?=$menu['url']?>"><?=$menu['name']?></a>
</li>
<?php endforeach?>
<li class="nav-item">
    <a class="nav-link" href="javascript:{}" onclick="triggerDestroyForm(event, '/auth/logout')">Logout</a>
</li>