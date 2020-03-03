<?= $view->load('partials/form-errors') ?>

<div class="<?= $form->class ?>">
    <form method="<?= $form->method ?>" action="<?= $form->action ?>" enctype="multipart/form-data">
        <?= $view->globalFormFields ?>
        <?php if($form->real_method): ?>
        <input type="hidden" name="_method" value="<?= $form->real_method ?>">
        <?php endif ?>
        <?= $form->inputs ?>
    </form>
</div>