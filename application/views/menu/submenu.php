<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?> 
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>  

            <?= $this->session->flashdata('message'); ?>

            <!-- Button to open the modal -->
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">Add New SubMenu</a>

            <!-- Submenu Table -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
        
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active'] ? 'Active' : 'Inactive'; ?></td>
                            <td>
                            <td>
                            <a href="<?= base_url('menu/edit_submenu/' . $sm['id']); ?>" class="badge badge-success">Edit</a>
                            <a href="<?= base_url('menu/delete/' . $sm['id']); ?>" class="badge badge-danger" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</a>
                            </td>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <!-- Title Input -->
                    <div class="form-group mb-3">
                        <label for="title">SubMenu Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" required>
                    </div>

                    <!-- Menu Dropdown -->
                    <div class="form-group mb-3">
                        <label for="menu_id">Select Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- URL Input -->
                    <div class="form-group mb-3">
                        <label for="url">SubMenu URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu URL" required>
                    </div>

                    <!-- Icon Input -->
                    <div class="form-group mb-3">
                        <label for="icon">SubMenu Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" required>
                    </div>

                    <!-- Active Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Active?</label>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
