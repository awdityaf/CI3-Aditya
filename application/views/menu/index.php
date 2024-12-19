<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

               
                    <div class="row">
                        <div class="col-lg-6">
                        <?= form_error('menu','<div class="alert alert-danger" role="alert">','</
                         div>'); ?>

                         <?= $this->session->set_flashdata('message');?>


                        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New Menu</a>


                        <table class="table table-hover">
                         <thead>
                            <tr>
                                    <th>No</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Action</th>
                            </tr>
                         </thead>
                         <tbody>
                         <?php $i = 1; ?>
                         <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td scope="row"><?= $i++; ?></td>
                                <td><?= $m['menu'];?></td>
                                <td>
                                <a href="<?= base_url('auth/edit/' . $m['id']); ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('auth/delete/' . $m['id']); ?>" class="badge badge-danger" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</a>
                                </td>            
                            </tr>
                            <?php endforeach; ?>   
                         </tbody>
                                       
                        </table>

                        </div>
                    </div>
                    
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
  <!-- Begin Page Content -->
 
                   
<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('menu'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="menu">Menu Name</label>
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Enter menu name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
            </div>
</div>

        

        