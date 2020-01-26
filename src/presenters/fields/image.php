<?php if ($value): ?>
  <div>
    <img class="img-thumbnail w-25 mb-3" src="<?= $path . $value ?>" alt="<?= $value ?>">
  </div>
<?php endif; ?>
<div class="form-group">
  <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
  <input type="file" <?= $multiple ?> name="<?= $name ?>" label="<?= $title ?>" help="<?= $help ?>" is="drop-files" />
</div>
