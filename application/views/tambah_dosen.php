<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('metadata'); ?>
    <title>Tambah Dosen Baru | <?= $app_name ?></title>

    <?php $this->load->view('admin/header'); ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php $this->load->view('admin/nav'); ?>
            <?php $this->load->view('admin/sidebar'); ?>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Tambah Dosen Baru</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <img src="<?= base_url()?>assets/resources/professor.png" /> Dosen
                            </li>
                            <li>
                                <img src="<?= base_url()?>assets/resources/professor.png" /> Tambah Dosen Baru
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Tambah</h3>
                            </div>
                            <div class="panel-body">
                                <!-- isi disini -->
                                <?php if ($error == true) { ?><label class="control-label" style="color: red;">ERROR: <?= $errorText ?></label><br><?php } ?>
                                <!-- isi disini -->
                                <form action="<?= base_url() ?>dosen/add_new.me" method="POST">
                                    <label class="control-label" for="inputError">NIDN/NIK:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'id') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon">ID</span>
                                        <input type="text" name="nidn" class="form-control" id="inputError" placeholder="Masukkan NIDN/NIK disini..." value="<?= @$id; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Nama Dosen:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'nama') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama dosen disini..." value="<?= @$nama; ?>">
                                    </div>
                                    <label class="control-label" for="inputError">Kata Sandi:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'pw') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                        <input type="password" name="pw" class="form-control" placeholder="Masukkan kata sandi disini...">
                                    </div>
                                    <label class="control-label" for="inputError">Ulangi Kata Sandi:</label>
                                    <div class="form-group input-group <?= (($errorOn == 'pw') || ($errorOn == 'all') ? "has-error" : ""); ?>">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                        <input type="password" name="pw2" class="form-control" placeholder="Masukkan ulang kata sandi disini...">
                                    </div>
                                    <input type="submit" name="simpan" onclick="" class="btn btn-success btn-md" value="Simpan"/>
                                    <button type="reset" onclick="" class="btn btn-danger btn-md"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php $this->load->view('admin/footer'); ?>

</body>

</html>
