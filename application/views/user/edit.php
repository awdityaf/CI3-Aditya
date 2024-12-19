

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-8">
                            <?= form_open_multipart('user/edit');?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'];?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="form-label">Full name</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                value="<?= $user['name'];?>">
                                <?= form_error('name',' <small 
                                        class="text-danger pl-3">','</small> ' ); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm2">Picture</div>
                                <div class="col-sm10">
                                    <div class="row">
                                        <div class="col-sm3">
                                            <img src="<?= base_url('assets/img/profile'). $user['image'];?>" class="img-thumbnail">
                                        </div>
                                        <div class="class col-sm-9">
                                            <div class="class custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label"
                                                for="image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>

                    

            </div>
            <!-- End of Main Content -->

        