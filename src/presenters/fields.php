--- input ---
<div class="form-group">
  <label class="form-control-label" for=":name">:title</label>
  <input type=":type" id=":name" class="form-control" value=":value" name=":name" :attributes>
  <span class="help-block">:help</span>
</div>
---

--- select ---
<div class="form-group">
  <label class="form-control-label" for=":name">:title</label>
  <select name=":name" :attributes>
    :options
  </select>
</div>
---

--- textarea ---
<div class="form-group">
  <label class="form-control-label" for=":name">:title</label>
  <textarea name=":name" class="form-control" :attributes>:value</textarea>
</div>
---

--- checkbox ---
<div class="container align-items-center d-flex p-0">
  <label class="custom-toggle">
    <input type="checkbox" id=":name" :value name=":name">
    <span class="custom-toggle-slider rounded-circle"></span>
  </label>

  <label class="ml-2" for=":name">:title</label>
</div>
---