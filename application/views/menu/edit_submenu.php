<div class="container">
    <h3 class="mb-4">Edit Menu</h3>
    <?= form_open('menu/edit_submenu' . $sm['id']); ?>
    <div class="form-group">
        <label for="submenu">Menu Name</label>
        <input type="text" class="form-control" id="submenu" name="submenu" value="<?= $menu['menu']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a href="<?= base_url('menu'); ?>" class="btn btn-secondary">Cancel</a>
    <?= form_close(); ?>
</div>