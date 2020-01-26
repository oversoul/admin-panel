<div class="form-group">
    <label class="form-control-label" for="<?= $name ?>"><?= $title ?></label>

    <input 
      id="<?= $name ?>" 
      type="<?= $type ?>" 
      name="<?= $name ?>"
      class="form-control" 
      value="<?= $value ?>" 
      <?= $attributes ?>
    >

    <small class="form-text text-muted">
      <?= $help ?>
    </small>
</div>